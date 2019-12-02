<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Emails extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->table('core_email', [
                'id' => false,
                'primary_key' => ['email_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('email_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'email_id',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('email_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('email_subject', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'email_code',
            ])
            ->addColumn('email_body', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'email_subject',
            ])
            ->addColumn('email_from', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'email_body',
            ])
            ->addColumn('email_from_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'email_from',
            ])
            ->addColumn('email_reply_to', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'email_from_name',
            ])
            ->addForeignKey('brk_id', 'fk_email_broker', 'brk_id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lang_id', 'fk_email_lang', 'lang_id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
