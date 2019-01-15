<?php
/* @var $this DepartmentController */
/* @var $data Department */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_department')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_department), array('view', 'id'=>$data->id_department)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_branch')); ?>:</b>
	<?php echo CHtml::encode($data->id_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephones')); ?>:</b>
	<?php echo CHtml::encode($data->telephones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emails')); ?>:</b>
	<?php echo CHtml::encode($data->emails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('boss')); ?>:</b>
	<?php echo CHtml::encode($data->boss); ?>
	<br />


</div>