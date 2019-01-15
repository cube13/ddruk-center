<?php
/* @var $this OrganizationController */
/* @var $model Organization */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->name,
);*/

$this->menu=array(
	//array('label'=>'List Organization', 'url'=>array('index')),
	//array('label'=>'Додати', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_organization)),
    array('label'=>'Додати філію', 'url'=>array('branch/create', 'parent'=>$model->id_organization)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_organization),'confirm'=>'Ви бажаєте видалити дану організацію?')),
	//array('label'=>'Manage Organization', 'url'=>array('admin')),
);
?>

<h1>Перегляд даних організації: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_organization',
		'name',
		'description',
		'telephones',
		'emails',
		'www',
		'address',
		array(
			'name' => 'Керівник',
                'value' => ($fn = Employee::model()->findByPk($model->boss))? 
                				$fn->firstname :
                				'Не визначено',
                'type' => 'html',
			),
		array(
			'name' => 'Головний бухгалтер',
                'value' => ($fn = Employee::model()->findByPk($model->buh))? 
                				$fn->firstname :
                				'Не визначено',
                'type' => 'html',
			),
		'okpo',
		
	),
)); ?>
