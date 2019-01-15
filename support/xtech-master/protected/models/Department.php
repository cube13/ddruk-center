<?php

/**
 * This is the model class for table "t_departmens".
 *
 * The followings are the available columns in table 't_departmens':
 * @property integer $id_department
 * @property integer $id_branch
 * @property string $name
 * @property string $description
 * @property string $telephones
 * @property string $emails
 * @property integer $boss
 */
class Department extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_departmens';
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
			array('id_branch, boss', 'numerical', 'integerOnly'=>true),
			array('name, telephones', 'length', 'max'=>255),
			array('description, emails', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_department, id_branch, name, description, telephones, emails, boss', 'safe', 'on'=>'search'),
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
			'device' => array(self::HAS_MANY, 'Device', 'id_department'),
			'branch' => array(self::BELONGS_TO, 'Branch', 'id_branch'),
			'cabinet' => array(self::HAS_MANY, 'Cabinet', 'id_department'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_department' => 'Id Department',
			'id_branch' => 'Філія',
			'name' => 'Назва',
			'description' => 'Примітка',
			'telephones' => 'Телефони',
			'emails' => 'Email',
			'boss' => 'Керівник відділу',
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

		$criteria->compare('id_department',$this->id_department);
		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('telephones',$this->telephones,true);
		$criteria->compare('emails',$this->emails,true);
		$criteria->compare('boss',$this->boss);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Department the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
