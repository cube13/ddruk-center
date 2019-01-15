<?php
/* @var $this LogController */
/* @var $data Log */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_log')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_log), array('view', 'id'=>$data->id_log)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_device')); ?>:</b>
	<?php echo CHtml::encode($data->id_device); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('change')); ?>:</b>
	<?php echo CHtml::encode($data->change); ?>
	<br />


</div>