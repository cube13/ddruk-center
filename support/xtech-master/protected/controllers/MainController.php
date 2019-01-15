<?php

class MainController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$org = new Organization('search');
		$org->unsetAttributes();
		$organizations = $org->findAll();

        $model = new Device('search');
        $model->unsetAttributes();

        $sort = new CSort();
        $sort->attributes = array(
            'name'=>array(
                'asc'=>'t.name',
                'desc'=>'t.name DESC'
            ),
            'year'=>array(
                'asc'=>'year',
                'desc'=>'year DESC'
            ),
            'sn'=>array(
                'asc'=>'sn',
                'desc'=>'sn DESC'
            ),
            'inv_number'=>array(
                'asc'=>'inv_number',
                'desc'=>'inv_number DESC'
            ),
            'devicetype'=>array(
                'asc'=>'devicetype.name',
                'desc'=>'devicetype.name DESC'
            ),
            'employee'=>array(
                'asc'=>'employee.firstname',
                'desc'=>'employee.firstname DESC'
            ),
        );

        $criteria = new CDbCriteria();
        $criteria->with = array('devicetype','employee');

		$dataProvider = new CActiveDataProvider($model, array(
                            'criteria'=>$criteria,
                            'pagination'=>array('pageSize'=>30),
                            'sort' => $sort,
                        ));

		$this->render('index',array(
			'organizations'=>$organizations,
			'dataProvider' => $dataProvider,
		));
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionShow($id)
	{
		$id_organization = (int)$id;
		$criteria = new CDbCriteria();
		$criteria->addCondition('id_organization=:id_organization');
		$criteria->params = array(':id_organization'=>$id_organization);

		$dataProvider = new CActiveDataProvider('Device',array('criteria'=>$criteria));

		if (Yii::app()->request->isAjaxRequest) {
      		$this->renderPartial('_device', array(
        		'dataProvider' => $dataProvider),
        		false,
        		true	
      		);
      		Yii::app()->end();
    	}
	}

	public function actionShowAll()
	{		
		$dataProvider = new CActiveDataProvider('Device');

		if (Yii::app()->request->isAjaxRequest) {
      		$this->renderPartial('_device', array(
        		'dataProvider' => $dataProvider),
        		false,
        		true	
      		);
      		Yii::app()->end();
    	}
	}	
}