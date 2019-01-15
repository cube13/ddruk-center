<?php

class DevController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionShow($id)
	{
        $dataProvider = DevShowGrid::getData('t_organizations', (int)$id);
        //$dataProvider->sort = $sort;
        //$dataProvider->pagination->pageSize = 20;

		if (Yii::app()->request->isAjaxRequest) {
      		$this->renderPartial('//main/_device', array(
        		'dataProvider' => $dataProvider),
        		false,
        		true	
      		);
      		Yii::app()->end();
    	}
	}

	public function actionShowAll()
	{		
		$dataProvider = new CActiveDataProvider('Device',
                                array('pagination'=>array('pageSize'=>30)));

		if (Yii::app()->request->isAjaxRequest) {
      		$this->renderPartial('//main/_device', array(
        		'dataProvider' => $dataProvider)
        		//false,
        		//true
      		);
      		Yii::app()->end();
    	}
	}		
}