<?php

class m140507_113034_insert_departmens extends CDbMigration
{
	public function up()
	{
		$this->insert('t_departmens',array(
				'id_branch' => '1',
				'name' => 'ispz',
				'description' => 'ispz department',
				'telephones' => '40692',
			));
		$this->insert('t_departmens',array(
				'id_branch' => '1',
				'name' => 'zagal',
				'description' => 'zagal department',
				'telephones' => '41162',
			));
	}

	public function down()
	{
		echo "m140507_113034_insert_departmens does not support migration down.\n";
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