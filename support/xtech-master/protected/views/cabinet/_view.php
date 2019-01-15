<?php
/* @var $this CabinetController */
/* @var $data Cabinet */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cabinet')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cabinet), array('view', 'id'=>$data->id_cabinet)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_department')); ?>:</b>
	<?php echo CHtml::encode($data->id_department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephones')); ?>:</b>
	<?php echo CHtml::encode($data->telephones); ?>
	<br />


</div>