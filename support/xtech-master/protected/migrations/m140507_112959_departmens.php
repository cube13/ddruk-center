<?php

class m140507_112959_departmens extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_departmens',array(
				'id_department' => 'INT(2) PRIMARY KEY AUTO_INCREMENT',
				'id_branch' => 'INT(2)',
				'name' => 'VARCHAR(255) NOT NULL',
				'description' => 'VARCHAR(500) DEFAULT NULL',
				'telephones' => 'VARCHAR(255) DEFAULT NULL',
				'emails' => 'VARCHAR(500) DEFAULT NULL',
				'boss' => 'INT(2)',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_departmens');
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