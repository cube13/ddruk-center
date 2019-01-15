<?php
/* @var $this BranchController */
/* @var $model Branch */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	'Додати філію',
);*/

/*$this->menu=array(
	array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Manage Branch', 'url'=>array('admin')),
);*/
?>

<h1>Додати філію</h1>

<?php $this->renderPartial('_form', array('model' => $model,
                                          'parent' => $parent)); ?>