<?php

namespace FreeFW\Model;

use \FreeFW\Constants as FFCST;

/**
 * Jobqueue
 *
 * @author jeromeklam
 */
class Jobqueue extends \FreeFW\Model\Base\Jobqueue implements \Psr\Log\LoggerInterface
{

    /**
     * Comportements
     */
    use \FreeSSO\Model\Behaviour\User;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Types
     * @var string
     */
    const TYPE_ONCE = 'ONCE';
    const TYPE_LOOP = 'LOOP';

    /**
     * Status
     * @var string
     */
    const STATUS_WAITING  = 'WAITING';
    const STATUS_PENDING  = 'PENDING';
    const STATUS_FINISHED = 'FINISHED';
    const STATUS_ERROR    = 'ERROR';
    const STATUS_RETRY    = 'RETRY';

    /**
     * Prevent from saving history
     * @var bool
     */
    protected $no_history = true;

    /**
     * Report in cache...
     * @var boolean
     */
    protected $cache = true;

    /**
     * logs
     * @var array
     */
    protected $logs = [];

    /**
     * Par défaut tout
     * @var mixed
     */
    protected $level = \Psr\Log\LogLevel::DEBUG;

    /**
     * Get logs
     *
     * @return string
     */
    protected function getLogs()
    {
        $text = null;
        if (is_array($this->logs) && count($this->logs) > 0) {
            $text = '';
            foreach ($this->logs as $oneLog) {
                $text .= $oneLog['message'] . PHP_EOL;
            }
        }
        return $text;
    }
    /**
     * Save logs
     */
    public function saveLogs()
    {
        if (is_array($this->logs) && count($this->logs) > 0) {
            $text = '';
            foreach ($this->logs as $oneLog) {
                $text .= $oneLog['message'] . PHP_EOL;
            }
            $this
                ->setJobqLastReport($text)
                ->save();
        }
        $this->logs = [];
    }

    /**
     * Increment nb try
     *
     * @param number $p_nb
     *
     * @return \FreeFW\Model\Jobqueue
     */
    public function incrementTry($p_nb = 1)
    {
        $this->jobq_nb_retry   = $this->jobq_nb_retry + $p_nb;
        $this->jobq_next_retry = \FreeFW\Tools\Date::getCurrentTimestamp(30);
        return $this;
    }

    /**
     * Can continue ?
     *
     * @return boolean
     */
    public function canContinue()
    {
        return ($this->jobq_nb_retry < $this->jobq_max_retry);
    }

    /**
     * Set finished
     *
     * @return \FreeFW\Model\Jobqueue
     */
    public function finished()
    {
        if ($this->getJobqType() === self::TYPE_ONCE) {
            $this->setJobqStatus(self::STATUS_FINISHED);
        } else {
            $this->setJobqStatus(self::STATUS_WAITING);
            $cronTab = $this->getJobqCron();
            if ($cronTab == '') {
                $this->setJobqNextRetry(
                    \FreeFW\Tools\Date::getCurrentTimestamp($this->getJobqNextMinutes())
                );
            } else {
                try {
                    $cron    = new \Cron\CronExpression($cronTab);
                    $mysqlDt = $cron->getNextRunDate()->format('Y-m-d H:i:s');
                    $this->setJobqNextRetry($mysqlDt);
                } catch (\Exception $ex) {
                }
            }
        }
        return $this;
    }

