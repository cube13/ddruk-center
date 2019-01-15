<?php
/* @var $this OrganizationController */
/* @var $model Organization */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	'Додати організацію',
);*/
/*
$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index')),
	array('label'=>'Manage Organization', 'url'=>array('admin')),
);*/
?>

<h1>Додати організацію</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>