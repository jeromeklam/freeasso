<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Initial extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->execute("ALTER DATABASE CHARACTER SET 'utf8';");
        $this->execute("ALTER DATABASE COLLATE='utf8_general_ci';");
        $this->table('asso_site_media', [
                'id' => false,
                'primary_key' => ['sitm_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sitm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('site_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sitm_id',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_id',
            ])
            ->addColumn('sitm_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('sitm_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['PHOTO', 'NEWS', 'HTML', 'OTHER'],
                'after' => 'sitm_code',
            ])
            ->addColumn('sitm_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sitm_type',
            ])
            ->addColumn('sitm_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sitm_ts',
            ])
            ->addColumn('sitm_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sitm_from',
            ])
            ->addColumn('sitm_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sitm_to',
            ])
            ->addColumn('sitm_short_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sitm_text',
            ])
            ->addColumn('sitm_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'sitm_short_text',
            ])
            ->addColumn('sitm_short_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_REGULAR,
                'after' => 'sitm_blob',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sitm_short_blob',
            ])
            ->addColumn('sitm_order', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'lang_id',
            ])
            ->addColumn('sitm_title', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sitm_order',
            ])
            ->addIndex(['site_id'], [
                'name' => 'fk_cause_media_cause',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_site_media_broker',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_site_media_lang',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_link_type', [
                'id' => false,
                'primary_key' => ['cault_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cault_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('cault_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cault_id',
            ])
            ->addColumn('ref_cault_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cault_name',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'ref_cault_id',
            ])
            ->addColumn('cault_family', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['OTHER'],
                'after' => 'brk_id',
            ])
            ->create();
        $this->table('asso_site', [
                'id' => false,
                'primary_key' => ['site_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('site_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_id',
            ])
            ->addColumn('sitt_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('site_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sitt_id',
            ])
            ->addColumn('site_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'site_name',
            ])
            ->addColumn('site_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'site_from',
            ])
            ->addColumn('site_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_to',
            ])
            ->addColumn('site_address1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_code',
            ])
            ->addColumn('site_address2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_address1',
            ])
            ->addColumn('site_address3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_address2',
            ])
            ->addColumn('site_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_address3',
            ])
            ->addColumn('site_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_cp',
            ])
            ->addColumn('owner_cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_town',
            ])
            ->addColumn('sanit_cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'owner_cli_id',
            ])
            ->addColumn('parent_site_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sanit_cli_id',
            ])
            ->addColumn('site_area', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'parent_site_id',
            ])
            ->addColumn('site_position', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'site_area',
            ])
            ->addColumn('site_plots', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_position',
            ])
            ->addColumn('site_left', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_plots',
            ])
            ->addColumn('site_right', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_left',
            ])
            ->addColumn('site_level', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_right',
            ])
            ->addColumn('site_string_1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_level',
            ])
            ->addColumn('site_string_2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_1',
            ])
            ->addColumn('site_string_3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_2',
            ])
            ->addColumn('site_string_4', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_3',
            ])
            ->addColumn('site_string_5', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_4',
            ])
            ->addColumn('site_string_6', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_5',
            ])
            ->addColumn('site_string_7', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_6',
            ])
            ->addColumn('site_string_8', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_string_7',
            ])
            ->addColumn('site_number_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'site_string_8',
            ])
            ->addColumn('site_number_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'site_number_1',
            ])
            ->addColumn('site_number_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'site_number_2',
            ])
            ->addColumn('site_number_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'site_number_3',
            ])
            ->addColumn('site_number_5', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'site_number_4',
            ])
            ->addColumn('site_number_6', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'site_number_5',
            ])
            ->addColumn('site_date_1', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'site_number_6',
            ])
            ->addColumn('site_date_2', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'site_date_1',
            ])
            ->addColumn('site_date_3', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'site_date_2',
            ])
            ->addColumn('site_date_4', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'site_date_3',
            ])
            ->addColumn('site_text_1', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_date_4',
            ])
            ->addColumn('site_text_2', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_text_1',
            ])
            ->addColumn('site_text_3', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_text_2',
            ])
            ->addColumn('site_text_4', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_text_3',
            ])
            ->addColumn('site_bool_1', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'site_text_4',
            ])
            ->addColumn('site_bool_2', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'site_bool_1',
            ])
            ->addColumn('site_bool_3', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'site_bool_2',
            ])
            ->addColumn('site_bool_4', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'site_bool_3',
            ])
            ->addColumn('site_coord', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_bool_4',
            ])
            ->addColumn('site_code_ex', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_coord',
            ])
            ->addColumn('site_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_code_ex',
            ])
            ->addColumn('site_conform', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'site_desc',
            ])
            ->addColumn('site_conform_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'site_conform',
            ])
            ->addIndex(['site_name', 'brk_id'], [
                'name' => 'ix_site_site_name',
                'unique' => true,
            ])
            ->addIndex(['sitt_id'], [
                'name' => 'fk_site_site_type',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_site_broker',
                'unique' => false,
            ])
            ->addIndex(['owner_cli_id'], [
                'name' => 'fk_site_owner',
                'unique' => false,
            ])
            ->addIndex(['sanit_cli_id'], [
                'name' => 'fk_site_sanitary',
                'unique' => false,
            ])
            ->addIndex(['parent_site_id'], [
                'name' => 'fk_site_parent',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_structure', [
                'id' => false,
                'primary_key' => ['str_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('str_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'application',
                'after' => 'str_id',
            ])
            ->addColumn('str_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom',
                'after' => 'brk_id',
            ])
            ->addColumn('str_left', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'comment' => 'nested tree left',
                'after' => 'str_name',
            ])
            ->addColumn('str_right', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'comment' => 'nested tree right',
                'after' => 'str_left',
            ])
            ->addColumn('str_level', 'integer', [
                'null' => false,
                'limit' => '9',
                'comment' => 'nested tree level',
                'after' => 'str_right',
            ])
            ->addColumn('str_parent_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'str_level',
            ])
            ->addColumn('str_type', 'enum', [
                'null' => true,
                'default' => '\'TREE\'',
                'limit' => 4,
                'values' => ['TREE', 'TECH'],
                'comment' => 'Type de structure',
                'after' => 'str_parent_id',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_structure_broker',
                'unique' => false,
            ])
            ->addIndex(['str_parent_id'], [
                'name' => 'fk_structure_structure',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_job_function', [
                'id' => false,
                'primary_key' => ['fct_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('fct_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('fct_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'fct_id',
            ])
            ->addColumn('fct_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'fct_code',
            ])
            ->addColumn('fct_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'fct_name',
            ])
            ->addColumn('fct_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'fct_from',
            ])
            ->create();
        $this->table('tech_poolservice', [
                'id' => false,
                'primary_key' => ['tpl_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('tpl_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pool_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'tpl_id',
            ])
            ->addColumn('serv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pool_id',
            ])
            ->addColumn('tpl_mode', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_id',
            ])
            ->addColumn('tpl_status', 'string', [
                'null' => false,
                'default' => '\'OK\'',
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'tpl_mode',
            ])
            ->create();
        $this->table('crm_alert', [
                'id' => false,
                'primary_key' => ['alert_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('alert_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'alert_id',
            ])
            ->addColumn('site_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_id',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('alert_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_id',
            ])
            ->addColumn('alert_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'alert_from',
            ])
            ->addColumn('alert_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'alert_to',
            ])
            ->addColumn('alert_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'alert_ts',
            ])
            ->addColumn('alert_activ', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'alert_text',
            ])
            ->addColumn('alert_priority', 'enum', [
                'null' => false,
                'default' => '\'NONE\'',
                'limit' => 11,
                'values' => ['IMPORTANT', 'CRITICAL', 'INFORMATION', 'NONE'],
                'after' => 'alert_activ',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_alert_broker',
                'unique' => false,
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_alert_cause',
                'unique' => false,
            ])
            ->addIndex(['site_id'], [
                'name' => 'fk_alert_site',
                'unique' => false,
            ])
            ->addIndex(['cli_id'], [
                'name' => 'fk_alert_client',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_pool', [
                'id' => false,
                'primary_key' => ['pool_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('pool_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pool_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'pool_id',
            ])
            ->addColumn('pool_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'pool_name',
            ])
            ->addColumn('pool_status', 'string', [
                'null' => false,
                'default' => '\'OK\'',
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'pool_desc',
            ])
            ->create();
        $this->table('asso_cause_growth', [
                'id' => false,
                'primary_key' => ['grow_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('grow_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grow_id',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('grow_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'cau_id',
            ])
            ->addColumn('grow_weight', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '5',
                'scale' => '2',
                'after' => 'grow_ts',
            ])
            ->addColumn('grow_height', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '5',
                'scale' => '2',
                'after' => 'grow_weight',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_growth_broker',
                'unique' => false,
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_cause_growth_cause',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_sickness', [
                'id' => false,
                'primary_key' => ['caus_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('caus_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caus_id',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('sick_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('caus_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sick_id',
            ])
            ->addColumn('caus_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'caus_from',
            ])
            ->addColumn('sanitary_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caus_to',
            ])
            ->addColumn('caus_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sanitary_id',
            ])
            ->addColumn('caus_where', 'enum', [
                'null' => false,
                'default' => '\'SITE\'',
                'limit' => 8,
                'values' => ['SITE', 'SANITARY', 'OTHER'],
                'after' => 'caus_desc',
            ])
            ->addColumn('caus_care', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 8,
                'values' => ['DRUG', 'SANITARY', 'OTHER'],
                'after' => 'caus_where',
            ])
            ->addColumn('caus_care_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caus_care',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_sickness_broker',
                'unique' => false,
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_cause_sickness_cause',
                'unique' => false,
            ])
            ->addIndex(['sick_id'], [
                'name' => 'fk_cause_sickness_sickness',
                'unique' => false,
            ])
            ->addIndex(['sanitary_id'], [
                'name' => 'fk_cause_sickness_sanitary',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_sponsorship', [
                'id' => false,
                'primary_key' => ['spo_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('spo_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'spo_id',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('spo_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_id',
            ])
            ->addColumn('spo_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'spo_from',
            ])
            ->addColumn('spo_mnt', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '2',
                'comment' => 'cents',
                'after' => 'spo_to',
            ])
            ->addColumn('spo_money', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'spo_mnt',
            ])
            ->addColumn('spo_freq', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['MONTH', 'YEAR', 'OTHER'],
                'after' => 'spo_money',
            ])
            ->addColumn('spo_freq_when', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '4',
                'after' => 'spo_freq',
            ])
            ->addColumn('spo_freq_detail', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'spo_freq_when',
            ])
            ->addColumn('ptyp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'spo_freq_detail',
            ])
            ->addColumn('spo_sponsors', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ptyp_id',
            ])
            ->addColumn('spo_display_site', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'spo_sponsors',
            ])
            ->addColumn('spo_send_news', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'spo_display_site',
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_sponsorship_cause',
                'unique' => false,
            ])
            ->addIndex(['cli_id'], [
                'name' => 'fk_sponsorship_client',
                'unique' => false,
            ])
            ->addIndex(['ptyp_id'], [
                'name' => 'fk_sponsorship_payement_type',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_sponsorship_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('crm_client', [
                'id' => false,
                'primary_key' => ['cli_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_id',
            ])
            ->addColumn('clic_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('clit_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'clic_id',
            ])
            ->addColumn('cli_gender', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'clit_id',
            ])
            ->addColumn('cli_firstname', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_gender',
            ])
            ->addColumn('cli_lastname', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_firstname',
            ])
            ->addColumn('cli_address1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_lastname',
            ])
            ->addColumn('cli_address2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_address1',
            ])
            ->addColumn('cli_address3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_address2',
            ])
            ->addColumn('cli_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_address3',
            ])
            ->addColumn('cli_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_cp',
            ])
            ->addColumn('cnty_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_town',
            ])
            ->addColumn('cli_active', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'after' => 'cnty_id',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_active',
            ])
            ->addColumn('cli_prefs', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('cli_avatar', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_REGULAR,
                'after' => 'cli_prefs',
            ])
            ->addColumn('cli_phone_home', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_avatar',
            ])
            ->addColumn('cli_phone_gsm', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_phone_home',
            ])
            ->addColumn('cli_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_phone_gsm',
            ])
            ->addColumn('cli_email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_desc',
            ])
            ->addColumn('cli_email_2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_email',
            ])
            ->addColumn('cli_email_refused', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_email_2',
            ])
            ->addColumn('cli_receipt', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_email_refused',
            ])
            ->addColumn('cli_certificat', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_receipt',
            ])
            ->addColumn('cli_extern_id', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_certificat',
            ])
            ->addColumn('cli_sponsor_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_extern_id',
            ])
            ->addColumn('last_don_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_sponsor_id',
            ])
            ->addColumn('cli_string_1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'last_don_id',
            ])
            ->addColumn('cli_string_2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_string_1',
            ])
            ->addColumn('cli_string_3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_string_2',
            ])
            ->addColumn('cli_string_4', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_string_3',
            ])
            ->addColumn('cli_number_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cli_string_4',
            ])
            ->addColumn('cli_number_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cli_number_1',
            ])
            ->addColumn('cli_number_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cli_number_2',
            ])
            ->addColumn('cli_number_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cli_number_3',
            ])
            ->addColumn('cli_date_1', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_number_4',
            ])
            ->addColumn('cli_date_2', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_date_1',
            ])
            ->addColumn('cli_date_3', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_date_2',
            ])
            ->addColumn('cli_date_4', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_date_3',
            ])
            ->addColumn('cli_text_1', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_date_4',
            ])
            ->addColumn('cli_text_2', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_text_1',
            ])
            ->addColumn('cli_text_3', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_text_2',
            ])
            ->addColumn('cli_text_4', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_text_3',
            ])
            ->addColumn('cli_bool_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_text_4',
            ])
            ->addColumn('cli_bool_2', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_bool_1',
            ])
            ->addColumn('cli_bool_3', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_bool_2',
            ])
            ->addColumn('cli_bool_4', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_bool_3',
            ])
            ->addColumn('cli_display_site', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_bool_4',
            ])
            ->addColumn('cli_send_news', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cli_display_site',
            ])
            ->addColumn('cli_coord', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_send_news',
            ])
            ->addColumn('cli_siren', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_coord',
            ])
            ->addColumn('cli_siret', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cli_siren',
            ])
            ->addIndex(['cnty_id'], [
                'name' => 'fk_client_country',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_client_broker',
                'unique' => false,
            ])
            ->addIndex(['clit_id'], [
                'name' => 'fk_client_client_type',
                'unique' => false,
            ])
            ->addIndex(['clic_id'], [
                'name' => 'fk_client_client_category',
                'unique' => false,
            ])
            ->addIndex(['cli_firstname', 'cli_lastname'], [
                'name' => 'idx1_client_fullname',
                'unique' => false,
            ])
            ->addIndex(['last_don_id'], [
                'name' => 'fk_client_donation',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_media', [
                'id' => false,
                'primary_key' => ['caum_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('caum_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caum_id',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('caum_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('caum_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['PHOTO', 'NEWS', 'HTML', 'OTHER'],
                'after' => 'caum_code',
            ])
            ->addColumn('caum_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'caum_type',
            ])
            ->addColumn('caum_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'caum_ts',
            ])
            ->addColumn('caum_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'caum_from',
            ])
            ->addColumn('caum_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caum_to',
            ])
            ->addColumn('caum_short_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caum_text',
            ])
            ->addColumn('caum_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'caum_short_text',
            ])
            ->addColumn('caum_short_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_REGULAR,
                'after' => 'caum_blob',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caum_short_blob',
            ])
            ->addColumn('caum_order', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'lang_id',
            ])
            ->addColumn('caum_title', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caum_order',
            ])
            ->addColumn('caum_public', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'after' => 'caum_title',
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_cause_media_cause',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_media_broker',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_cause_media_lang',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_autologin_cookie', [
                'id' => false,
                'primary_key' => ['auto_cookie'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
            ])
            ->addColumn('auto_cookie', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 128,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_id',
            ])
            ->addColumn('auto_ip', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'auto_cookie',
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
            ->create();
        $this->table('sso_user_broker', [
                'id' => false,
                'primary_key' => ['ubrk_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('ubrk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'ubrk_id',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('ubrk_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'user_id',
            ])
            ->addColumn('ubrk_partner_type', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ubrk_ts',
            ])
            ->addColumn('ubrk_partner_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'ubrk_partner_type',
            ])
            ->addColumn('ubrk_auth_method', 'string', [
                'null' => false,
                'default' => '\'AUTO\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ubrk_partner_id',
            ])
            ->addColumn('ubrk_auth_datas', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ubrk_auth_method',
            ])
            ->addColumn('ubrk_end', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'ubrk_auth_datas',
            ])
            ->addColumn('ubrk_config', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ubrk_end',
            ])
            ->addColumn('ubrk_cache', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ubrk_config',
            ])
            ->addIndex(['brk_id', 'user_id', 'ubrk_partner_type', 'ubrk_partner_id'], [
                'name' => 'sso_links_users_idx1',
                'unique' => true,
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_user_broker_user',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_site_type_data', [
                'id' => false,
                'primary_key' => ['sittd_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sittd_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('sitt_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sittd_id',
            ])
            ->addColumn('data_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sitt_id',
            ])
            ->addColumn('sittd_value', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'data_id',
            ])
            ->addColumn('sittd_position', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sittd_value',
            ])
            ->addColumn('sittd_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sittd_position',
            ])
            ->addColumn('sittd_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sittd_from',
            ])
            ->addIndex(['sitt_id'], [
                'name' => 'fk_site_type_data_site_type',
                'unique' => false,
            ])
            ->addIndex(['data_id'], [
                'name' => 'fk_site_type_data_data',
                'unique' => false,
            ])
            ->create();
        $this->table('sto_unit', [
                'id' => false,
                'primary_key' => ['unit_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('unit_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'unit_id',
            ])
            ->addColumn('unit_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('unit_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'unit_name',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_unit_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_user_token', [
                'id' => false,
                'primary_key' => ['utok_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('utok_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'utok_id',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'user_id',
            ])
            ->addColumn('utok_token', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('utok_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'utok_token',
            ])
            ->addColumn('utok_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'utok_from',
            ])
            ->addIndex(['utok_token'], [
                'name' => 'ix_user_token_token',
                'unique' => true,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_user_token_broker',
                'unique' => false,
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_user_token_user',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_site_type', [
                'id' => false,
                'primary_key' => ['sitt_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sitt_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sitt_id',
            ])
            ->addColumn('sitt_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('sitt_pattern', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sitt_name',
            ])
            ->addColumn('sitt_mask', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sitt_pattern',
            ])
            ->addColumn('sitt_string_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_mask',
            ])
            ->addColumn('sitt_string_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_1',
            ])
            ->addColumn('sitt_string_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_2',
            ])
            ->addColumn('sitt_string_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_3',
            ])
            ->addColumn('sitt_string_5', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_4',
            ])
            ->addColumn('sitt_string_6', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_5',
            ])
            ->addColumn('sitt_string_7', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_6',
            ])
            ->addColumn('sitt_string_8', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_7',
            ])
            ->addColumn('sitt_number_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_string_8',
            ])
            ->addColumn('sitt_number_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_number_1',
            ])
            ->addColumn('sitt_number_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_number_2',
            ])
            ->addColumn('sitt_number_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_number_3',
            ])
            ->addColumn('sitt_number_5', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_number_4',
            ])
            ->addColumn('sitt_number_6', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_number_5',
            ])
            ->addColumn('sitt_date_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_number_6',
            ])
            ->addColumn('sitt_date_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_date_1',
            ])
            ->addColumn('sitt_date_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_date_2',
            ])
            ->addColumn('sitt_date_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_date_3',
            ])
            ->addColumn('sitt_text_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_date_4',
            ])
            ->addColumn('sitt_text_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_text_1',
            ])
            ->addColumn('sitt_text_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_text_2',
            ])
            ->addColumn('sitt_text_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_text_3',
            ])
            ->addColumn('sitt_bool_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_text_4',
            ])
            ->addColumn('sitt_bool_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_bool_1',
            ])
            ->addColumn('sitt_bool_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_bool_2',
            ])
            ->addColumn('sitt_bool_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sitt_bool_3',
            ])
            ->addIndex(['sitt_name', 'brk_id'], [
                'name' => 'ix_site_type_sitt_name',
                'unique' => true,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_site_type_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_applicationversionjob', [
                'id' => false,
                'primary_key' => ['avj_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('avj_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('av_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'avj_id',
            ])
            ->addColumn('avj_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'av_id',
            ])
            ->addColumn('avj_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'avj_code',
            ])
            ->addColumn('avj_required', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'after' => 'avj_desc',
            ])
            ->create();
        $this->table('asso_data', [
                'id' => false,
                'primary_key' => ['data_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('data_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'data_id',
            ])
            ->addColumn('data_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('data_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'data_name',
            ])
            ->addColumn('data_type', 'enum', [
                'null' => false,
                'default' => '\'STRING\'',
                'limit' => 8,
                'values' => ['STRING', 'TEXT', 'NUMBER', 'BOOLEAN', 'DATE', 'DATETIME', 'LIST'],
                'after' => 'data_code',
            ])
            ->addColumn('data_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'data_type',
            ])
            ->addColumn('data_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'data_from',
            ])
            ->addColumn('data_content', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'data_to',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_data_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('pm_feature', [
                'id' => false,
                'primary_key' => ['feat_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('feat_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'feat_id',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('prj_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('feat_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'prj_id',
            ])
            ->addColumn('feat_short', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'feat_ts',
            ])
            ->addColumn('feat_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'feat_short',
            ])
            ->addColumn('feat_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'feat_desc',
            ])
            ->addColumn('feat_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'feat_from',
            ])
            ->addColumn('sta_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'feat_to',
            ])
            ->addColumn('sta_priority', 'integer', [
                'null' => false,
                'default' => '9',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sta_id',
            ])
            ->create();
        $this->table('wf_event', [
                'id' => false,
                'primary_key' => ['eve_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('eve_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('ctx_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du contexte',
                'after' => 'eve_id',
            ])
            ->addColumn('thm_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'signed' => false,
                'comment' => 'Identifiant du thème',
                'after' => 'ctx_id',
            ])
            ->addColumn('eve_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom du contexte (code)',
                'after' => 'thm_id',
            ])
            ->addColumn('eve_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'eve_name',
            ])
            ->addColumn('eve_app_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Code application d\'appartenance',
                'after' => 'eve_description',
            ])
            ->addColumn('eve_sys', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'comment' => 'Evénement système',
                'after' => 'eve_app_code',
            ])
            ->addIndex(['ctx_id'], [
                'name' => 'fk_event_context',
                'unique' => false,
            ])
            ->addIndex(['thm_id'], [
                'name' => 'fk_event_theme',
                'unique' => false,
            ])
            ->create();
        $this->table('wf_function', [
                'id' => false,
                'primary_key' => ['fct_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('fct_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('ctx_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du contexte',
                'after' => 'fct_id',
            ])
            ->addColumn('thm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du thème',
                'after' => 'ctx_id',
            ])
            ->addColumn('fct_name', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom de la fonction (code)',
                'after' => 'thm_id',
            ])
            ->addColumn('fct_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'fct_name',
            ])
            ->addColumn('fct_type', 'enum', [
                'null' => false,
                'default' => '\'WL\'',
                'limit' => 2,
                'values' => ['WL', 'WS'],
                'after' => 'fct_desc',
            ])
            ->addColumn('fct_data', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom de la fonction du service web, ...',
                'after' => 'fct_type',
            ])
            ->addColumn('fct_app_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Code application',
                'after' => 'fct_data',
            ])
            ->addColumn('fct_sys', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'comment' => 'Système',
                'after' => 'fct_app_code',
            ])
            ->addIndex(['ctx_id'], [
                'name' => 'fk_function_context',
                'unique' => false,
            ])
            ->addIndex(['thm_id'], [
                'name' => 'fk_function_theme',
                'unique' => false,
            ])
            ->create();
        $this->table('wf_place', [
                'id' => false,
                'primary_key' => ['plc_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('plc_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('wf_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du workflow',
                'after' => 'plc_id',
            ])
            ->addColumn('plc_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom de la place (code)',
                'after' => 'wf_id',
            ])
            ->addColumn('plc_libc', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 16,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Libellé court',
                'after' => 'plc_name',
            ])
            ->addColumn('plc_libl', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Libellé long',
                'after' => 'plc_libc',
            ])
            ->addColumn('plc_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'plc_libl',
            ])
            ->addColumn('plc_type', 'enum', [
                'null' => false,
                'default' => '\'INTERMEDIATE\'',
                'limit' => 12,
                'values' => ['START', 'END', 'INTERMEDIATE'],
                'comment' => 'Type de place',
                'after' => 'plc_desc',
            ])
            ->addColumn('eve_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'événement (START)',
                'after' => 'plc_type',
            ])
            ->addColumn('plc_x', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Position x en px',
                'after' => 'eve_id',
            ])
            ->addColumn('plc_y', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Position y en px',
                'after' => 'plc_x',
            ])
            ->addIndex(['wf_id'], [
                'name' => 'fk_place_workflow',
                'unique' => false,
            ])
            ->addIndex(['eve_id'], [
                'name' => 'fk_place_event',
                'unique' => false,
            ])
            ->create();
        $this->table('sto_item', [
                'id' => false,
                'primary_key' => ['item_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('item_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'item_id',
            ])
            ->addColumn('item_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('item_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'item_name',
            ])
            ->addColumn('item_barcode', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'item_code',
            ])
            ->addColumn('item_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'item_barcode',
            ])
            ->addColumn('item_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'item_from',
            ])
            ->addColumn('item_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'item_to',
            ])
            ->addColumn('item_stock', 'enum', [
                'null' => false,
                'default' => '\'NONE\'',
                'limit' => 5,
                'values' => ['STOCK', 'NONE'],
                'after' => 'item_desc',
            ])
            ->addColumn('item_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['DRUG', 'OTHER'],
                'after' => 'item_stock',
            ])
            ->addColumn('item_mark', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'item_type',
            ])
            ->addColumn('item_color', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'item_mark',
            ])
            ->addColumn('item_weight', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '14',
                'scale' => '2',
                'after' => 'item_color',
            ])
            ->addColumn('item_width', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '14',
                'scale' => '2',
                'after' => 'item_weight',
            ])
            ->addColumn('item_height', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '14',
                'scale' => '2',
                'after' => 'item_width',
            ])
            ->addColumn('item_depth', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '14',
                'scale' => '2',
                'after' => 'item_height',
            ])
            ->addColumn('item_dangerous', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'item_depth',
            ])
            ->addColumn('item_qte', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '8',
                'scale' => '6',
                'after' => 'item_dangerous',
            ])
            ->addColumn('item_min_qte', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '8',
                'scale' => '6',
                'after' => 'item_qte',
            ])
            ->addColumn('item_disposition', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'item_min_qte',
            ])
            ->addColumn('item_sto_unit_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'item_disposition',
            ])
            ->addColumn('item_sto_qte', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '8',
                'scale' => '6',
                'after' => 'item_sto_unit_id',
            ])
            ->addColumn('item_content_unit_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'item_sto_qte',
            ])
            ->addColumn('item_content_qte', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '8',
                'scale' => '6',
                'after' => 'item_content_unit_id',
            ])
            ->addColumn('fam_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'item_content_qte',
            ])
            ->addColumn('item_order', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fam_id',
            ])
            ->addColumn('default_provider_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'item_order',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_item_broker',
                'unique' => false,
            ])
            ->addIndex(['fam_id'], [
                'name' => 'fk_item_family',
                'unique' => false,
            ])
            ->addIndex(['item_sto_unit_id'], [
                'name' => 'fk_item_stock_unit',
                'unique' => false,
            ])
            ->addIndex(['item_content_unit_id'], [
                'name' => 'fk_item_content_unit',
                'unique' => false,
            ])
            ->addIndex(['default_provider_id'], [
                'name' => 'fk_item_default_provider',
                'unique' => false,
            ])
            ->create();
        $this->table('crm_client_data', [
                'id' => false,
                'primary_key' => ['cld_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cld_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cld_id',
            ])
            ->addColumn('clitd_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_id',
            ])
            ->addColumn('cld_valc', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'clitd_id',
            ])
            ->addColumn('cld_valt', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cld_valc',
            ])
            ->addColumn('cld_vali', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cld_valt',
            ])
            ->addColumn('cld_vald', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cld_vali',
            ])
            ->addIndex(['cli_id'], [
                'name' => 'fk_client_data_client',
                'unique' => false,
            ])
            ->addIndex(['clitd_id'], [
                'name' => 'fk_client_data_client_type_data',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_payment_type', [
                'id' => false,
                'primary_key' => ['ptyp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('ptyp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'ptyp_id',
            ])
            ->addColumn('ptyp_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('ptyp_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ptyp_code',
            ])
            ->addColumn('ptyp_receipt', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'ptyp_name',
            ])
            ->addColumn('ptyp_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'ptyp_receipt',
            ])
            ->addColumn('ptyp_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'ptyp_from',
            ])
            ->addIndex(['ptyp_name', 'brk_id', 'ptyp_to'], [
                'name' => 'ix_payment_type_ptyp_name',
                'unique' => true,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_payment_type_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('sys_rate', [
                'id' => false,
                'primary_key' => ['rate_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('rate_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('rate_money_from', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rate_id',
            ])
            ->addColumn('rate_money_to', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rate_money_from',
            ])
            ->addColumn('rate_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'rate_money_to',
            ])
            ->addColumn('rate_change', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '16',
                'scale' => '9',
                'after' => 'rate_ts',
            ])
            ->create();
        $this->table('sys_jobqueue', [
                'id' => false,
                'primary_key' => ['jobq_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('jobq_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'jobq_id',
            ])
            ->addColumn('jobq_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('jobq_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobq_name',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'jobq_desc',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('jobq_type', 'enum', [
                'null' => false,
                'default' => '\'ONCE\'',
                'limit' => 4,
                'values' => ['LOOP', 'ONCE'],
                'after' => 'user_id',
            ])
            ->addColumn('jobq_status', 'enum', [
                'null' => false,
                'default' => '\'WAITING\'',
                'limit' => 8,
                'values' => ['WAITING', 'FINISHED', 'ERROR', 'PENDING', 'RETRY'],
                'after' => 'jobq_type',
            ])
            ->addColumn('jobq_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'jobq_status',
            ])
            ->addColumn('jobq_last_report', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobq_ts',
            ])
            ->addColumn('jobq_last_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'jobq_last_report',
            ])
            ->addColumn('jobq_service', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobq_last_ts',
            ])
            ->addColumn('jobq_method', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobq_service',
            ])
            ->addColumn('jobq_params', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobq_method',
            ])
            ->addColumn('jobq_max_retry', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '4',
                'after' => 'jobq_params',
            ])
            ->addColumn('jobq_nb_retry', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '4',
                'after' => 'jobq_max_retry',
            ])
            ->addColumn('jobq_next_minutes', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'jobq_nb_retry',
            ])
            ->addColumn('jobq_next_retry', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'jobq_next_minutes',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_jobqueue_broker',
                'unique' => false,
            ])
            ->addIndex(['grp_id'], [
                'name' => 'fk_jobqueue_group',
                'unique' => false,
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_jobqueue_user',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_document_type_metadata', [
                'id' => false,
                'primary_key' => ['dtm_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dtm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('dtyp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du type de document',
                'after' => 'dtm_id',
            ])
            ->addColumn('meta_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de la métadonnée',
                'after' => 'dtyp_id',
            ])
            ->addColumn('dtm_required', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'comment' => 'Obligatoire ?',
                'after' => 'meta_id',
            ])
            ->addIndex(['dtyp_id'], [
                'name' => 'fk_document_type_metadata_document_type',
                'unique' => false,
            ])
            ->addIndex(['meta_id'], [
                'name' => 'fk_document_type_medatata_metadata',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_donation', [
                'id' => false,
                'primary_key' => ['don_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('don_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'don_id',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_id',
            ])
            ->addColumn('spo_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('don_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'spo_id',
            ])
            ->addColumn('don_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'don_desc',
            ])
            ->addColumn('don_ask_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'don_ts',
            ])
            ->addColumn('don_real_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'don_ask_ts',
            ])
            ->addColumn('don_end_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'don_real_ts',
            ])
            ->addColumn('don_status', 'enum', [
                'null' => false,
                'default' => '\'WAIT\'',
                'limit' => 4,
                'values' => ['WAIT', 'OK', 'NOK', 'NEXT'],
                'after' => 'don_end_ts',
            ])
            ->addColumn('don_mnt', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '2',
                'comment' => 'cents',
                'after' => 'don_status',
            ])
            ->addColumn('don_money', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'don_mnt',
            ])
            ->addColumn('don_mnt_input', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '2',
                'after' => 'don_money',
            ])
            ->addColumn('don_money_input', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'don_mnt_input',
            ])
            ->addColumn('ptyp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'don_money_input',
            ])
            ->addColumn('don_comment', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ptyp_id',
            ])
            ->addColumn('don_dstat', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'don_comment',
            ])
            ->addColumn('rec_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'don_dstat',
            ])
            ->addColumn('cert_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rec_id',
            ])
            ->addColumn('don_sponsors', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_id',
            ])
            ->addColumn('don_display_site', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'don_sponsors',
            ])
            ->addColumn('dono_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'don_display_site',
            ])
            ->addColumn('sess_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'dono_id',
            ])
            ->addIndex(['cli_id'], [
                'name' => 'fk_donation_client',
                'unique' => false,
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_donation_cause',
                'unique' => false,
            ])
            ->addIndex(['spo_id'], [
                'name' => 'fk_donation_sponsorship',
                'unique' => false,
            ])
            ->addIndex(['ptyp_id'], [
                'name' => 'fk_donation_payment_type',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_donation_broker',
                'unique' => false,
            ])
            ->addIndex(['cert_id'], [
                'name' => 'fk_donation_certificate',
                'unique' => false,
            ])
            ->addIndex(['dono_id'], [
                'name' => 'fk_donation_donation_origin',
                'unique' => false,
            ])
            ->addIndex(['sess_id'], [
                'name' => 'fk_donation_session',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_movement', [
                'id' => false,
                'primary_key' => ['camv_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('camv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'camv_id',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('camv_site_from_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('camv_site_to_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'camv_site_from_id',
            ])
            ->addColumn('camv_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'camv_site_to_id',
            ])
            ->addColumn('camv_start', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'camv_ts',
            ])
            ->addColumn('camv_to', 'timestamp', [
                'null' => false,
                'default' => '\'0000-00-00 00:00:00\'',
                'after' => 'camv_start',
            ])
            ->addColumn('camv_comment', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'camv_to',
            ])
            ->addColumn('camv_status', 'enum', [
                'null' => false,
                'default' => '\'OK\'',
                'limit' => 4,
                'values' => ['OK', 'WAIT', 'KO'],
                'after' => 'camv_comment',
            ])
            ->addColumn('move_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'camv_status',
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_cause_movement_cause',
                'unique' => false,
            ])
            ->addIndex(['camv_site_from_id'], [
                'name' => 'fk_cause_movement_site_from',
                'unique' => false,
            ])
            ->addIndex(['camv_site_to_id'], [
                'name' => 'fk_cause_movement_site_to',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_movement_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause', [
                'id' => false,
                'primary_key' => ['cau_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('caut_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('cau_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caut_id',
            ])
            ->addColumn('cau_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_name',
            ])
            ->addColumn('cau_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_desc',
            ])
            ->addColumn('cau_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_from',
            ])
            ->addColumn('cau_public', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_to',
            ])
            ->addColumn('cau_available', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_public',
            ])
            ->addColumn('sspe_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_available',
            ])
            ->addColumn('site_id', 'biginteger', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sspe_id',
            ])
            ->addColumn('orig_cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'site_id',
            ])
            ->addColumn('rais_cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'orig_cli_id',
            ])
            ->addColumn('cau_mnt', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '6',
                'comment' => 'cents',
                'after' => 'rais_cli_id',
            ])
            ->addColumn('cau_mnt_left', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '6',
                'after' => 'cau_mnt',
            ])
            ->addColumn('cau_money', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_mnt_left',
            ])
            ->addColumn('cau_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_money',
            ])
            ->addColumn('cau_family', 'enum', [
                'null' => false,
                'default' => '\'NONE\'',
                'limit' => 13,
                'values' => ['OTHER', 'NONE', 'ANIMAL', 'FOREST', 'NATURE', 'ADMINISTRATIV'],
                'after' => 'cau_code',
            ])
            ->addColumn('cau_sex', 'enum', [
                'null' => true,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['M', 'F', 'OTHER'],
                'after' => 'cau_family',
            ])
            ->addColumn('cau_year', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cau_sex',
            ])
            ->addColumn('cau_string_1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_year',
            ])
            ->addColumn('cau_string_2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_string_1',
            ])
            ->addColumn('cau_string_3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_string_2',
            ])
            ->addColumn('cau_string_4', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_string_3',
            ])
            ->addColumn('cau_number_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_string_4',
            ])
            ->addColumn('cau_number_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_number_1',
            ])
            ->addColumn('cau_number_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_number_2',
            ])
            ->addColumn('cau_number_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '10',
                'after' => 'cau_number_3',
            ])
            ->addColumn('cau_date_1', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_number_4',
            ])
            ->addColumn('cau_date_2', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_date_1',
            ])
            ->addColumn('cau_date_3', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_date_2',
            ])
            ->addColumn('cau_date_4', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cau_date_3',
            ])
            ->addColumn('cau_text_1', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_date_4',
            ])
            ->addColumn('cau_text_2', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_text_1',
            ])
            ->addColumn('cau_text_3', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_text_2',
            ])
            ->addColumn('cau_text_4', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cau_text_3',
            ])
            ->addColumn('cau_bool_1', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_text_4',
            ])
            ->addColumn('cau_bool_2', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_bool_1',
            ])
            ->addColumn('cau_bool_3', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_bool_2',
            ])
            ->addColumn('cau_bool_4', 'boolean', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cau_bool_3',
            ])
            ->addColumn('cau_coord', 'string', [
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
            ->addColumn('caum_text_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'parent2_cau_id',
            ])
            ->addColumn('caum_blob_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caum_text_id',
            ])
            ->addIndex(['cau_name', 'brk_id', 'cau_to'], [
                'name' => 'ix_cause_cause_name',
                'unique' => true,
            ])
            ->addIndex(['caut_id'], [
                'name' => 'fk_cause_cause_type',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_broker',
                'unique' => false,
            ])
            ->addIndex(['site_id'], [
                'name' => 'fk_cause_site',
                'unique' => false,
            ])
            ->addIndex(['parent1_cau_id'], [
                'name' => 'fk_cause_cause_parent1',
                'unique' => false,
            ])
            ->addIndex(['parent2_cau_id'], [
                'name' => 'fk_cause_cause_parent2',
                'unique' => false,
            ])
            ->addIndex(['orig_cli_id'], [
                'name' => 'fk_cause_proprietary',
                'unique' => false,
            ])
            ->addIndex(['caum_blob_id'], [
                'name' => 'fk_cause_cause_media_blob',
                'unique' => false,
            ])
            ->addIndex(['caum_text_id'], [
                'name' => 'fk_cause_cause_media_text',
                'unique' => false,
            ])
            ->addIndex(['rais_cli_id'], [
                'name' => 'fk_cause_raiser',
                'unique' => false,
            ])
            ->addIndex(['sspe_id'], [
                'name' => 'fk_cause_subspecies',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_group_user', [
                'id' => false,
                'primary_key' => ['gru_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('gru_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'gru_id',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('fct_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'user_id',
            ])
            ->addColumn('gru_scope', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'fct_id',
            ])
            ->addColumn('gru_tel1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'gru_scope',
            ])
            ->addColumn('gru_tel2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'gru_tel1',
            ])
            ->addColumn('gru_email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'gru_tel2',
            ])
            ->addColumn('gru_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'gru_email',
            ])
            ->addColumn('gru_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'gru_from',
            ])
            ->addColumn('gru_activ', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'gru_to',
            ])
            ->addColumn('gru_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'gru_activ',
            ])
            ->addColumn('gru_extern_id', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'gru_ts',
            ])
            ->addColumn('gru_informations', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'gru_extern_id',
            ])
            ->addColumn('gru_rgpd', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'gru_informations',
            ])
            ->addIndex(['grp_id'], [
                'name' => 'fk_group_user_group',
                'unique' => false,
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_group_user_user',
                'unique' => false,
            ])
            ->addIndex(['fct_id'], [
                'name' => 'fk_group_user_function',
                'unique' => false,
            ])
            ->create();
        $this->table('sys_country', [
                'id' => false,
                'primary_key' => ['cnty_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cnty_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('cnty_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cnty_id',
            ])
            ->addColumn('cnty_code', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cnty_name',
            ])
            ->addIndex(['cnty_name'], [
                'name' => 'ix_country_cnty_name',
                'unique' => true,
            ])
            ->create();
        $this->table('pm_status', [
                'id' => false,
                'primary_key' => ['sta_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sta_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sta_id',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('sta_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_id',
            ])
            ->addColumn('sta_type', 'enum', [
                'null' => false,
                'default' => '\'PENDING\'',
                'limit' => 7,
                'values' => ['CLOSED', 'PENDING', 'OK', 'REFUSED'],
                'after' => 'sta_name',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_status_broker',
                'unique' => false,
            ])
            ->addIndex(['grp_id'], [
                'name' => 'fk_status_group',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_movement', [
                'id' => false,
                'primary_key' => ['move_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('move_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'move_id',
            ])
            ->addColumn('move_from_site_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('move_to_site_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'move_from_site_id',
            ])
            ->addColumn('move_tr_name', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_site_id',
            ])
            ->addColumn('move_tr_num', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_tr_name',
            ])
            ->addColumn('move_tr_num2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_tr_num',
            ])
            ->addColumn('move_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'move_tr_num2',
            ])
            ->addColumn('move_from_empty', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'move_from',
            ])
            ->addColumn('move_from_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 10,
                'values' => ['OTHER', 'BREEDING', 'MARKET', 'COMMERCIAL', 'ASSEMBLY'],
                'after' => 'move_from_empty',
            ])
            ->addColumn('move_from_cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'move_from_type',
            ])
            ->addColumn('move_from_num', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_from_cli_id',
            ])
            ->addColumn('move_from_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_from_num',
            ])
            ->addColumn('move_from_address', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_from_name',
            ])
            ->addColumn('move_from_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_from_address',
            ])
            ->addColumn('move_from_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_from_cp',
            ])
            ->addColumn('move_from_number_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_from_town',
            ])
            ->addColumn('move_from_number_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_from_number_1',
            ])
            ->addColumn('move_from_number_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_from_number_2',
            ])
            ->addColumn('move_from_number_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_from_number_3',
            ])
            ->addColumn('move_from_number_5', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_from_number_4',
            ])
            ->addColumn('move_from_number_6', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_from_number_5',
            ])
            ->addColumn('move_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'move_from_number_6',
            ])
            ->addColumn('move_to_empty', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'move_to',
            ])
            ->addColumn('move_to_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 14,
                'values' => ['OTHER', 'BREEDING', 'INDIVIDUAL', 'SLAUGHTERHOUSE', 'MARKET', 'COMMERCIAL', 'ASSEMBLY'],
                'after' => 'move_to_empty',
            ])
            ->addColumn('move_to_cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'move_to_type',
            ])
            ->addColumn('move_to_num', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_cli_id',
            ])
            ->addColumn('move_to_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_num',
            ])
            ->addColumn('move_to_address', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_name',
            ])
            ->addColumn('move_to_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_address',
            ])
            ->addColumn('move_to_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_cp',
            ])
            ->addColumn('move_to_number_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_to_town',
            ])
            ->addColumn('move_to_number_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_to_number_1',
            ])
            ->addColumn('move_to_number_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_to_number_2',
            ])
            ->addColumn('move_to_number_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_to_number_3',
            ])
            ->addColumn('move_to_number_5', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_to_number_4',
            ])
            ->addColumn('move_to_number_6', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_to_number_5',
            ])
            ->addColumn('move_group_name_1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_to_number_6',
            ])
            ->addColumn('move_group_num_1', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_group_name_1',
            ])
            ->addColumn('move_group_name_2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_group_num_1',
            ])
            ->addColumn('move_group_num_2', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_group_name_2',
            ])
            ->addColumn('move_group_name_3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_group_num_2',
            ])
            ->addColumn('move_group_num_3', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_group_name_3',
            ])
            ->addColumn('move_group_name_4', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_group_num_3',
            ])
            ->addColumn('move_group_num_4', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'move_group_name_4',
            ])
            ->addColumn('move_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'move_group_num_4',
            ])
            ->addColumn('move_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'move_desc',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_movement_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('pm_project', [
                'id' => false,
                'primary_key' => ['prj_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('prj_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'prj_id',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('prj_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_id',
            ])
            ->addColumn('prj_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'prj_name',
            ])
            ->addColumn('prj_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 11,
                'values' => ['APPLICATION', 'MODULE', 'EXECUTABLE', 'TOOL', 'OTHER', 'WEBAPP'],
                'after' => 'prj_code',
            ])
            ->addColumn('prj_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'prj_type',
            ])
            ->addColumn('prj_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'prj_from',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_project_broker',
                'unique' => false,
            ])
            ->addIndex(['grp_id'], [
                'name' => 'fk_project_group',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_link', [
                'id' => false,
                'primary_key' => ['caul_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('caul_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('from_cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caul_id',
            ])
            ->addColumn('to_cau_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'from_cau_id',
            ])
            ->addColumn('caul_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'to_cau_id',
            ])
            ->addColumn('caul_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'caul_from',
            ])
            ->addColumn('cault_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caul_to',
            ])
            ->create();
        $this->table('asso_donation_origin', [
                'id' => false,
                'primary_key' => ['dono_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dono_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'dono_id',
            ])
            ->addColumn('dono_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'brk_id',
            ])
            ->addColumn('dono_origin', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dono_ts',
            ])
            ->addColumn('dono_comments', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dono_origin',
            ])
            ->addColumn('dono_year', 'integer', [
                'null' => false,
                'limit' => '4',
                'after' => 'dono_comments',
            ])
            ->addColumn('dono_month', 'integer', [
                'null' => false,
                'limit' => '2',
                'after' => 'dono_year',
            ])
            ->addColumn('dono_day', 'integer', [
                'null' => false,
                'default' => '10',
                'limit' => '2',
                'after' => 'dono_month',
            ])
            ->addColumn('dono_status', 'enum', [
                'null' => false,
                'default' => '\'PENDING\'',
                'limit' => 7,
                'values' => ['OK', 'PENDING', 'ERROR'],
                'after' => 'dono_day',
            ])
            ->addIndex(['brk_id', 'dono_year', 'dono_month', 'dono_day'], [
                'name' => 'ix_donation_origin_when',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_main_type', [
                'id' => false,
                'primary_key' => ['camt_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('camt_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'camt_id',
            ])
            ->addColumn('camt_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('camt_family', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 13,
                'values' => ['OTHER', 'NONE', 'ANIMAL', 'FOREST', 'NATURE', 'ADMINISTRATIV'],
                'after' => 'camt_name',
            ])
            ->addIndex(['camt_name', 'brk_id'], [
                'name' => 'ix_cause_main_type_camt_name',
                'unique' => true,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_main_type_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_service', [
                'id' => false,
                'primary_key' => ['serv_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('serv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('serv_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_id',
            ])
            ->addColumn('serv_main_type', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_name',
            ])
            ->addColumn('serv_type', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_main_type',
            ])
            ->addColumn('serv_mode', 'string', [
                'null' => true,
                'default' => '\'LOCAL\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_type',
            ])
            ->create();
        $this->table('sys_history', [
                'id' => false,
                'primary_key' => ['hist_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('hist_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'hist_id',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('hist_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'user_id',
            ])
            ->addColumn('hist_method', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 1,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'hist_ts',
            ])
            ->addColumn('hist_object_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'hist_method',
            ])
            ->addColumn('hist_object_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'hist_object_name',
            ])
            ->addColumn('hist_object', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'hist_object_id',
            ])
            ->create();
        $this->table('sys_notification', [
                'id' => false,
                'primary_key' => ['notif_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('notif_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'notif_id',
            ])
            ->addColumn('notif_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('notif_subject', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'notif_text',
            ])
            ->addColumn('notif_object_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'notif_subject',
            ])
            ->addColumn('notif_object_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'notif_object_name',
            ])
            ->addColumn('notif_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'notif_object_id',
            ])
            ->addColumn('notif_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'notif_code',
            ])
            ->addColumn('notif_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 11,
                'values' => ['ERROR', 'WARNING', 'INFORMATION', 'MANUAL', 'OTHER'],
                'after' => 'notif_ts',
            ])
            ->addColumn('notif_read', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'after' => 'notif_type',
            ])
            ->addColumn('notif_read_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'notif_read',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'notif_read_ts',
            ])
            ->create();
        $this->table('asso_cause_data', [
                'id' => false,
                'primary_key' => ['caud_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('caud_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('cau_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caud_id',
            ])
            ->addColumn('cautd_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cau_id',
            ])
            ->addColumn('caud_vals', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cautd_id',
            ])
            ->addColumn('caud_valt', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caud_vals',
            ])
            ->addColumn('caud_vali', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'caud_valt',
            ])
            ->addColumn('caud_vald', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'caud_vali',
            ])
            ->addIndex(['cau_id'], [
                'name' => 'fk_cause_data_cause',
                'unique' => false,
            ])
            ->addIndex(['cautd_id'], [
                'name' => 'fk_cause_data_cause_type_data',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_document', [
                'id' => false,
                'primary_key' => ['doc_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('doc_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant du document',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'application',
                'after' => 'doc_id',
            ])
            ->addColumn('doc_extern_id', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Identifiant du document pour l\'application',
                'after' => 'brk_id',
            ])
            ->addColumn('doc_filename', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom du fichier, wildcard autorisé',
                'after' => 'doc_extern_id',
            ])
            ->addColumn('dtyp_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du type de document',
                'after' => 'doc_filename',
            ])
            ->addColumn('doc_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'comment' => 'Date de dernière modification',
                'after' => 'dtyp_id',
            ])
            ->addColumn('doc_start', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'doc_ts',
            ])
            ->addColumn('doc_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'doc_start',
            ])
            ->addColumn('doc_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Index fulltext pour les recherches',
                'after' => 'doc_from',
            ])
            ->addColumn('doc_archive', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'comment' => 'Est archivé ?',
                'after' => 'doc_description',
            ])
            ->addColumn('wf_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant workflow de validation / traitement',
                'after' => 'doc_archive',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_document_broker',
                'unique' => false,
            ])
            ->addIndex(['dtyp_id'], [
                'name' => 'fk_document_document_type',
                'unique' => false,
            ])
            ->addIndex(['wf_id'], [
                'name' => 'fk_document_workflow',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_receipt_type', [
                'id' => false,
                'primary_key' => ['rett_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('rett_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rett_id',
            ])
            ->addColumn('rett_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('rett_last_number', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'rett_name',
            ])
            ->addColumn('rett_regex', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rett_last_number',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_receipt_type_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_sickness', [
                'id' => false,
                'primary_key' => ['sick_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sick_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sick_id',
            ])
            ->addColumn('sick_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('sick_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sick_name',
            ])
            ->addColumn('sick_duration', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sick_desc',
            ])
            ->addColumn('sick_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['OTHER', 'B', 'MRC', 'MDO'],
                'after' => 'sick_duration',
            ])
            ->addColumn('sick_freq', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sick_type',
            ])
            ->addColumn('sick_spread', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sick_freq',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_sickness_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('wf_subscription', [
                'id' => false,
                'primary_key' => ['sub_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sub_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifient',
            ])
            ->addColumn('wf_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du workflow',
                'after' => 'sub_id',
            ])
            ->addColumn('thm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du thème',
                'after' => 'wf_id',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Utilisateur de déclenchement',
                'after' => 'thm_id',
            ])
            ->addColumn('sub_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom de la souscription (code)',
                'after' => 'user_id',
            ])
            ->addColumn('sub_libc', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 16,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Libellé court',
                'after' => 'sub_name',
            ])
            ->addColumn('sub_libl', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Libellé long',
                'after' => 'sub_libc',
            ])
            ->addColumn('sub_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'sub_libl',
            ])
            ->addColumn('sub_in_type', 'enum', [
                'null' => false,
                'default' => '\'OR\'',
                'limit' => 3,
                'values' => ['OR', 'AND'],
                'comment' => 'Type de jointure des arcs en entrée',
                'after' => 'sub_desc',
            ])
            ->addColumn('sub_out_type', 'enum', [
                'null' => false,
                'default' => '\'AND\'',
                'limit' => 3,
                'values' => ['OR', 'AND'],
                'comment' => 'Type de split des arx en sortie',
                'after' => 'sub_in_type',
            ])
            ->addColumn('sub_default_runner', 'enum', [
                'null' => false,
                'default' => '\'DIRECT\'',
                'limit' => 10,
                'values' => ['DIRECT', 'CRON', 'BACKGROUND'],
                'comment' => 'Type d\'exécution',
                'after' => 'sub_out_type',
            ])
            ->addColumn('sub_callback_type', 'enum', [
                'null' => false,
                'default' => '\'FCT\'',
                'limit' => 3,
                'values' => ['FCT', 'WS'],
                'comment' => 'Type de callback',
                'after' => 'sub_default_runner',
            ])
            ->addColumn('sub_callback_data', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom de la fonction, du service web, ...',
                'after' => 'sub_callback_type',
            ])
            ->addColumn('fct_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Fonction à déclencher',
                'after' => 'sub_callback_data',
            ])
            ->addColumn('sub_mode', 'enum', [
                'null' => false,
                'default' => '\'UNIQ\'',
                'limit' => 9,
                'values' => ['UNIQ', 'UNLIMITED'],
                'comment' => 'Mode d\'exécution',
                'after' => 'fct_id',
            ])
            ->addColumn('sub_max_iteration', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Itérations max en mode UNLIMITED',
                'after' => 'sub_mode',
            ])
            ->addColumn('sub_exclusiv', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'comment' => 'Lancement concurrent interdit ?',
                'after' => 'sub_max_iteration',
            ])
            ->addColumn('sub_cron', 'string', [
                'null' => false,
                'default' => '\'* * * * *\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Indicateur mode cron ',
                'after' => 'sub_exclusiv',
            ])
            ->addColumn('sub_x', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Position x en px',
                'after' => 'sub_cron',
            ])
            ->addColumn('sub_y', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Position y en px',
                'after' => 'sub_x',
            ])
            ->addColumn('sub_status', 'enum', [
                'null' => true,
                'default' => '\'WAITING\'',
                'limit' => 8,
                'values' => ['PROGRESS', 'WAITING'],
                'comment' => 'Status de la souscription (cas hors workflow)',
                'after' => 'sub_y',
            ])
            ->addColumn('sub_last_run', 'timestamp', [
                'null' => true,
                'default' => 'current_timestamp()',
                'comment' => 'Dernier exécution (cas hors workflow)',
                'after' => 'sub_status',
            ])
            ->addColumn('sub_object_id', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Identifiant de l\'objet (cas hors workflow)',
                'after' => 'sub_last_run',
            ])
            ->addIndex(['thm_id'], [
                'name' => 'fk_subscription_theme',
                'unique' => false,
            ])
            ->addIndex(['wf_id'], [
                'name' => 'fk_subscription_workflow',
                'unique' => false,
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_subscription_user',
                'unique' => false,
            ])
            ->addIndex(['fct_id'], [
                'name' => 'fk_subscription_function',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_file', [
                'id' => false,
                'primary_key' => ['file_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('file_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'file_id',
            ])
            ->addColumn('file_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('file_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'file_name',
            ])
            ->addColumn('file_type', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'file_blob',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_file_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('wf_workflow_field', [
                'id' => false,
                'primary_key' => ['wfld_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('wfld_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('wf_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du workflow',
                'after' => 'wfld_id',
            ])
            ->addColumn('fld_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du champ',
                'after' => 'wf_id',
            ])
            ->addColumn('wfld_default', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Valeur par défaut',
                'after' => 'fld_id',
            ])
            ->addColumn('wfld_required', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'comment' => 'Obligatoire ?',
                'after' => 'wfld_default',
            ])
            ->addIndex(['wf_id'], [
                'name' => 'fk_workflow_field_workflow',
                'unique' => false,
            ])
            ->addIndex(['fld_id'], [
                'name' => 'fk_workflow_field_field',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_vm', [
                'id' => false,
                'primary_key' => ['vm_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('vm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('vm_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'vm_id',
            ])
            ->addColumn('vm_ip', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'vm_name',
            ])
            ->addColumn('vm_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'vm_ip',
            ])
            ->addColumn('vm_os', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'vm_desc',
            ])
            ->addColumn('vm_status', 'string', [
                'null' => true,
                'default' => '\'OK\'',
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'vm_os',
            ])
            ->addColumn('vm_type', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'vm_status',
            ])
            ->addColumn('vm_parent_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'vm_type',
            ])
            ->addColumn('vm_position', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'vm_parent_id',
            ])
            ->addColumn('vm_left', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'vm_position',
            ])
            ->addColumn('vm_right', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'vm_left',
            ])
            ->addColumn('vm_level', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'vm_right',
            ])
            ->create();
        $this->table('tech_poolvmserviceparam', [
                'id' => false,
                'primary_key' => ['pvmsp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('pvmsp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pvms_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pvmsp_id',
            ])
            ->addColumn('sp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pvms_id',
            ])
            ->addColumn('pvmsp_value', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sp_id',
            ])
            ->create();
        $this->table('tech_poolapplicationversion', [
                'id' => false,
                'primary_key' => ['pav_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('pav_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pool_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pav_id',
            ])
            ->addColumn('crm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pool_id',
            ])
            ->addColumn('apv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'crm_id',
            ])
            ->addColumn('pap_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'apv_id',
            ])
            ->addColumn('pap_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'pap_from',
            ])
            ->create();
        $this->table('wf_context', [
                'id' => false,
                'primary_key' => ['ctx_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('ctx_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'application',
                'after' => 'ctx_id',
            ])
            ->addColumn('ctx_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom du contexte',
                'after' => 'brk_id',
            ])
            ->addColumn('ctx_type', 'enum', [
                'null' => false,
                'default' => '\'APPL\'',
                'limit' => 4,
                'values' => ['APPL', 'WS'],
                'comment' => 'Type de contexte',
                'after' => 'ctx_name',
            ])
            ->addColumn('ctx_sys', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'comment' => 'Système',
                'after' => 'ctx_type',
            ])
            ->addColumn('ctx_version', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Version',
                'after' => 'ctx_sys',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_context_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('sys_message', [
                'id' => false,
                'primary_key' => ['msg_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('msg_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'msg_id',
            ])
            ->addColumn('msg_object_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('msg_object_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'msg_object_name',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'msg_object_id',
            ])
            ->addColumn('msg_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'lang_id',
            ])
            ->addColumn('msg_status', 'enum', [
                'null' => false,
                'default' => '\'WAITING\'',
                'limit' => 7,
                'values' => ['WAITING', 'PENDING', 'OK', 'ERROR'],
                'after' => 'msg_ts',
            ])
            ->addColumn('msg_type', 'enum', [
                'null' => false,
                'default' => '\'EMAIL\'',
                'limit' => 5,
                'values' => ['EMAIL', 'SMS'],
                'after' => 'msg_status',
            ])
            ->addColumn('msg_dest', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_type',
            ])
            ->addColumn('msg_cc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_dest',
            ])
            ->addColumn('msg_bcc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_cc',
            ])
            ->addColumn('msg_subject', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_bcc',
            ])
            ->addColumn('msg_body', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_subject',
            ])
            ->addColumn('msg_pj1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_body',
            ])
            ->addColumn('msg_pj2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_pj1',
            ])
            ->addColumn('msg_pj3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_pj2',
            ])
            ->addColumn('msg_pj4', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_pj3',
            ])
            ->addColumn('msg_send_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'msg_pj4',
            ])
            ->addColumn('msg_send_error', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_send_ts',
            ])
            ->addColumn('msg_from', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_send_error',
            ])
            ->addColumn('msg_reply_to', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'msg_from',
            ])
            ->create();
        $this->table('ged_document_structure', [
                'id' => false,
                'primary_key' => ['dstr_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dstr_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('doc_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'dstr_id',
            ])
            ->addColumn('str_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'doc_id',
            ])
            ->addIndex(['doc_id'], [
                'name' => 'fk_document_structure_document',
                'unique' => false,
            ])
            ->addIndex(['str_id'], [
                'name' => 'fk_document_structure_structure',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_domain', [
                'id' => false,
                'primary_key' => ['dom_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dom_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('dom_key', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dom_id',
            ])
            ->addColumn('dom_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dom_key',
            ])
            ->addColumn('dom_concurrent_user', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'dom_name',
            ])
            ->addColumn('dom_maintain_seconds', 'integer', [
                'null' => false,
                'default' => '3600',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'dom_concurrent_user',
            ])
            ->addColumn('dom_session_minutes', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'dom_maintain_seconds',
            ])
            ->addColumn('dom_sites', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dom_session_minutes',
            ])
            ->create();
        $this->table('asso_cause_type', [
                'id' => false,
                'primary_key' => ['caut_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('caut_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caut_id',
            ])
            ->addColumn('camt_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('caut_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'camt_id',
            ])
            ->addColumn('caut_pattern', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caut_name',
            ])
            ->addColumn('caut_mask', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caut_pattern',
            ])
            ->addColumn('caut_receipt', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_mask',
            ])
            ->addColumn('caut_max_mnt', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'comment' => 'cents',
                'after' => 'caut_receipt',
            ])
            ->addColumn('caut_min_mnt', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'comment' => 'cents',
                'after' => 'caut_max_mnt',
            ])
            ->addColumn('caut_money', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caut_min_mnt',
            ])
            ->addColumn('caut_mnt_type', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 7,
                'values' => ['ANNUAL', 'MAXIMUM', 'OTHER'],
                'after' => 'caut_money',
            ])
            ->addColumn('caut_certificat', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_mnt_type',
            ])
            ->addColumn('caut_donation', 'enum', [
                'null' => false,
                'default' => '\'ALL\'',
                'limit' => 7,
                'values' => ['ALL', 'ONCE', 'REGULAR'],
                'after' => 'caut_certificat',
            ])
            ->addColumn('caut_once_duration', 'enum', [
                'null' => false,
                'default' => '\'INFINITE\'',
                'limit' => 8,
                'values' => ['1Y', '1M', 'INFINITE'],
                'after' => 'caut_donation',
            ])
            ->addColumn('caut_regular_duration', 'enum', [
                'null' => false,
                'default' => '\'INFINITE\'',
                'limit' => 8,
                'values' => ['1Y', '1M', 'INFINITE'],
                'after' => 'caut_once_duration',
            ])
            ->addColumn('caut_news', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_regular_duration',
            ])
            ->addColumn('caut_family', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 13,
                'values' => ['OTHER', 'NONE', 'ANIMAL', 'FOREST', 'NATURE', 'ADMINISTRATIV'],
                'after' => 'caut_news',
            ])
            ->addColumn('caut_string_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_family',
            ])
            ->addColumn('caut_string_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_string_1',
            ])
            ->addColumn('caut_string_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_string_2',
            ])
            ->addColumn('caut_string_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_string_3',
            ])
            ->addColumn('caut_number_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_string_4',
            ])
            ->addColumn('caut_number_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_number_1',
            ])
            ->addColumn('caut_number_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_number_2',
            ])
            ->addColumn('caut_number_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_number_3',
            ])
            ->addColumn('caut_date_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_number_4',
            ])
            ->addColumn('caut_date_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_date_1',
            ])
            ->addColumn('caut_date_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_date_2',
            ])
            ->addColumn('caut_date_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_date_3',
            ])
            ->addColumn('caut_text_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_date_4',
            ])
            ->addColumn('caut_text_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_text_1',
            ])
            ->addColumn('caut_text_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_text_2',
            ])
            ->addColumn('caut_text_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_text_3',
            ])
            ->addColumn('caut_bool_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_text_4',
            ])
            ->addColumn('caut_bool_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_bool_1',
            ])
            ->addColumn('caut_bool_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_bool_2',
            ])
            ->addColumn('caut_bool_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'caut_bool_3',
            ])
            ->addColumn('caut_max_weight', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '8',
                'scale' => '2',
                'after' => 'caut_bool_4',
            ])
            ->addColumn('caut_max_height', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '8',
                'scale' => '2',
                'after' => 'caut_max_weight',
            ])
            ->addColumn('caut_growth_freq', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'caut_max_height',
            ])
            ->addColumn('caut_growth_graph', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caut_growth_freq',
            ])
            ->addIndex(['caut_name', 'brk_id'], [
                'name' => 'i1_asso_cause_type',
                'unique' => true,
            ])
            ->addIndex(['caut_name', 'brk_id'], [
                'name' => 'ix_cause_type_caut_name',
                'unique' => true,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_type_broker',
                'unique' => false,
            ])
            ->addIndex(['camt_id'], [
                'name' => 'fk_cause_type_cause_main_type',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_document_version_download', [
                'id' => false,
                'primary_key' => ['down_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('down_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('dver_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de la version du document',
                'after' => 'down_id',
            ])
            ->addColumn('dlnk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du lien utilisé',
                'after' => 'dver_id',
            ])
            ->addColumn('down_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'comment' => 'Quand',
                'after' => 'dlnk_id',
            ])
            ->addColumn('down_infos', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Informations de quel appli, ...',
                'after' => 'down_ts',
            ])
            ->addIndex(['dver_id'], [
                'name' => 'fk_document_version_download_document_version',
                'unique' => false,
            ])
            ->addIndex(['dlnk_id'], [
                'name' => 'fk_document_version_download_document_version_link',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_config', [
                'id' => false,
                'primary_key' => ['acfg_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('acfg_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'acfg_id',
            ])
            ->addColumn('acfg_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('acfg_value', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'acfg_code',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_config_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('sys_jobqueue_histo', [
                'id' => false,
                'primary_key' => ['jobqh_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('jobqh_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('jobq_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'jobqh_id',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'jobq_id',
            ])
            ->addColumn('jobqh_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'brk_id',
            ])
            ->addColumn('jobqh_msg', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobqh_ts',
            ])
            ->addColumn('jobqh_status', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'jobqh_msg',
            ])
            ->addIndex(['jobq_id'], [
                'name' => 'fk_jobqueue_histo_jobqueue',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_jobqueue_histo_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_certificate', [
                'id' => false,
                'primary_key' => ['cert_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cert_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cert_id',
            ])
            ->addColumn('cert_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'brk_id',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cert_ts',
            ])
            ->addColumn('cert_gen_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cli_id',
            ])
            ->addColumn('cert_print_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'cert_gen_ts',
            ])
            ->addColumn('cert_fullname', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_print_ts',
            ])
            ->addColumn('cert_address1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_fullname',
            ])
            ->addColumn('cert_address2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_address1',
            ])
            ->addColumn('cert_address3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_address2',
            ])
            ->addColumn('cert_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_address3',
            ])
            ->addColumn('cert_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_cp',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cert_town',
            ])
            ->addColumn('cnty_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'lang_id',
            ])
            ->addColumn('cert_email', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cnty_id',
            ])
            ->addColumn('cert_input_mnt', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '6',
                'after' => 'cert_email',
            ])
            ->addColumn('cert_input_money', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_input_mnt',
            ])
            ->addColumn('cert_output_mnt', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '6',
                'after' => 'cert_input_money',
            ])
            ->addColumn('cert_output_money', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_output_mnt',
            ])
            ->addColumn('cert_comment', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_output_money',
            ])
            ->addColumn('cert_data1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_comment',
            ])
            ->addColumn('cert_data2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cert_data1',
            ])
            ->addColumn('file_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cert_data2',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_certificate_broker',
                'unique' => false,
            ])
            ->addIndex(['cli_id'], [
                'name' => 'fk_certificate_client',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_certificate_lang',
                'unique' => false,
            ])
            ->addIndex(['cnty_id'], [
                'name' => 'fk_certificate_country',
                'unique' => false,
            ])
            ->addIndex(['file_id'], [
                'name' => 'fk_certificate_file',
                'unique' => false,
            ])
            ->create();
        $this->table('pm_project_version', [
                'id' => false,
                'primary_key' => ['prjv_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('prjv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'prjv_id',
            ])
            ->addColumn('prj_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('prjv_type', 'enum', [
                'null' => false,
                'default' => '\'DEV\'',
                'limit' => 5,
                'values' => ['REAL', 'TEST', 'BETA', 'ALPHA', 'DEV'],
                'after' => 'prj_id',
            ])
            ->addColumn('prjv_version', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'prjv_type',
            ])
            ->addColumn('prjv_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'prjv_version',
            ])
            ->addColumn('prjv_tp', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'prjv_from',
            ])
            ->addColumn('prjv_beta_test', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'prjv_tp',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_project_version_broker',
                'unique' => false,
            ])
            ->addIndex(['prj_id'], [
                'name' => 'fk_project_version_project',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_receipt', [
                'id' => false,
                'primary_key' => ['rec_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('rec_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rec_id',
            ])
            ->addColumn('cli_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('rett_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cli_id',
            ])
            ->addColumn('rec_mode', 'enum', [
                'null' => false,
                'default' => '\'MANUAL\'',
                'limit' => 6,
                'values' => ['MANUAL', 'AUTO'],
                'after' => 'rett_id',
            ])
            ->addColumn('rec_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'rec_mode',
            ])
            ->addColumn('rec_gen_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'rec_ts',
            ])
            ->addColumn('rec_print_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'rec_gen_ts',
            ])
            ->addColumn('rec_year', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'rec_print_ts',
            ])
            ->addColumn('rec_number', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_year',
            ])
            ->addColumn('rec_mnt', 'decimal', [
                'null' => false,
                'precision' => '15',
                'scale' => '6',
                'after' => 'rec_number',
            ])
            ->addColumn('rec_money', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_mnt',
            ])
            ->addColumn('rec_fullname', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_money',
            ])
            ->addColumn('rec_address1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_fullname',
            ])
            ->addColumn('rec_address2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_address1',
            ])
            ->addColumn('rec_address3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_address2',
            ])
            ->addColumn('rec_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_address3',
            ])
            ->addColumn('rec_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_cp',
            ])
            ->addColumn('cnty_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rec_town',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cnty_id',
            ])
            ->addColumn('rec_email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('rec_send_method', 'enum', [
                'null' => false,
                'default' => '\'MANUAL\'',
                'limit' => 7,
                'values' => ['EMAIL', 'MANUAL', 'UNKNOWN'],
                'after' => 'rec_email',
            ])
            ->addColumn('rec_mnt_letter', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rec_send_method',
            ])
            ->addColumn('file_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rec_mnt_letter',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_receipt_broker',
                'unique' => false,
            ])
            ->addIndex(['cli_id'], [
                'name' => 'fk_receipt_client',
                'unique' => false,
            ])
            ->addIndex(['cnty_id'], [
                'name' => 'fk_receipt_country',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_receipt_lang',
                'unique' => false,
            ])
            ->addIndex(['file_id'], [
                'name' => 'fk_receipt_file',
                'unique' => false,
            ])
            ->addIndex(['rett_id'], [
                'name' => 'fk_receipt_type_receipt',
                'unique' => false,
            ])
            ->create();
        $this->table('wf_workflow', [
                'id' => false,
                'primary_key' => ['wf_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('wf_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('ctx_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du contexte',
                'after' => 'wf_id',
            ])
            ->addColumn('thm_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du thème',
                'after' => 'ctx_id',
            ])
            ->addColumn('wf_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom du workflow (code)',
                'after' => 'thm_id',
            ])
            ->addColumn('wf_libc', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 16,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Code court',
                'after' => 'wf_name',
            ])
            ->addColumn('wf_libl', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Libellé long',
                'after' => 'wf_libc',
            ])
            ->addColumn('wf_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'wf_libl',
            ])
            ->addColumn('wf_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'wf_description',
            ])
            ->addColumn('wf_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'wf_from',
            ])
            ->addColumn('wf_width', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Largeur en px',
                'after' => 'wf_to',
            ])
            ->addColumn('wf_height', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'comment' => 'Hauteur en px',
                'after' => 'wf_width',
            ])
            ->addColumn('wf_sys', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'comment' => 'Système ?',
                'after' => 'wf_height',
            ])
            ->addColumn('wf_app_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Code application',
                'after' => 'wf_sys',
            ])
            ->addColumn('wf_prefix', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Préfixe par défaut des éléments',
                'after' => 'wf_app_code',
            ])
            ->addColumn('wf_expired', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Durée de conservation des cas (jours)',
                'after' => 'wf_prefix',
            ])
            ->addIndex(['ctx_id'], [
                'name' => 'fk_workflow_context',
                'unique' => false,
            ])
            ->addIndex(['thm_id'], [
                'name' => 'fk_workflow_theme',
                'unique' => false,
            ])
            ->create();
        $this->table('wf_field', [
                'id' => false,
                'primary_key' => ['fld_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('fld_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('ctx_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du contexte',
                'after' => 'fld_id',
            ])
            ->addColumn('fld_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom du champ (code)',
                'after' => 'ctx_id',
            ])
            ->addColumn('fld_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'fld_name',
            ])
            ->addColumn('fld_type', 'enum', [
                'null' => false,
                'default' => '\'STRING\'',
                'limit' => 7,
                'values' => ['STRING', 'INTEGER', 'DATE', 'BOOLEAN', 'TABLE'],
                'comment' => 'Type',
                'after' => 'fld_description',
            ])
            ->addColumn('fld_data', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Pour des types spécifiques',
                'after' => 'fld_type',
            ])
            ->addColumn('fld_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'fld_data',
            ])
            ->addColumn('fld_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'fld_from',
            ])
            ->addColumn('fld_default', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Valeur par défaut',
                'after' => 'fld_to',
            ])
            ->addColumn('fld_required', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'comment' => 'Obligatoire ?',
                'after' => 'fld_default',
            ])
            ->addColumn('fld_ask', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'comment' => 'Interactif ?',
                'after' => 'fld_required',
            ])
            ->addIndex(['ctx_id'], [
                'name' => 'fk_field_context',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_incoming_job_state', [
                'id' => false,
                'primary_key' => ['ijs_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('ijs_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('ijs_cli', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_id',
            ])
            ->addColumn('ijs_app', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_cli',
            ])
            ->addColumn('ijs_job', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_app',
            ])
            ->addColumn('ijs_vm', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_job',
            ])
            ->addColumn('ijs_status', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_vm',
            ])
            ->addColumn('ijs_ts', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'ijs_status',
            ])
            ->addColumn('ijs_state', 'string', [
                'null' => false,
                'default' => '\'PENDING\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_ts',
            ])
            ->addColumn('ijs_comments', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ijs_state',
            ])
            ->create();
        $this->table('asso_cause_type_data', [
                'id' => false,
                'primary_key' => ['cautd_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cautd_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('caut_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cautd_id',
            ])
            ->addColumn('cautd_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caut_id',
            ])
            ->addColumn('cautd_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cautd_code',
            ])
            ->addColumn('cautd_type', 'enum', [
                'null' => false,
                'default' => '\'STRING\'',
                'limit' => 7,
                'values' => ['I18N', 'STRING', 'INTEGER', 'DATE', 'TEXT'],
                'after' => 'cautd_name',
            ])
            ->addColumn('cautd_required', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'after' => 'cautd_type',
            ])
            ->addColumn('cautd_calculation', 'enum', [
                'null' => false,
                'default' => '\'NONE\'',
                'limit' => 4,
                'values' => ['NONE', 'AREA', 'RATE'],
                'after' => 'cautd_required',
            ])
            ->addColumn('cautd_operator', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cautd_calculation',
            ])
            ->addColumn('cautd_factor', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '16',
                'scale' => '5',
                'after' => 'cautd_operator',
            ])
            ->addColumn('cautd_currency', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cautd_factor',
            ])
            ->addIndex(['caut_id'], [
                'name' => 'fk_cause_type_data_cause_type',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_group', [
                'id' => false,
                'primary_key' => ['grp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('grpt_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('grp_code', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grpt_id',
            ])
            ->addColumn('grp_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_code',
            ])
            ->addColumn('grp_address1', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_name',
            ])
            ->addColumn('grp_address2', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_address1',
            ])
            ->addColumn('grp_address3', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_address2',
            ])
            ->addColumn('grp_cp', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_address3',
            ])
            ->addColumn('grp_town', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_cp',
            ])
            ->addColumn('cnty_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_town',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'cnty_id',
            ])
            ->addColumn('grp_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'lang_id',
            ])
            ->addColumn('grp_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'grp_from',
            ])
            ->addColumn('grp_parent_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_to',
            ])
            ->addColumn('grp_money_code', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_parent_id',
            ])
            ->addColumn('grp_money_input', 'string', [
                'null' => false,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_money_code',
            ])
            ->addColumn('grp_logo', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'grp_money_input',
            ])
            ->addColumn('grp_email_header', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_logo',
            ])
            ->addColumn('grp_email_footer', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_email_header',
            ])
            ->addColumn('grp_sign', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'grp_email_footer',
            ])
            ->addColumn('grp_realm_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_sign',
            ])
            ->addColumn('grp_config', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grp_realm_id',
            ])
            ->addIndex(['grp_code'], [
                'name' => 'idx1_group',
                'unique' => true,
            ])
            ->addIndex(['cnty_id'], [
                'name' => 'fk_group_country',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_group_lang',
                'unique' => false,
            ])
            ->addIndex(['grpt_id'], [
                'name' => 'fk_group_group_type',
                'unique' => false,
            ])
            ->addIndex(['grp_realm_id'], [
                'name' => 'fk_group_realm',
                'unique' => false,
            ])
            ->create();
        $this->table('crm_client_category', [
                'id' => false,
                'primary_key' => ['clic_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('clic_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'clic_id',
            ])
            ->addColumn('clic_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('clic_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'clic_code',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_client_category_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('pm_desk_col', [
                'id' => false,
                'primary_key' => ['deco_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('deco_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'deco_id',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('desk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('deco_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'desk_id',
            ])
            ->create();
        $this->table('pm_desk', [
                'id' => false,
                'primary_key' => ['desk_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('desk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'desk_id',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'grp_id',
            ])
            ->addColumn('desk_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_id',
            ])
            ->addColumn('desk_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'desk_name',
            ])
            ->addColumn('desk_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'desk_desc',
            ])
            ->addColumn('desk_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'desk_from',
            ])
            ->addColumn('desk_status', 'enum', [
                'null' => false,
                'default' => '\'PENDING\'',
                'limit' => 7,
                'values' => ['PENDING', 'CLOSED', 'OPEN'],
                'after' => 'desk_to',
            ])
            ->create();
        $this->table('tech_rates', [
                'id' => false,
                'primary_key' => ['rate_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('rate_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('rate_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'rate_id',
            ])
            ->addColumn('rate_currency', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rate_ts',
            ])
            ->addColumn('rate_value', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '16',
                'scale' => '9',
                'after' => 'rate_currency',
            ])
            ->create();
        $this->table('tech_applicationversion', [
                'id' => false,
                'primary_key' => ['apv_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('apv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('app_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'apv_id',
            ])
            ->addColumn('apv_vers', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'app_id',
            ])
            ->addColumn('apv_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'apv_vers',
            ])
            ->addColumn('apv_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'apv_from',
            ])
            ->create();
        $this->table('sso_group_type', [
                'id' => false,
                'primary_key' => ['grpt_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('grpt_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('grpt_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grpt_id',
            ])
            ->addColumn('grpt_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'grpt_code',
            ])
            ->addColumn('grpt_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'grpt_name',
            ])
            ->addColumn('grpt_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'grpt_from',
            ])
            ->create();
        $this->table('asso_subspecies', [
                'id' => false,
                'primary_key' => ['sspe_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sspe_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sspe_id',
            ])
            ->addColumn('spe_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('sspe_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'spe_id',
            ])
            ->addColumn('sspe_scientific', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sspe_name',
            ])
            ->addIndex(['brk_id', 'sspe_name'], [
                'name' => 'ix_subspecies_name',
                'unique' => false,
            ])
            ->addIndex(['spe_id'], [
                'name' => 'fk_subspecies_species',
                'unique' => false,
            ])
            ->create();
        $this->table('pm_desk_col_feature', [
                'id' => false,
                'primary_key' => ['dcf_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dcf_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('deco_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'dcf_id',
            ])
            ->addColumn('feat_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'deco_id',
            ])
            ->addColumn('dcf_position', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'feat_id',
            ])
            ->create();
        $this->table('wf_theme', [
                'id' => false,
                'primary_key' => ['thm_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('thm_id', 'biginteger', [
                'null' => false,
                'limit' => '10',
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('thm_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom du thème',
                'after' => 'thm_id',
            ])
            ->addColumn('thm_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Description',
                'after' => 'thm_name',
            ])
            ->create();
        $this->table('crm_client_type_data', [
                'id' => false,
                'primary_key' => ['clitd_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('clitd_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('clit_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'clitd_id',
            ])
            ->addColumn('clitd_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'clit_id',
            ])
            ->addColumn('clitd_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'clitd_code',
            ])
            ->addColumn('clitd_type', 'enum', [
                'null' => false,
                'default' => '\'STRING\'',
                'limit' => 7,
                'values' => ['STRING', 'INTEGER', 'DATE', 'TEXT'],
                'after' => 'clitd_name',
            ])
            ->addColumn('clitd_required', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'after' => 'clitd_type',
            ])
            ->addIndex(['clit_id'], [
                'name' => 'fk_cause_type_data_cause_type',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_cause_media_lang', [
                'id' => false,
                'primary_key' => ['caml_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('caml_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('caum_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caml_id',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'caum_id',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('caml_subject', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('caml_blob', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'caml_subject',
            ])
            ->addColumn('caml_text', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'caml_blob',
            ])
            ->addIndex(['caum_id'], [
                'name' => 'fk_cause_media_lang_cause_media',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_media_lang_broker',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_cause_media_lang_lang',
                'unique' => false,
            ])
            ->create();
        $this->table('sys_email', [
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
            ->addIndex(['brk_id'], [
                'name' => 'fk_email_broker',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_email_lang',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_poolapplicationversionparam', [
                'id' => false,
                'primary_key' => ['pavp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('pavp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pav_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pavp_id',
            ])
            ->addColumn('avp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pav_id',
            ])
            ->addColumn('pavp_value', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'avp_id',
            ])
            ->create();
        $this->table('sso_password_token', [
                'id' => false,
                'primary_key' => ['ptok_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('ptok_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('ptok_token', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ptok_id',
            ])
            ->addColumn('ptok_used', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'ptok_token',
            ])
            ->addColumn('ptok_email', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ptok_used',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'ptok_email',
            ])
            ->addColumn('ptok_request_ip', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_id',
            ])
            ->addColumn('ptok_resolve_ip', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ptok_request_ip',
            ])
            ->addColumn('ptok_end', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'ptok_resolve_ip',
            ])
            ->addIndex(['ptok_token', 'ptok_used', 'ptok_end'], [
                'name' => 'sso_passwords_tokens_idx1',
                'unique' => false,
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_password_token_user',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_session', [
                'id' => false,
                'primary_key' => ['sess_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sess_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sess_id',
            ])
            ->addColumn('sess_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('sess_exercice', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '4',
                'after' => 'sess_name',
            ])
            ->addColumn('sess_status', 'enum', [
                'null' => false,
                'default' => '\'OPEN\'',
                'limit' => 10,
                'values' => ['OPEN', 'CLOSED', 'VALIDATION'],
                'after' => 'sess_exercice',
            ])
            ->addColumn('sess_type', 'enum', [
                'null' => false,
                'default' => '\'STANDARD\'',
                'limit' => 10,
                'values' => ['STANDARD', 'CORRECTION'],
                'after' => 'sess_status',
            ])
            ->create();
        $this->table('tech_application', [
                'id' => false,
                'primary_key' => ['app_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('app_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('app_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'app_id',
            ])
            ->addColumn('app_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'app_code',
            ])
            ->addColumn('app_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'app_name',
            ])
            ->addColumn('app_vers', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'app_desc',
            ])
            ->addColumn('app_status', 'string', [
                'null' => false,
                'default' => '\'OK\'',
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'app_vers',
            ])
            ->create();
        $this->table('sso_user', [
                'id' => false,
                'primary_key' => ['user_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('user_login', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_id',
            ])
            ->addColumn('user_password', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_login',
            ])
            ->addColumn('user_active', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'user_password',
            ])
            ->addColumn('user_salt', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_active',
            ])
            ->addColumn('user_email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_salt',
            ])
            ->addColumn('user_first_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_email',
            ])
            ->addColumn('user_last_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_first_name',
            ])
            ->addColumn('user_title', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 6,
                'values' => ['MISTER', 'MADAM', 'MISS', 'OTHER'],
                'after' => 'user_last_name',
            ])
            ->addColumn('user_scope', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_title',
            ])
            ->addColumn('user_type', 'enum', [
                'null' => false,
                'default' => '\'USER\'',
                'limit' => 9,
                'values' => ['USER', 'IP', 'UUID', 'ANONYMOUS', 'REST'],
                'after' => 'user_scope',
            ])
            ->addColumn('user_ips', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_type',
            ])
            ->addColumn('user_last_update', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'user_ips',
            ])
            ->addColumn('user_preferred_language', 'string', [
                'null' => true,
                'default' => '\'FR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_last_update',
            ])
            ->addColumn('user_avatar', 'blob', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::BLOB_LONG,
                'after' => 'user_preferred_language',
            ])
            ->addColumn('user_cache', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_avatar',
            ])
            ->addColumn('user_val_string', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_cache',
            ])
            ->addColumn('user_val_end', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'user_val_string',
            ])
            ->addColumn('user_val_login', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_val_end',
            ])
            ->addColumn('user_cnx', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_val_login',
            ])
            ->addColumn('user_extern_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'user_cnx',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'user_extern_code',
            ])
            ->addIndex(['user_login', 'user_active'], [
                'name' => 'ix_user_user_login',
                'unique' => true,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'fk_user_lang',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_session', [
                'id' => false,
                'primary_key' => ['sess_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sess_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sess_id',
            ])
            ->addColumn('sess_start', 'timestamp', [
                'null' => false,
                'default' => 'current_timestamp()',
                'after' => 'user_id',
            ])
            ->addColumn('sess_end', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sess_start',
            ])
            ->addColumn('sess_touch', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'sess_end',
            ])
            ->addColumn('sess_content', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sess_touch',
            ])
            ->addColumn('sess_client_addr', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sess_content',
            ])
            ->addIndex(['user_id'], [
                'name' => 'fk_session_user_id',
                'unique' => false,
            ])
            ->addIndex(['sess_end'], [
                'name' => 'sso_sessions_idx1',
                'unique' => false,
            ])
            ->create();
        $this->table('sys_lang', [
                'id' => false,
                'primary_key' => ['lang_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('lang_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('lang_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('lang_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_name',
            ])
            ->addColumn('lang_iso', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_code',
            ])
            ->addColumn('lang_flag', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_iso',
            ])
            ->addIndex(['lang_name'], [
                'name' => 'ix_lang_lang_name',
                'unique' => true,
            ])
            ->create();
        $this->table('tech_poolvmservice', [
                'id' => false,
                'primary_key' => ['pvms_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('pvms_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pvm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pvms_id',
            ])
            ->addColumn('serv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pvm_id',
            ])
            ->addColumn('pvms_status', 'string', [
                'null' => false,
                'default' => '\'OK\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_id',
            ])
            ->addColumn('pvms_status_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'pvms_status',
            ])
            ->create();
        $this->table('sto_family', [
                'id' => false,
                'primary_key' => ['fam_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('fam_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'fam_id',
            ])
            ->addColumn('fam_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('fam_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'fam_name',
            ])
            ->addColumn('fam_parent_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'fam_desc',
            ])
            ->addColumn('fam_position', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fam_parent_id',
            ])
            ->addColumn('fam_left', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fam_position',
            ])
            ->addColumn('fam_right', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fam_left',
            ])
            ->addColumn('fam_level', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fam_right',
            ])
            ->addColumn('fam_code_int', 'enum', [
                'null' => false,
                'default' => '\'OTHER\'',
                'limit' => 5,
                'values' => ['DRUG', 'OTHER'],
                'after' => 'fam_level',
            ])
            ->addIndex(['fam_parent_id'], [
                'name' => 'fk_family_family',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_family_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_poolvm', [
                'id' => false,
                'primary_key' => ['pvm_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('pvm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('pool_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pvm_id',
            ])
            ->addColumn('vm_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'pool_id',
            ])
            ->create();
        $this->table('ged_document_metadata', [
                'id' => false,
                'primary_key' => ['dmet_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dmet_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('doc_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du document',
                'after' => 'dmet_id',
            ])
            ->addColumn('meta_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de la métadonnée',
                'after' => 'doc_id',
            ])
            ->addColumn('dmet_value', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 512,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Valeur de la métadonnée',
                'after' => 'meta_id',
            ])
            ->addIndex(['doc_id'], [
                'name' => 'fk_document_metadata_document',
                'unique' => false,
            ])
            ->addIndex(['meta_id'], [
                'name' => 'fk_document_metadata_metadata',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_document_version_link', [
                'id' => false,
                'primary_key' => ['dlnk_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dlnk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('dver_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de la version du document',
                'after' => 'dlnk_id',
            ])
            ->addColumn('dlnk_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'dver_id',
            ])
            ->addColumn('dlnk_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'dlnk_from',
            ])
            ->addColumn('dlnk_data', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 512,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Infos pour utiliser le lien',
                'after' => 'dlnk_to',
            ])
            ->addColumn('dlnk_auth', 'enum', [
                'null' => true,
                'default' => '\'BROKER\'',
                'limit' => 6,
                'values' => ['NONE', 'BROKER', 'USER'],
                'comment' => 'Type d\'authorisation',
                'after' => 'dlnk_data',
            ])
            ->addIndex(['dver_id'], [
                'name' => 'fk_document_version_link_document_version',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_document_version', [
                'id' => false,
                'primary_key' => ['dver_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dver_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('doc_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du document',
                'after' => 'dver_id',
            ])
            ->addColumn('dver_type', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Type du document (original, duplicata, ...)',
                'after' => 'doc_id',
            ])
            ->addColumn('dver_filename', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 256,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Surcharge du nom de fichier',
                'after' => 'dver_type',
            ])
            ->addColumn('dver_mime', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Type mime',
                'after' => 'dver_filename',
            ])
            ->addColumn('dver_status', 'enum', [
                'null' => true,
                'default' => '\'VALIDATED\'',
                'limit' => 9,
                'values' => ['CREATED', 'VALIDATED', 'REFUSED', 'WAITING'],
                'comment' => 'Status du document',
                'after' => 'dver_mime',
            ])
            ->addColumn('dver_md5', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dver_status',
            ])
            ->addColumn('dver_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'dver_md5',
            ])
            ->addColumn('dver_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'dver_from',
            ])
            ->addColumn('dver_parent_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Version parente (archivage, ...)',
                'after' => 'dver_to',
            ])
            ->addColumn('dver_storage', 'enum', [
                'null' => true,
                'default' => null,
                'limit' => 5,
                'values' => ['LOCAL', 'CLOUD', 'BOTH'],
                'comment' => 'Type de stockage',
                'after' => 'dver_parent_id',
            ])
            ->addColumn('dver_local', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 512,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Stockage local',
                'after' => 'dver_storage',
            ])
            ->addColumn('dver_cloud', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 512,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dver_local',
            ])
            ->addIndex(['doc_id'], [
                'name' => 'fk_document_version_document',
                'unique' => false,
            ])
            ->addIndex(['dver_parent_id'], [
                'name' => 'fk_document_version_document_version',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_broker', [
                'id' => false,
                'primary_key' => ['brk_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('dom_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('brk_key', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'dom_id',
            ])
            ->addColumn('brk_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_key',
            ])
            ->addColumn('brk_certificate', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_name',
            ])
            ->addColumn('brk_active', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'brk_certificate',
            ])
            ->addColumn('brk_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'brk_active',
            ])
            ->addColumn('brk_api_scope', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_ts',
            ])
            ->addColumn('brk_users_scope', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_api_scope',
            ])
            ->addColumn('brk_auth', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_users_scope',
            ])
            ->addColumn('brk_ips', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Liste des ips séparées par ;',
                'after' => 'brk_auth',
            ])
            ->addColumn('brk_same_ip', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'brk_ips',
            ])
            ->addColumn('brk_config', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Configuration au format JSON',
                'after' => 'brk_same_ip',
            ])
            ->addColumn('grp_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Groupe propriétaire du broker',
                'after' => 'brk_config',
            ])
            ->addColumn('brk_type', 'enum', [
                'null' => false,
                'default' => '\'MANUAL\'',
                'limit' => 6,
                'values' => ['EXTERN', 'LINK', 'MANUAL', 'TECH'],
                'after' => 'grp_id',
            ])
            ->addIndex(['brk_name'], [
                'name' => 'ix_broker_brk_key',
                'unique' => true,
            ])
            ->addIndex(['brk_key'], [
                'name' => 'ix_broker_brk_name',
                'unique' => true,
            ])
            ->addIndex(['dom_id'], [
                'name' => 'fk_broker_dom_id',
                'unique' => false,
            ])
            ->addIndex(['brk_key', 'brk_active'], [
                'name' => 'sso_brokers_idx1',
                'unique' => false,
            ])
            ->addIndex(['grp_id'], [
                'name' => 'fk_broker_group',
                'unique' => false,
            ])
            ->create();
        $this->table('asso_species', [
                'id' => false,
                'primary_key' => ['spe_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('spe_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'spe_id',
            ])
            ->addColumn('spe_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('spe_scientific', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'spe_name',
            ])
            ->addIndex(['brk_id', 'spe_name'], [
                'name' => 'ix_species_name',
                'unique' => true,
            ])
            ->create();
        $this->table('asso_receipt_donation', [
                'id' => false,
                'primary_key' => ['rdo_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('rdo_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rdo_id',
            ])
            ->addColumn('rec_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brk_id',
            ])
            ->addColumn('don_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rec_id',
            ])
            ->addColumn('rdo_desc', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'don_id',
            ])
            ->addColumn('rdo_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'rdo_desc',
            ])
            ->addColumn('rdo_mnt', 'decimal', [
                'null' => true,
                'default' => null,
                'precision' => '15',
                'scale' => '6',
                'after' => 'rdo_ts',
            ])
            ->addColumn('rdo_money', 'string', [
                'null' => true,
                'default' => '\'EUR\'',
                'limit' => 3,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'rdo_mnt',
            ])
            ->addColumn('ptyp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'rdo_money',
            ])
            ->addIndex(['rec_id'], [
                'name' => 'fk_receipt_donation_receipt',
                'unique' => false,
            ])
            ->addIndex(['don_id'], [
                'name' => 'fk_receipt_donation_donation',
                'unique' => false,
            ])
            ->addIndex(['ptyp_id'], [
                'name' => 'fk_receipt_donation_payment_type',
                'unique' => false,
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_receipt_donation_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('crm_client_type', [
                'id' => false,
                'primary_key' => ['clit_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('clit_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'clit_id',
            ])
            ->addColumn('clit_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_id',
            ])
            ->addColumn('clit_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'cents',
                'after' => 'clit_name',
            ])
            ->addColumn('clit_string_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_code',
            ])
            ->addColumn('clit_string_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_string_1',
            ])
            ->addColumn('clit_string_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_string_2',
            ])
            ->addColumn('clit_string_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_string_3',
            ])
            ->addColumn('clit_number_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_string_4',
            ])
            ->addColumn('clit_number_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_number_1',
            ])
            ->addColumn('clit_number_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_number_2',
            ])
            ->addColumn('clit_number_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_number_3',
            ])
            ->addColumn('clit_date_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_number_4',
            ])
            ->addColumn('clit_date_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_date_1',
            ])
            ->addColumn('clit_date_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_date_2',
            ])
            ->addColumn('clit_date_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_date_3',
            ])
            ->addColumn('clit_text_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_date_4',
            ])
            ->addColumn('clit_text_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_text_1',
            ])
            ->addColumn('clit_text_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_text_2',
            ])
            ->addColumn('clit_text_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_text_3',
            ])
            ->addColumn('clit_bool_1', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_text_4',
            ])
            ->addColumn('clit_bool_2', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_bool_1',
            ])
            ->addColumn('clit_bool_3', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_bool_2',
            ])
            ->addColumn('clit_bool_4', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'clit_bool_3',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_cause_type_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('ged_document_type', [
                'id' => false,
                'primary_key' => ['dtyp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('dtyp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant du type de document',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'comment' => 'Identifiant de l\'application',
                'after' => 'dtyp_id',
            ])
            ->addColumn('dtyp_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Libellé du type',
                'after' => 'brk_id',
            ])
            ->addColumn('dtyp_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'dtyp_name',
            ])
            ->addColumn('dtyp_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'dtyp_from',
            ])
            ->addColumn('dtyp_lifetime', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '9',
                'comment' => 'Durée de conservation',
                'after' => 'dtyp_to',
            ])
            ->addColumn('dtyp_lifetime_type', 'enum', [
                'null' => true,
                'default' => '\'REMOVE\'',
                'limit' => 7,
                'values' => ['ARCHIVE', 'REMOVE'],
                'comment' => 'Que faire en fin de vie',
                'after' => 'dtyp_lifetime',
            ])
            ->create();
        $this->table('ged_metadata', [
                'id' => false,
                'primary_key' => ['meta_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('meta_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant de la metadonnée',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'application',
                'after' => 'meta_id',
            ])
            ->addColumn('meta_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Code',
                'after' => 'brk_id',
            ])
            ->addColumn('meta_name', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Nom',
                'after' => 'meta_code',
            ])
            ->addColumn('meta_type', 'enum', [
                'null' => false,
                'default' => '\'SIMPLE\'',
                'limit' => 6,
                'values' => ['SIMPLE', 'LIST', 'SIZE'],
                'comment' => 'Type',
                'after' => 'meta_name',
            ])
            ->addColumn('meta_from', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'meta_type',
            ])
            ->addColumn('meta_to', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'meta_from',
            ])
            ->addColumn('meta_list', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'comment' => 'Liste de valeurs',
                'after' => 'meta_to',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'fk_metadata_broker',
                'unique' => false,
            ])
            ->create();
        $this->table('tech_applicationversionparam', [
                'id' => false,
                'primary_key' => ['avp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('avp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('apv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'avp_id',
            ])
            ->addColumn('avp_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'apv_id',
            ])
            ->addColumn('avp_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'avp_code',
            ])
            ->addColumn('avp_required', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'avp_desc',
            ])
            ->addColumn('avp_default', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'avp_required',
            ])
            ->create();
        $this->table('tech_serviceparam', [
                'id' => false,
                'primary_key' => ['sp_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sp_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('serv_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'sp_id',
            ])
            ->addColumn('ap_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'serv_id',
            ])
            ->addColumn('ap_desc', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ap_name',
            ])
            ->addColumn('ap_required', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'ap_desc',
            ])
            ->addColumn('ap_default', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ap_required',
            ])
            ->create();
        $this->table('ged_user_inbox', [
                'id' => false,
                'primary_key' => ['inbx_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('inbx_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
                'comment' => 'Identifiant',
            ])
            ->addColumn('brk_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'application',
                'after' => 'inbx_id',
            ])
            ->addColumn('user_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant de l\'utilisateur',
                'after' => 'brk_id',
            ])
            ->addColumn('dlnk_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'comment' => 'Identifiant du lien de la version du document',
                'after' => 'user_id',
            ])
            ->addColumn('inbx_created', 'timestamp', [
                'null' => true,
                'default' => null,
                'comment' => 'Date d\'ajout',
                'after' => 'dlnk_id',
            ])
            ->addColumn('inbx_ts', 'timestamp', [
                'null' => true,
                'default' => null,
                'comment' => 'Date de la dernière action',
                'after' => 'inbx_created',
            ])
            ->addColumn('inbx_show', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'comment' => 'Afficher le lien ?',
                'after' => 'inbx_ts',
            ])
            ->addIndex(['brk_id'], [
                'name' => 'user_inbox_broker',
                'unique' => false,
            ])
            ->addIndex(['user_id'], [
                'name' => 'user_inbox_user',
                'unique' => false,
            ])
            ->addIndex(['dlnk_id'], [
                'name' => 'user_inbox_document_version_link',
                'unique' => false,
            ])
            ->create();
        $this->table('sso_broker_session', [
                'id' => false,
                'primary_key' => ['brs_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('brs_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'identity' => 'enable',
            ])
            ->addColumn('brk_key', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brs_id',
            ])
            ->addColumn('brs_token', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brk_key',
            ])
            ->addColumn('brs_session_id', 'string', [
                'null' => true,
                'default' => '\'\'',
                'limit' => 80,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brs_token',
            ])
            ->addColumn('brs_client_address', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'brs_session_id',
            ])
            ->addColumn('brs_date_created', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'brs_client_address',
            ])
            ->addColumn('brs_end', 'timestamp', [
                'null' => true,
                'default' => null,
                'after' => 'brs_date_created',
            ])
            ->addColumn('sess_id', 'biginteger', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_BIG,
                'signed' => false,
                'after' => 'brs_end',
            ])
            ->addIndex(['sess_id'], [
                'name' => 'fk_brokers_sess_id',
                'unique' => false,
            ])
            ->addIndex(['brk_key', 'brs_token'], [
                'name' => 'sso_brokers_sessions_idx1',
                'unique' => false,
            ])
            ->addIndex(['brs_end'], [
                'name' => 'sso_brokers_sessions_idx2',
                'unique' => false,
            ])
            ->create();
    }
}
