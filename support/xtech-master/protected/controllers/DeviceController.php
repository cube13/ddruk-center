<?php

class DeviceController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','changelist'),
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

	public function actionLoad($id)
	{
		$id_employee = (int)$id;

		$model = new Device;
		$model->unsetAttributes();

		$device = $model->findAllByAttributes(array('id_employee'=>$id_employee));

		echo CJSON::encode($device);
	}

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
	public function actionCreate($device_type, $parent)
	{
		$device_type = (int)$device_type;
        $parent = (int)$parent;

		$models = array();
		$models['device_type'] = $device_type;
        $models['parent'] = $parent;
		$models['model'] = new Device;

		if (($device_type == 2) || ($device_type == 3)) {
			$models['model_pc'] = new DevicePc;
		}
		
		if(isset($_POST['Device']) && !isset($_POST['DevicePc']))
		{
			$model = $models['model'];
			$model->attributes=$_POST['Device'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_device));

		} elseif (isset($_POST['Device']) && isset($_POST['DevicePc'])) 
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model = $models['model'];
				$model->attributes=$_POST['Device'];
				$model->save();
				
				$model_pc = $models['model_pc'];				
				$model_pc->attributes=$_POST['DevicePc'];
				$model_pc->id_device_pc = $model->id_device;
				$model_pc->save();
				
				$transaction->commit();
				$this->redirect(array('view','id'=>$model->id_device));
			} catch(Exception $e) {
            		$transaction->rollback();
            		$error = $e->getMessage();
                    echo $error;
        	}			
		}

		$this->render('create',$models);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$model_pc = $model->devicepc;

		if (isset($_POST['Device']) && isset($_POST['DevicePc']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->attributes=$_POST['Device'];
				$model_pc->attributes=$_POST['DevicePc'];
				$model->save();
				$model_pc->save();
				$transaction->commit();
			} catch(Exception $e) {
            	$transaction->rollback();
            	$error = $e->getMessage();
                echo $error;
        	}
        	$this->redirect(array('view','id'=>$model->id_device));						
    	} elseif (isset($_POST['Device']) && !isset($_POST['DevicePc'])) {
			$model->attributes=$_POST['Device'];
			$model->save();
        	$this->redirect(array('view','id'=>$model->id_device));		
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
		$model = $this->loadModel($id);
		$transaction = Yii::app()->db->beginTransaction();
		try {
			if ($model->devicepc) {
				$model->devicepc->delete();				
			}
			$model->delete();				
			$transaction->commit();
		} catch (Exception $e) {
            $transaction->rollBack();
            $error = $e->getMessage();
            echo $error;
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_POST['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Device');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Device('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Device']))
			$model->attributes=$_GET['Device'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Device the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Device::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Device $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='device-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionChangeList($id, $val)
	{
		$model_name = explode('_',$id)[2];
		$id = (int)$val;
		
		$model = new $model_name('search');

		$class_name = get_class($model);

		switch ($class_name) {
			case 'Organization': 
					$branch = $this->loadList('branch',$id);
					$department = $this->loadList('department',$id);
					$cabinet = $this->loadList('cabinet',$id);
					$employee = $this->loadList('employee',$id);
					$lists = array($branch,$department,$cabinet,$employee,$employee);
					break;
			case 'Branch':;
					break;		
			case 'Department':;
					break;	
			case 'Cabinet':;
					break;			
			case 'Employee':;
					break;
			default:
				throw new CException('Error');
		}

		echo CJSON::encode($lists);

		//var_dump(get_class($model));
	}

	protected function loadList($name, $id){
		//$model = $name::model()->
	}
}
