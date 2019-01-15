<?php

class m140507_094700_insert_organization extends CDbMigration
{
	public function up()
	{
		$this->insert('t_organizations', array(
				'name' => 'Pens fond of Ukraine',
				'description' => 'Pens fond of Ukraine is very big big big organization',
				'telephones' => '0664297689, 40692',
				'emails' => 'pfumail@mail.com',
				'www' => 'http://www.pfusin.gov.ua',
				'address' => '52500, Sinelnikovo, Mira, 27',
				'boss' => '',
				'buh' => '',
				'okpo' =>  '1564676',
			));
	}

	public function down()
	{
		echo "m140507_094700_insert_organization does not support migration down.\n";
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