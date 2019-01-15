<?php

class m140508_114310_users extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_users',array(
				'id_user' => 'pk',			
				'id_login' => 'string',
				'id_pass' => 'string',
				'description' => 'string',
			), 'ENGINE=InnoDB');
		$this->insert('t_users', array(
				'id_login' => 'admin',
				'id_pass' => 'admin',
				'description' => 'description of admin user',
			));
	}

	public function down()
	{
		$this->dropTable('t_users');
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