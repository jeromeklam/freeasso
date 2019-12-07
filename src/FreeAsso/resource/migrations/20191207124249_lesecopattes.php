<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Lesecopattes extends Phinx\Migration\AbstractMigration
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
            ->addColumn('site_code_ex', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_coord',
            ])
            ->addColumn('site_string_5', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_code_ex',
            ])
            ->addColumn('site_string_6', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_5',
            ])
            ->addColumn('site_number_5', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'site_string_6',
            ])
            ->addColumn('site_number_6', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'site_number_5',
            ])
            ->addColumn('site_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_number_6',
            ])
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
            ->addColumn('cau_sex', 'enum', [
                'null' => true,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['M', 'F', 'OTHER'],
                'after' => 'cau_family',
            ])
            ->changeColumn('cau_string_1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_sex',
            ])
            ->changeColumn('cau_string_2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_string_1',
            ])
            ->changeColumn('cau_string_3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_string_2',
            ])
            ->changeColumn('cau_string_4', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_string_3',
            ])
            ->changeColumn('cau_number_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_string_4',
            ])
            ->changeColumn('cau_number_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_number_1',
            ])
            ->changeColumn('cau_number_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_number_2',
            ])
            ->changeColumn('cau_number_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_number_3',
            ])
            ->changeColumn('cau_date_1', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_number_4',
            ])
            ->changeColumn('cau_date_2', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_date_1',
            ])
            ->changeColumn('cau_date_3', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_date_2',
            ])
            ->changeColumn('cau_date_4', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_date_3',
            ])
            ->changeColumn('cau_text_1', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_date_4',
            ])
            ->changeColumn('cau_text_2', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_text_1',
            ])
            ->changeColumn('cau_text_3', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_text_2',
            ])
            ->changeColumn('cau_text_4', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_text_3',
            ])
            ->changeColumn('cau_bool_1', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_text_4',
            ])
            ->changeColumn('cau_bool_2', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_bool_1',
            ])
            ->changeColumn('cau_bool_3', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_bool_2',
            ])
            ->changeColumn('cau_bool_4', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_bool_3',
            ])
            ->changeColumn('cau_coord', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_bool_4',
            ])
            ->addColumn('parent1_cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_coord',
            ])
            ->addColumn('parent2_cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'parent1_cau_id',
            ])
            ->addForeignKey('parent1_cau_id', 'fk_cause_cause_parent1', 'cau_id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addForeignKey('parent2_cau_id', 'fk_cause_cause_parent2', 'cau_id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
