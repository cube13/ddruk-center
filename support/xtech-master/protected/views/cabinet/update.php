<?php
/* @var $this CabinetController */
/* @var $model Cabinet */

/*$this->breadcrumbs=array(
	'Структура'=>array('structure/index'),
	$model->id_cabinet=>array('view','id'=>$model->id_cabinet),
	'Редагувати',
);*/

$this->menu=array(
	//array('label'=>'List Cabinet', 'url'=>array('index')),
	//array('label'=>'Create Cabinet', 'url'=>array('create')),
	array('label'=>'Перегляд', 'url'=>array('view', 'id'=>$model->id_cabinet)),
	//array('label'=>'Manage Cabinet', 'url'=>array('admin')),
);
?>

<h1>Редагувати дані кабінету <?php echo $model->number; ?> </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>