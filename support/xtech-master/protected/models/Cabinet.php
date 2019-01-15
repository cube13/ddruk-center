<?php

/**
 * This is the model class for table "t_cabinets".
 *
 * The followings are the available columns in table 't_cabinets':
 * @property integer $id_cabinet
 * @property integer $id_department
 * @property string $number
 * @property string $description
 * @property string $telephones
 */
class Cabinet extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_cabinets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number', 'required'),
			array('id_department', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>20),
			array('description', 'length', 'max'=>500),
			array('telephones', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cabinet, id_department, number, description, telephones', 'safe', 'on'=>'search'),
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
			//'device' => array(self::HAS_MANY, 'Device', 'id_cabinet'),
			'department' => array(self::BELONGS_TO, 'Department', 'id_department'),
			'employee' => array(self::HAS_MANY, 'Employee', 'id_cabinet'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cabinet' => 'Id Cabinet',
			'id_department' => 'Відділ',
			'number' => 'Номер',
			'description' => 'Примітка',
			'telephones' => 'Телефони',
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

		$criteria->compare('id_cabinet',$this->id_cabinet);
		$criteria->compare('id_department',$this->id_department);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('telephones',$this->telephones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cabinet the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
