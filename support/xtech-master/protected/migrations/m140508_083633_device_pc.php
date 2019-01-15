<?php

class m140508_083633_device_pc extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_device_pc',array(
				'id_device' => 'integer',			
				'mb' => 'string',
				'cpu_name' => 'string',
				'cpu_p' => 'real',
				'hdd_name' => 'string',				
				'hdd_p' => 'real',				
				'ram_name' => 'string',				
				'ram_p' => 'real',
				'video_name' => 'string',
				'video_p' => 'integer',
				'cdrom_name' => 'string',
				'lan_name' => 'string',
				'os' => 'string',
				'net_name' => 'string',
				'ip' => 'string',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('t_device_pc');
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