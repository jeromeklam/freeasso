<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model AccountingHeader
 *
 * @author jeromeklam
 */
class AccountingHeader extends \FreeAsso\Model\Base\AccountingHeader
{

    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * Status
     */
    const STATUS_WAITING  = 'WAITING';
    const STATUS_IMPORTED = 'IMPORTED';
    const STATUS_PENDING  = 'PENDING';
    const STATUS_DONE     = 'DONE';
    const STATUS_NONE     = 'NONE';

    /**
     * Init content
     *
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function initContent()
    {
        $this->acch_content = null;
        return $this;
    }

    /**
     * Add line to co,ntent
     *
     * @param string $p_line
     * 
     * @return \FreeAsso\Model\AccountingHeader
     */
    public function addLineToContent($p_line)
    {
        if ($this->acch_content === null) {
            $this->acch_content = '';
        } else {
            $this->acch_content .= PHP_EOL;
        }
        $this->acch_content .= $p_line;
        return $this;
    }
}
 