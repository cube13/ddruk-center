<?php

class m140507_112643_insert_branches extends CDbMigration
{
	public function up()
	{
		$this->insert('t_branches', array(
				'name' => 'mira',
				'description' => 'Branch on Mira',
				'telephones' => '40977',
				'emails' => 'pfu@i.ua',
				'address' => '52501, Sinelnikovo, Mira, 27',
			));
		$this->insert('t_branches', array(
				'name' => 'engelsa',
				'description' => 'Branch on Engelsa street',
				'telephones' => '41382',
				'emails' => 'pfupp@i.ua',
				'address' => '52500, Sinelnikovo, Engelsa, 3a',
			));
	}

	public function down()
	{
		echo "m140507_112643_insert_branches does not support migration down.\n";
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