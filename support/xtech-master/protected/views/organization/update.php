<?php
/* @var $this OrganizationController */
/* @var $model Organization */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->name=>array('view','id'=>$model->id_organization),
	'Редагувати',
);*/

$this->menu=array(
	//array('label'=>'List Organization', 'url'=>array('index')),
	//array('label'=>'Create Organization', 'url'=>array('create')),
	array('label'=>'Перегляд', 'url'=>array('view', 'id'=>$model->id_organization)),
	//array('label'=>'Manage Organization', 'url'=>array('admin')),
);
?>

<h1>Редагувати дані організації: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>