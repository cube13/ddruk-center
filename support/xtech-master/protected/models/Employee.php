<?php

/**
 * This is the model class for table "t_employees".
 *
 * The followings are the available columns in table 't_employees':
 * @property integer $id_employee
 * @property integer $id_cabinet
 * @property string $firstname
 * @property string $lastname
 * @property string $surname
 * @property string $description
 * @property string $telephones
 * @property string $post
 * @property string $email
 * @property string $login
 * @property integer $tab_number
 * @property string $home_address
 * @property string $dob
 * @property string $pasp
 * @property integer $fired
 * @property string $dof
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_employees';
	}

    public function behaviors()
    {
        return array(
            'EDataConvert' => array(
                'class' => 'application.behaviors.EDataConvert',
                'params' => array('dob', 'dof'),
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
			array('firstname, lastname, surname', 'required'),
			array('id_cabinet, tab_number, fired', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname, surname', 'length', 'max'=>20),
			array('description, telephones, post, home_address, pasp', 'length', 'max'=>255),
			array('email, login', 'length', 'max'=>50),
			array('dob, dof', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_employee, id_cabinet, firstname, lastname, surname, description, telephones, post, email, login, tab_number, home_address, dob, pasp, fired, dof', 'safe', 'on'=>'search'),
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
			'device' => array(self::HAS_MANY, 'Device', 'id_employee'),
            'cabinet' => array(self::BELONGS_TO, 'Cabinet', 'id_cabinet'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_employee' => 'Id Employee',
			'id_cabinet' => 'Кабінет',
			'firstname' => 'Прізвище',
			'lastname' => 'Ім\'я',
			'surname' => 'По-батькові',
			'description' => 'Примітка',
			'telephones' => 'Телефони',
			'post' => 'post',
			'email' => 'Email',
			'login' => 'Login',
			'tab_number' => 'Табельний номер',
			'home_address' => 'Домашня адреса',
			'dob' => 'Дата народження',
			'pasp' => 'Паспорт',
			'fired' => 'Звільнений',
			'dof' => 'Дата звільнення',
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

		$criteria->compare('id_employee',$this->id_employee);
		$criteria->compare('id_cabinet',$this->id_cabinet);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('telephones',$this->telephones,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('tab_number',$this->tab_number);
		$criteria->compare('home_address',$this->home_address,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('pasp',$this->pasp,true);
		$criteria->compare('fired',$this->fired);
		$criteria->compare('dof',$this->dof,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
