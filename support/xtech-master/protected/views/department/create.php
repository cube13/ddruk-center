<?php
/* @var $this DepartmentController */
/* @var $model Department */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	'Додати відділ',
);*/

/*$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Manage Department', 'url'=>array('admin')),
);*/
?>

<h1>Додати відділ</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'parent' => $parent,)); ?>