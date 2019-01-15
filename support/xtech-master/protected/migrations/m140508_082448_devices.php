<?php

class m140508_082448_devices extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_devices',array(
				'id_device' => 'pk',			
				'id_organization' => 'INT(2)',
				'id_branch' => 'INT(2)',
				'id_department' => 'INT(2)',
				'id_cabinet' => 'INT(2)',				
				'id_employee' => 'INT(2)',				
				'id_type' => 'INT(2)',				
				'name' => 'string',
				'description' => 'string',
				'inv_number' => 'integer',
				'sn' => 'string',
				'year' => 'integer',
				'end_varantly_yesr' => 'integer',
				'service' => 'string',
				'expluatation' => 'boolean',
				'expluatation_data' => 'date',
				'private' => 'boolean',
				'break' => 'boolean',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_devices');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}