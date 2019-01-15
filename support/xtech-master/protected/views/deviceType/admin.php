<?php
/* @var $this DeviceTypeController */
/* @var $model DeviceType */

/*$this->breadcrumbs=array(
	'Device Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DeviceType', 'url'=>array('index')),
	array('label'=>'Create DeviceType', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#device-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Типи пристроїв</h1>

<?php echo CHtml::link('Пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'device-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_device_type',
		'name',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<div id="add-devicetype" class="buttons">
    <?php echo CHtml::link('Додати тип пристроїв', array('deviceType/create')); ?>
</div>
