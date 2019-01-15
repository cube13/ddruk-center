<?php

class m140515_073309_ins_devpc extends CDbMigration
{
	public function up()
	{
		$this->insert('t_device_pc',array(
				'id_device' => '1',			
				'mb' => 'gigabyte 3a',
				'cpu_name' => 'intel',
				'cpu_p' => '1.6',
				'hdd_name' => 'maxtor',				
				'hdd_p' => '250',				
				'ram_name' => 'hynix',				
				'ram_p' => '1024',
				'video_name' => 'nvidia',
				'video_p' => '256',
				'cdrom_name' => 'nec',
				'lan_name' => 'realtek',
				'os' => 'windows 7 ultimate',
				'net_name' => 'nach_ispz',
				'ip' => '172.40.96.163',
			));
	}

	public function down()
	{
		echo "m140515_073309_ins_devpc does not support migration down.\n";
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