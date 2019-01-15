<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

/*$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	'Create',
);
*/
$this->menu=array(
	//array('label'=>'List DeviceType', 'url'=>array('index')),
	array('label'=>'Повернутись', 'url'=>array('admin')),
);
?>

<h1>Створити тип пристроїв</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>