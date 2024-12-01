<?php
namespace FreeSSO\Storage\Migrations\V20201206091000;

/**
 *
 * @author jeromeklam
 *
 */
class Database extends \FreeFW\Storage\Migrations\AbstractMigration
{

    /**
     * Update default group for all users
     */
    public function updateDefaultGroup()
    {
        $users = \FreeSSO\Model\User::find();
        foreach ($users as $oneUser) {
            $brokers = \FreeSSO\Model\UserBroker::find(['user_id' => $oneUser->getUserId()]);
            foreach ($brokers as $oneBroker) {
                $broker = \FreeSSO\Model\Broker::findFirst(['brk_id' => $oneBroker->getBrkId()]);
                if ($broker) {
                    $conditions = new \FreeFW\Model\Conditions();
                    $conditions->initFromArray(
                        [
                            'group.grp_realm_id' => $broker->getGrpId(),
                            'user_id'            => $oneUser->getUserId()
                        ]
                    );
                    $model  = \FreeFW\DI\DI::get('FreeSSO::Model::GroupUser');
                    $query  = $model->getQuery();
                    $rels   = [];
                    $rels[] = 'group';
                    $query
                        ->addConditions($conditions)
                        ->addRelations($rels)
                    ;
                    if ($query->execute()) {
                        foreach ($query->getResult() as $line) {
                            $oneBroker->setGrpId($line->getGrpId());
                            $oneBroker->save();
                            break;
                        }
                    }
                }
            }
        }
    }

    /**
     *
     * @return bool
     */
    public function up() : bool
    {
        $this->sqlUp();
        $this->updateDefaultGroup();
        return true;
    }

    /**
     *
     * @return bool
     */
    public function down() : bool
    {
        return true;
    }
}
