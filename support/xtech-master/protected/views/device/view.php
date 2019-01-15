<?php
/* @var $this DeviceController */
/* @var $model Device */
/*
$this->breadcrumbs=array(
	'Devices'=>array('index'),
	$model->name,
);
*/
$this->menu=array(
	//array('label'=>'List Device', 'url'=>array('index')),
	//array('label'=>'Create Device', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_device)),
	array('label'=>'Історія змін', 'url'=>array('log/view', 'id'=>$model->id_device)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_device),'confirm'=>'Ви впевнені, що бажаєте незворотньо видалити дані цього пристрою?')),
	//array('label'=>'Manage Device', 'url'=>array('admin')),
);
?>

<h1>Дані пристрою: <?php echo $model->devicetype->name." - "; echo $model->name; ?></h1>
<div id="device_info">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name' => 'Організація',
			'type' => 'raw',
            'value' => (isset($model->employee->cabinet->department->branch->organization->name))?
                $model->employee->cabinet->department->branch->organization->name:'Не визначено',
		),
		array(
			'name' => 'Відділення',
			'type' => 'raw',
            'value' => (isset($model->employee->cabinet->department->branch->name))?
                        $model->employee->cabinet->department->branch->name:'Не визначено',
		),
		array(
			'name' => 'Відділ',
			'type' => 'raw',
            'value' => (isset($model->employee->cabinet->department->name))?
                        $model->employee->cabinet->department->name:'Не визначено',
		),
		array(
			'name' => 'Кабінет',
			'type' => 'raw',
            'value' => (isset($model->employee->cabinet->number))?
                $model->employee->cabinet->number:'Не визначено',
		),
		array(
			'name' => 'Співробітник',
			'type' => 'raw',
            'value' => (isset($model->employee->firstname))?
                    $model->employee->firstname." ".$model->employee->lastname." ".$model->employee->surname:
                    'Не визначено',
		),
		array(
			'name' => 'Тип пристрою',
			'type' => 'raw',
            'value' => $model->devicetype->name,          
		),
		'name',
		'description',
		'inv_number',
		'sn',
		'year',
		'end_varantly_yesr',
		'service',
		array(
			'name' => 'Введення в експлуатацію',
			'type' => 'raw',
            'value' => ($model->expluatation)?"Введено":"Не введено",          
		),
		'expluatation_data',
		array(
			'name' => 'Забалансовий',
			'type' => 'raw',
            'value' => ($model->private)?"Так":"Ні",          
		),
		array(
			'name' => 'Стан',
			'type' => 'raw',
            'value' => ($model->break)?"Вийшов з ладу":"Працює",
		),
	),
)); 

if (($model->devicetype->id_device_type == 2) || ($model->devicetype->id_device_type == 3)) {
	$this->renderPartial('_device_pc', array(
                      'model' => $model,));
}
?>
</div>
<hr>
<?php $this->widget('application.components.AddDevice.AddDevice', array('parent'=>$model->id_employee)); ?>