<?php

class m140507_143657_ins_type_dev extends CDbMigration
{
	public function up()
	{
		$this->insert('t_devices_types',array(
				'name' => 'monitor',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'pc',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'notebook',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'printer',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'ups',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'xerox',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'telephone',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'hub',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'switch',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'modem',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'keyboard',
				'description' => 'description of monitors',
			));		
		$this->insert('t_devices_types',array(
				'name' => 'mouse',
				'description' => 'description of monitors',
			));		
	}

	public function down()
	{
		echo "m140507_143657_ins_type_dev does not support migration down.\n";
		return false;
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