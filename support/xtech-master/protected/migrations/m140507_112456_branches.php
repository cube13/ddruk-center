<?php

class m140507_112456_branches extends CDbMigration
{
	public function up()
	{		
		$this->createTable('t_branches',array(
				'id_branch' => 'INT(2) PRIMARY KEY AUTO_INCREMENT',
				'id_organization' => 'INT(2)',
				'name' => 'VARCHAR(255) NOT NULL',
				'description' => 'VARCHAR(500) DEFAULT NULL',
				'telephones' => 'VARCHAR(255) DEFAULT NULL',
				'emails' => 'VARCHAR(500) DEFAULT NULL',
				'www' => 'VARCHAR(255) DEFAULT NULL',
				'address' => 'VARCHAR(255) DEFAULT NULL',
			), 'ENGINE=InnoDB');		
	}

	public function down()
	{
		$this->dropTable('t_branches');
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