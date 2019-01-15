<?php
/* @var $this LogController */
/* @var $dataProvider CActiveDataProvider */

/*this->breadcrumbs=array(
	'Logs',
);*/

$this->menu=array(
	array('label'=>'Повернутись', 'url'=>array('device/view', 'id'=>$id)),
	//array('label'=>'Manage Log', 'url'=>array('admin')),
);
?>

<h1>Історія змін пристрою: <?php echo Device::model()->findByPk($id)->devicetype->name." ";
                                 echo Device::model()->findByPk($id)->name;?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
        'date',
        'change',
    ),
)); ?>
