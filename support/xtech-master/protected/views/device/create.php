<?php
/* @var $this DeviceController */
/* @var $model Device */

/*$this->breadcrumbs=array(
	'Devices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Device', 'url'=>array('index')),
	array('label'=>'Manage Device', 'url'=>array('admin')),
);*/
?>

<h1>Додати пристрій: <?php echo DeviceType::model()->findByPk($device_type)->name; ?></h1>

<?php 

if (isset($model_pc)) {
	$this->renderPartial('_form_create_pc', 
						array('model'=>$model,
                              'model_pc'=>$model_pc,
                              'device_type'=>$device_type,
                              'parent'=>$parent,));
} else {
	$this->renderPartial('_form_create', 
						array('model'=>$model,
                              'device_type'=>$device_type,
                              'parent'=>$parent,));
}

?>