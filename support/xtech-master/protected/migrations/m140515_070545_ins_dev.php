<?php

class m140515_070545_ins_dev extends CDbMigration
{
	public function up()
	{
		$this->insert('t_devices',array(			
				'id_organization' => '1',
				'id_branch' => '2',
				'id_department' => '1',
				'id_cabinet' => '1',				
				'id_employee' => '1',				
				'id_type' => '2',				
				'name' => 'bms',
				'description' => 'desc',
				'inv_number' => '1130100',
				'sn' => 'AA100',
				'year' => '2008',
				'end_varantly_yesr' => '2009',
				'service' => 'dervice BMS',
				'expluatation' => 'true',
				'expluatation_data' => '2008-12-14',
				'private' => 'false',
				'break' => 'false',
			));
		$this->insert('t_devices',array(			
				'id_organization' => '1',
				'id_branch' => '2',
				'id_department' => '1',
				'id_cabinet' => '1',				
				'id_employee' => '1',				
				'id_type' => '1',				
				'name' => 'lg',
				'description' => 'desc',
				'inv_number' => '1130101',
				'sn' => 'BB100',
				'year' => '2008',
				'end_varantly_yesr' => '2009',
				'service' => 'dervice LG',
				'expluatation' => 'true',
				'expluatation_data' => '2008-12-14',
				'private' => 'false',
				'break' => 'false',
			));
	}

	public function down()
	{
		echo "m140515_070545_ins_dev does not support migration down.\n";
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