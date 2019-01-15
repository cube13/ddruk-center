<?php

class m140507_113458_cabinets extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_cabinets',array(
				'id_cabinet' => 'INT(2) PRIMARY KEY AUTO_INCREMENT',			
				'id_department' => 'INT(2)',
				'number' => 'VARCHAR(20) NOT NULL',
				'description' => 'VARCHAR(500) DEFAULT NULL',
				'telephones' => 'VARCHAR(255) DEFAULT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_cabinets');
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