<?php
/* @var $this EmployeeController */
/* @var $model Employee */

/*$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employee-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Співробітники</h1>

<?php echo CHtml::link('Пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_employee',
		//'id_cabinet',
		'firstname',
		'lastname',
		'surname',
		//'description',
		//'telephones',
		//'post',
		//'email',
		//'login',
		'tab_number',
		//'home_address',
		'dob',
		'pasp',
		//'fired',
        array(
            'name'=>'fired',
            'type' => 'raw',
            'value'=>'($data->fired)?\'Так\':\'Ні\'',
        ),
		'dof',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<div id="add-employee" class="buttons">
    <?php echo CHtml::link('Додати працівника', array('employee/create', 'parent'=>'')); ?>
</div>