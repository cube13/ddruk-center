<?php

/**
 * This is the model class for table "t_branches".
 *
 * The followings are the available columns in table 't_branches':
 * @property integer $id_branch
 * @property string $name
 * @property integer $id_organization
 * @property string $description
 * @property string $telephones
 * @property string $emails
 * @property string $www
 * @property string $address
 */
class Branch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_branches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, id_organization', 'required'),
			array('id_organization', 'numerical', 'integerOnly'=>true),
			array('name, telephones, www, address', 'length', 'max'=>255),
			array('description, emails', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_branch, name, id_organization, description, telephones, emails, www, address', 'safe', 'on'=>'search'),
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
			'device' => array(self::HAS_MANY, 'Device', 'id_branch'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
			'department' => array(self::HAS_MANY, 'Department', 'id_branch'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_branch' => 'Id Branch',
			'name' => 'Назва',
			'id_organization' => 'Організація',
			'description' => 'Примітка',
			'telephones' => 'Телефони',
			'emails' => 'Email',
			'www' => 'Веб-сайт',
			'address' => 'Адреса',
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

		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_organization',$this->id_organization);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('telephones',$this->telephones,true);
		$criteria->compare('emails',$this->emails,true);
		$criteria->compare('www',$this->www,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Branch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*TODO for cascade update*/
	public function searchIncludingPermissions($org_parentID)
    {
        $criteria=new CDbCriteria;
        $criteria->condition = 'id_organization = :org_parentID';
        $criteria->params = array(':org_parentID'=>$org_parentID);
 
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
