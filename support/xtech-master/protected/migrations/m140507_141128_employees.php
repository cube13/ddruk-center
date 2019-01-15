<?php

class m140507_141128_employees extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_employees',array(
				'id_employee' => 'pk',			
				'id_organization' => 'INT(2)',
				'id_branch' => 'INT(2)',
				'id_department' => 'INT(2)',
				'id_cabinet' => 'INT(2)',				
				'firstname' => 'VARCHAR(20) NOT NULL',
				'lastname' => 'VARCHAR(20) NOT NULL',
				'surname' => 'VARCHAR(20) NOT NULL',				
				'description' => 'string',
				'telephones' => 'string',
				'post' => 'string',
				'email' => 'VARCHAR(50) DEFAULT NULL',
				'login' => 'VARCHAR(50) DEFAULT NULL',
				'tab_number' => 'INT(10) DEFAULT NULL',
				'home_address' => 'string',
				'dob' => 'date',
				'pasp' => 'string',
				'fired' => 'boolean',
				'dof' => 'date',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_employees');
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