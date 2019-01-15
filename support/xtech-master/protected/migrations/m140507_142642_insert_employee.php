<?php

class m140507_142642_insert_employee extends CDbMigration
{
	public function up()
	{
		$this->insert('t_employees',array(
				'id_organization' => '1',
				'id_branch' => '2',
				'id_department' => '1',
				'id_cabinet' => '2',				
				'firstname' => 'Galushko',
				'lastname' => 'Dmitro',
				'surname' => 'Oleksandrovich',				
				'description' => 'cool men',
				'telephones' => '0664297689',
				'email' => 'sinelnikovodima@mail.ru',
				'login' => 'jazzz',
				'tab_number' => '111',
				'home_address' => 'USSR',
				'dob' => '1983-04-05',
				'pasp' => 'AK 156156',
				'fired' => '0',
			));
		$this->insert('t_employees',array(
				'id_organization' => '1',
				'id_branch' => '2',
				'id_department' => '1',
				'id_cabinet' => '2',				
				'firstname' => 'Monah',
				'lastname' => 'San',
				'surname' => 'Vas',				
				'description' => 'the',
				'telephones' => '0661565648',
				'email' => 'mon@mail.ru',
				'login' => 'monah',
				'tab_number' => '222',
				'home_address' => 'USA',
				'dob' => '1980-05-15',
				'pasp' => 'AK 555555',
				'fired' => '0',
			));
		$this->insert('t_employees',array(
				'id_organization' => '1',
				'id_branch' => '2',
				'id_department' => '2',
				'id_cabinet' => '3',				
				'firstname' => 'Zaika',
				'lastname' => 'Lil',
				'surname' => 'Sergo',				
				'description' => 'girl',
				'telephones' => '05648548545',
				'email' => 'mail@mail.ru',
				'login' => 'lilo',
				'tab_number' => '333',
				'home_address' => 'USSR',
				'dob' => '1983-04-05',
				'pasp' => 'AK 156156',
				'fired' => '0',
			));
		$this->insert('t_employees',array(
				'id_organization' => '1',
				'id_branch' => '2',
				'id_department' => '1',
				'id_cabinet' => '4',				
				'firstname' => 'Reutova',
				'lastname' => 'Luda',
				'surname' => 'Oleksandrovich',				
				'description' => 'the',
				'telephones' => '0664297689',
				'email' => 'luda@mail.ru',
				'login' => 'reut',
				'tab_number' => '4444',
				'home_address' => 'USSR',
				'dob' => '1983-04-05',
				'pasp' => 'AK 156156',
				'fired' => '0',
			));		
	}

	public function down()
	{
		echo "m140507_142642_insert_employee does not support migration down.\n";
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