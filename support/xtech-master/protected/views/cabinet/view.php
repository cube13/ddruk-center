<?php
/* @var $this CabinetController */
/* @var $model Cabinet */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->id_cabinet,
);*/

$this->menu=array(
	//array('label'=>'List Cabinet', 'url'=>array('index')),
	//array('label'=>'Create Cabinet', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_cabinet)),
    array('label'=>'Додати працівника', 'url'=>array('employee/create', 'parent'=>$model->id_cabinet)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_cabinet),'confirm'=>'Ви впевнені, що бажаєте видалити цей кабінет?')),
	//array('label'=>'Manage Cabinet', 'url'=>array('admin')),
);
?>

<h1>Перегляд даних кабінету <?php echo $model->number; ?> </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_cabinet',
		'number',
		//'id_department',
		array(
			'name' => 'Відділ',
            'value' => $model->department->name,
            'type' => 'html',
		),
		'description',
		'telephones',
	),
)); ?>
