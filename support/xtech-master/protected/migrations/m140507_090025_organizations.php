<?php

class m140507_090025_organizations extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_organizations',array(
				'id_organization' => 'INT(2) PRIMARY KEY AUTO_INCREMENT',
				'name' => 'VARCHAR(255) NOT NULL',
				'description' => 'VARCHAR(500) DEFAULT NULL',
				'telephones' => 'VARCHAR(255) DEFAULT NULL',
				'emails' => 'VARCHAR(500) DEFAULT NULL',
				'www' => 'VARCHAR(255) DEFAULT NULL',
				'address' => 'VARCHAR(255) DEFAULT NULL',
				'boss' => 'INT(10) DEFAULT NULL',
				'buh' => 'INT(10) DEFAULT NULL',
				'okpo' =>  'VARCHAR(20) DEFAULT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_organizations');
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