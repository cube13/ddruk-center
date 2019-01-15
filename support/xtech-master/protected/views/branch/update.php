<?php
/* @var $this BranchController */
/* @var $model Branch */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->name=>array('view','id'=>$model->id_branch),
	'Редагування',
);*/

$this->menu=array(
	//array('label'=>'List Branch', 'url'=>array('index')),
	//array('label'=>'Create Branch', 'url'=>array('create')),
	array('label'=>'Перегляд', 'url'=>array('view', 'id'=>$model->id_branch)),
	//array('label'=>'Manage Branch', 'url'=>array('admin')),
);
?>

<h1>Редагувати дані філії: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>