    /**
     * Execute jobqueue
     *
     * @return \FreeFW\Model\Jobqueue
     */
    public function run()
    {
        /**
         * @var \FreeSSO\Server $sso
         */
        $sso = \FreeFW\DI\DI::getShared('sso');
        $grp = $sso->getUserGroup();
        $usr = $sso->getUser();
        try {
            $this
                ->setJobqStatus(self::STATUS_PENDING)
                ->setJobqLastReport(null)
                ->setJobqLastTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->save();
            /**
             *
             * @var \FreeFW\Core\Service $service
             */
            $service = \FreeFW\DI\DI::get($this->getJobqService());
            if ($service) {
                $method = $this->getJobqMethod();
                if (method_exists($service, $method)) {
                    $params = json_decode($this->getJobqParams(), true);
                    if (!is_array($params)) {
                        $params = [];
                    }
                    $service->setLogger($this);
                    $newUser  = $this->getUser();
                    if (!$newUser) {
                        $newUser = $usr;
                    }
                    $newGroup = $this->getGroup();
                    if (!$newGroup) {
                        $newGroup = $grp;
                    }
                    $sso->forceUser($newUser, $newGroup);
                    $defaultErroMessage = 'Unknown Error';
                    try {
                        $result = call_user_func_array(
                            [$service, $method],
                            ['params' => $params, 'user' => $this->getUserId(), 'group' => $this->getGrpId()]
                        );
                    } catch (\Exception $ex) {
                        $result = false;
                        $defaultErroMessage = $ex->getMessage();
                    }
                    $sso->forceUser($usr, $grp);
                    $email = false;
                    if (isset($params['report_email'])) {
                        $email = $params['report_email'];
                    }
                    if ($result === false) {
                        $this
                            ->setJobqStatus(self::STATUS_ERROR)
                            ->setJobqLastReport($defaultErroMessage)
                            ->save();
                        if ($email) {
                            $message = \FreeFW\Model\Message::getFactory('FreeFW_Jobqueue', $this->getJobqId());
                            $message
                                ->setMsgSubject('ERROR ' . $this->getJobqName())
                                ->setMsgBody($defaultErroMessage)
                                ->addDest($email)
                                ->create();
                        }
                    } else {
                        if (is_array($result)) {
                            $this->setJobqParams(json_encode($result));
                        }
                        $this
                            ->finished()
                            ->setJobqLastReport($this->getLogs())
                            ->setJobqNbRetry(0)
                            ->save();
                        if ($email) {
                            $message = \FreeFW\Model\Message::getFactory('FreeFW_Jobqueue', $this->getJobqId());
                            $message
                                ->setMsgSubject($this->getJobqName())
                                ->setMsgBody($this->getJobqLastReport())
                                ->addDest($email)
                                ->create();
                        }
                    }
                } else {
                    $this
                        ->setJobqStatus(self::STATUS_ERROR)
                        ->setJobqLastReport('Unknown method in service !')
                        ->save();
                    $message = \FreeFW\Model\Message::getFactory('FreeFW_Jobqueue', $this->getJobqId());
                    $message
                        ->setMsgSubject($this->getJobqName())
                        ->setMsgBody('Unknown method in service !')
                        ->addDest('jeromeklam@free.fr')
                        ->create();
                }
            } else {
                $this
                    ->setJobqStatus(self::STATUS_ERROR)
                    ->setJobqLastReport('Unknown service !')
                    ->save();
                $message = \FreeFW\Model\Message::getFactory('FreeFW_Jobqueue', $this->getJobqId());
                $message
                    ->setMsgSubject($this->getJobqName())
                    ->setMsgBody('Unknown service !')
                    ->addDest('jeromeklam@free.fr')
                    ->create();
            }
        } catch (\Exception $ex) {
            $sso->forceUser($usr, $grp);
            if ($this->canContinue()) {
                $this->setJobqStatus(self::STATUS_RETRY);
            } else {
                $this->setJobqStatus(self::STATUS_ERROR);
            }
            $this
                ->setJobqLastReport(print_r($ex, true))
                ->incrementTry()
                ->save();
            $message = \FreeFW\Model\Message::getFactory('FreeFW_Jobqueue', $this->getJobqId());
            $message
                ->setMsgSubject($this->getJobqName())
                ->setMsgBody(print_r($ex, true))
                ->addDest('jeromeklam@free.fr')
                ->create();
        }
        return $this;
    }

    /**
     * Reset jobqueue
     *
     * @return \FreeFW\Model\Jobqueue
     */
    public function reset()
    {
        try {
            $this
                ->setJobqStatus(self::STATUS_WAITING)
                ->save();
        } catch (\Exception $ex) {
            // @TODO
        }
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function beforeRemove()
    {
        $histos = \FreeFW\Model\JobqueueHisto::find(['jobq_id' => $this->getJobqId()]);
        foreach ($histos as $oneHisto) {
            $oneHisto->remove();
        }
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function beforeSave()
    {
        $this->setJobqLastTs(\FreeFW\Tools\Date::getCurrentTimestamp());
        return true;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::critical()
     */
    public function critical($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::CRITICAL, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::log()
     */
    public function log($level, $message, array $context = [])
    {
        $this->logs[] = [
            'level' => $level,
            'message' => print_r($message, true)
        ];
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::emergency()
     */
    public function emergency($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::EMERGENCY, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::error()
     */
    public function error($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::ERROR, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::alert()
     */
    public function alert($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::ALERT, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::warning()
     */
    public function warning($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::WARNING, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::notice()
     */
    public function notice($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::NOTICE, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::info()
     */
    public function info($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::INFO, $message, $context);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Psr\Log\LoggerInterface::debug()
     */
    public function debug($message, array $context = [])
    {
        $this->log(\Psr\Log\LogLevel::DEBUG, $message, $context);
    }

    /**
     * Add to history
     *
     * @return \FreeFW\Model\Jobqueue
     */
    public function addToHistory()
    {
        /**
         *
         * @var \FreeFW\Model\JobqueueHisto $histo
         */
        $histo = \FreeFW\DI\DI::get('FreeFW::Model::JobqueueHisto');
        $histo
            ->setJobqhTs($this->getJobqTs())
            ->setJobqhMsg($this->getJobqLastReport())
            ->setJobqId($this->getJobqId())
            ->setJobqhStatus($this->getJobqStatus());
        $histo->create(true, true);
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Model\Base\Jobqueue::getJobqLastReport()
     */
    public function getJobqLastReport()
    {
        if (is_array($this->jobq_last_report)) {
            return implode("\n", $this->jobq_last_report);
        }
        return $this->jobq_last_report;
    }

    /**
     * Get factory
     *
     * @param string $p_name
     * @param string $p_service
     * @param string $p_method
     * @param array  $p_params
     * 
     * @return \FreeFW\Model\Base\Jobqueue
     */
    public static function getFactory($p_name, $p_service, $p_method, $p_params = [])
    {
        $jobqueue = new self();
        $jobqueue
            ->setJobqName($p_name)
            ->setJobqService($p_service)
            ->setJobqMethod($p_method)
            ->setJobqStatus(self::STATUS_WAITING)
            ->setJobqNbRetry(1)
            ->setJobqNextRetry(\FreeFW\Tools\Date::getCurrentTimestamp())
            ->setJobqMaxHour(24)
            ->setJobqDesc('<p>' . $p_name . '<p/>')
            ->setJobqType(self::TYPE_ONCE)
            ->setJobqParams(json_encode($p_params))
        ;
        return $jobqueue;
    }
}
