<?php
/* @var $this BranchController */
/* @var $model Branch */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->name,
);*/

$this->menu=array(
	//array('label'=>'List Branch', 'url'=>array('index')),
	//array('label'=>'Create Branch', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_branch)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_branch),'confirm'=>'Ви впевнені, що бажаєте видалити дану філію?')),
	//array('label'=>'Manage Branch', 'url'=>array('admin')),
);
?>

<h1>Перегляд даних філії: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_branch',
		'name',
		//'id_organization',
		array(
			'name'=>'Організація',
			'value'=>$model->organization->name,
			'type'=>'html',
		),
		'description',
		'telephones',
		'emails',
		'www',
		'address',
	),
)); ?>
