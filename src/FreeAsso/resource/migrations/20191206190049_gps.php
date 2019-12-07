<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Gps extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->table('asso_site', [
                'id' => false,
                'primary_key' => ['site_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('site_coord', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_bool_4',
            ])
            ->save();
        $this->table('core_email', [
                'id' => false,
                'primary_key' => ['email_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('email_from_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'email_from',
            ])
            ->removeColumn('email_form_name')
            ->save();
        $this->table('asso_cause', [
                'id' => false,
                'primary_key' => ['cau_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cau_coord', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_bool_4',
            ])
            ->save();
    }
}
