<?php

class m140507_143643_type_dev extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_devices_types',array(
				'id_device_type' => 'pk',			
				'name' => 'string',
				'description' => 'string',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_devices_types');
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