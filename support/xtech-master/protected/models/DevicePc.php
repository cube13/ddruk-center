<?php

/**
 * This is the model class for table "t_device_pc".
 *
 * The followings are the available columns in table 't_device_pc':
 * @property integer $id_device
 * @property string $mb
 * @property string $cpu_name
 * @property double $cpu_p
 * @property string $hdd_name
 * @property double $hdd_p
 * @property string $ram_name
 * @property double $ram_p
 * @property string $video_name
 * @property integer $video_p
 * @property string $cdrom_name
 * @property string $lan_name
 * @property string $os
 * @property string $net_name
 * @property string $ip
 */
class DevicePc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_device_pc';
	}

    public function behaviors()
    {
        return array(
            'ELoggingPC' => array(
                'class' => 'application.behaviors.ELoggingPC',
            ),
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_device_pc, video_p', 'numerical', 'integerOnly'=>true),
			array('cpu_p, hdd_p, ram_p', 'numerical'),
			array('mb, cpu_name, hdd_name, ram_name, video_name, cdrom_name, lan_name, os, net_name, ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,id_device_pc, mb, cpu_name, cpu_p, hdd_name, hdd_p, ram_name, ram_p, video_name, video_p, cdrom_name, lan_name, os, net_name, ip', 'safe', 'on'=>'search|save|insert'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'device' => array(self::BELONGS_TO, 'Device', 'id_device_pc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'id_device_pc' => 'Id Device PC',
			'mb' => 'Материнська плата',
			'cpu_name' => 'Процесор',
			'cpu_p' => 'Швидкість процесора',
			'hdd_name' => 'Жорсткий диск',
			'hdd_p' => 'Об\'ем жорсткого диску',
			'ram_name' => 'Оперативна пам\'ять',
			'ram_p' => 'Об\'ем оперативної пам\'яті',
			'video_name' => 'Відеоадаптер',
			'video_p' => 'Об\'ем відеопам\'яті',
			'cdrom_name' => 'CD/DVD привід',
			'lan_name' => 'Мережна карта',
			'os' => 'Операційна система',
			'net_name' => 'Мережне ім\'я',
			'ip' => 'IP адреса',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_device_pc',$this->id_device_pc);
		$criteria->compare('mb',$this->mb,true);
		$criteria->compare('cpu_name',$this->cpu_name,true);
		$criteria->compare('cpu_p',$this->cpu_p);
		$criteria->compare('hdd_name',$this->hdd_name,true);
		$criteria->compare('hdd_p',$this->hdd_p);
		$criteria->compare('ram_name',$this->ram_name,true);
		$criteria->compare('ram_p',$this->ram_p);
		$criteria->compare('video_name',$this->video_name,true);
		$criteria->compare('video_p',$this->video_p);
		$criteria->compare('cdrom_name',$this->cdrom_name,true);
		$criteria->compare('lan_name',$this->lan_name,true);
		$criteria->compare('os',$this->os,true);
		$criteria->compare('net_name',$this->net_name,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DevicePc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
