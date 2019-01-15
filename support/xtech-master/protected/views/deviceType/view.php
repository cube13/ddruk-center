<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

/*$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	$model->name,
);*/

$this->menu=array(
	//array('label'=>'List DeviceType', 'url'=>array('index')),
    array('label'=>'Повернутись', 'url'=>array('admin')),
	array('label'=>'Створити', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_device_type)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_device_type),'confirm'=>'Ви впевнені?')),

);
?>

<h1>Перегляд типу пристроїв: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_device_type',
		'name',
		'description',
	),
)); ?>
