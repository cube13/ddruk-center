<?php
/* @var $this DepartmentController */
/* @var $model Department */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->name,
);*/

$this->menu=array(
	//array('label'=>'List Department', 'url'=>array('index')),
	//array('label'=>'Create Department', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_department)),
    array('label'=>'Додати кабінет', 'url'=>array('cabinet/create', 'parent'=>$model->id_department)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_department),'confirm'=>'Ви впевнені, що бажаєте видалити цей відділ?')),
	//array('label'=>'Manage Department', 'url'=>array('admin')),
);
?>

<h1>Перегляд даних відділу: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_department',
		'name',		
		//'id_branch',
		array(
			'name' => 'Філія',
            'value' => $model->branch->name,
            'type' => 'html',
		),
		'description',
		'telephones',
		'emails',
		//'boss',
		array(
			'name' => 'Керівник відділу',
            'value' => ($fn = Employee::model()->findByPk($model->boss))? 
                				$fn->firstname :
                				'Не визначено',
            'type' => 'html',
			),
	),
)); ?>
