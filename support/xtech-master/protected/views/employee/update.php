<?php
/* @var $this EmployeeController */
/* @var $model Employee */

/*$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->id_employee=>array('view','id'=>$model->id_employee),
	'Редагувати',
);*/

/*$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
	array('label'=>'View Employee', 'url'=>array('view', 'id'=>$model->id_employee)),
	array('label'=>'Manage Employee', 'url'=>array('admin')),
);*/
?>

<h1>Редагувати дані співробітника: <?php echo $model->firstname; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>