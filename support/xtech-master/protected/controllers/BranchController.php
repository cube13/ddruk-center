<?php

class BranchController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($parent)
	{
		$model = new Branch;

		if(isset($_POST['Branch']))
		{
			$model->attributes=$_POST['Branch'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_branch));
		}

		$this->render('create',array(
			'model' => $model,
            'parent' => (int)$parent,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Branch']))
		{
			$model->attributes=$_POST['Branch'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_branch));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$transaction = Yii::app()->db->beginTransaction();
		
		try {									
			$branch = $this->loadModel($id);
				
			$departments = $branch->department;
				if ($departments) { 
					foreach ($departments as $department) {				
						$cabinets = $department->cabinet;
						if ($cabinets) {
							foreach ($cabinets as $cabinet){						
								$employees = $cabinet->employee;
								if ($employees) {
									foreach ($employees as $employee) {
										$employee->id_cabinet = null;
										$employee->save();
									}
								}
								$cabinet->delete();
							}
						}
						$department->delete();
					}
				}
			$branch->delete();
				
			$transaction->commit();
			
		} catch(Exception $e) { 
            		$transaction->rollback();
            		$error = $e->getMessage();
            echo $error;
        }
		
		$this->redirect('?r=structure/index');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Branch');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Branch('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Branch']))
			$model->attributes=$_GET['Branch'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Branch the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Branch::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Branch $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='branch-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionShow($id)
	{
        $dataProvider = DevShowGrid::getData('t_branches', (int)$id);

		if (Yii::app()->request->isAjaxRequest) {
      		$this->renderPartial('//main/_device', array(
        		'dataProvider' => $dataProvider),
        		false,
        		true	
      		);
      		Yii::app()->end();
    	}
	}

	public function actionLoad($id)
	{
		$id_organization = (int)$id;

		$model = new Branch;
		$model->unsetAttributes();

		$branches = $model->findAllByAttributes(array('id_organization'=>$id_organization));

		echo CJSON::encode($branches);
	}

	public function actionLoadByOrganization()
	{
		$id_organization = (int)$_POST['id_organization'];
		$branch = Branch::model()->findAll('id_organization=:id_organization',
											array('id_organization'=>$id_organization));

		 $list = CHtml::listData($branch,'id_branch','name');

		echo "<option value=''>Виберіть корпус</option>";
   		foreach($list as $value=>$branch_name)
   			echo CHtml::tag('option', array('value'=>$value),
   									  CHtml::encode($branch_name),true);
	}
}
