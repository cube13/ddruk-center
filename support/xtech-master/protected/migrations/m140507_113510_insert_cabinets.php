<?php

class m140507_113510_insert_cabinets extends CDbMigration
{
	public function up()
	{
		$this->insert('t_cabinets',array(			
				'id_department' => '2',
				'number' => '9a',
				'description' => 'servers room',
			));
		$this->insert('t_cabinets',array(			
				'id_department' => '2',
				'number' => '9',
				'description' => 'second floor',
				'telephones' => '4-06-92',
			));
		$this->insert('t_cabinets',array(			
				'id_department' => '3',
				'number' => '8',
				'description' => 'zagal',
				'telephones' => '4-11-62',
			));
		$this->insert('t_cabinets',array(			
				'id_department' => '3',
				'number' => '11',
				'description' => 'zagal nach',
				'telephones' => '4-06-18',
			));
	}

	public function down()
	{
		echo "m140507_113510_insert_cabinets does not support migration down.\n";
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