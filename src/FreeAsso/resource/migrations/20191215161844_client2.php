<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Client2 extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->table('sso_autologin_cookie', [
                'id' => false,
                'primary_key' => ['auto_cookie'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->changeColumn('auto_cookie', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 128,
                'collation' => 'latin1_swedish_ci',
                'encoding' => 'latin1',
                'after' => 'user_id',
            ])
            ->addColumn('auto_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'auto_ip',
            ])
            ->addColumn('auto_expire', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'auto_ts',
            ])
            ->removeColumn('auto_paswd')
            ->save();
        $this->table('crm_client', [
                'id' => false,
                'primary_key' => ['cli_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->changeColumn('cnty_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_town',
            ])
            ->changeColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_active',
            ])
            ->addIndex(['cnty_id'], [
                'name' => 'fk_client_country',
                'unique' => false,
            ])
            ->save();
    }
}
