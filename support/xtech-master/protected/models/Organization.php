<?php

/**
 * This is the model class for table "t_organizations".
 *
 * The followings are the available columns in table 't_organizations':
 * @property integer $id_organization
 * @property string $name
 * @property string $description
 * @property string $telephones
 * @property string $emails
 * @property string $www
 * @property string $address
 * @property integer $boss
 * @property integer $buh
 * @property string $okpo
 */
class Organization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_organizations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('boss, buh', 'numerical', 'integerOnly'=>true),
			array('name, telephones, www, address', 'length', 'max'=>255),
			array('description, emails', 'length', 'max'=>500),
			array('okpo', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_organization, name, description, telephones, emails, www, address, boss, buh, okpo', 'safe', 'on'=>'search'),
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
			'branch' => array(self::HAS_MANY, 'Branch', 'id_organization'),
			'device' => array(self::HAS_MANY, 'Device', 'id_organization'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_organization' => 'Id Organization',
			'name' => 'Назва',
			'description' => 'Примітка',
			'telephones' => 'Телефони',
			'emails' => 'Email',
			'www' => 'Веб-сайт',
			'address' => 'Адреса',
			'boss' => 'Керівник',
			'buh' => 'Головний бухгалтер',
			'okpo' => 'ОКПО',
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

		$criteria->compare('id_organization',$this->id_organization);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('telephones',$this->telephones,true);
		$criteria->compare('emails',$this->emails,true);
		$criteria->compare('www',$this->www,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('boss',$this->boss);
		$criteria->compare('buh',$this->buh);
		$criteria->compare('okpo',$this->okpo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Organization the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
