<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

/*$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id_device_type),
	'Update',
);*/

$this->menu=array(
    array('label'=>'Повернутись', 'url'=>array('admin')),
	array('label'=>'Створити', 'url'=>array('create')),
	array('label'=>'Перегляд', 'url'=>array('view', 'id'=>$model->id_device_type)),

);
?>

<h1>Редагувати тип пристроїв: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>