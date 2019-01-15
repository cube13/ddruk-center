<?php
/* @var $this DeviceController */
/* @var $data Device */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_device')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_device), array('view', 'id'=>$data->id_device)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_organization')); ?>:</b>
	<?php echo CHtml::encode($data->id_organization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_branch')); ?>:</b>
	<?php echo CHtml::encode($data->id_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_department')); ?>:</b>
	<?php echo CHtml::encode($data->id_department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cabinet')); ?>:</b>
	<?php echo CHtml::encode($data->id_cabinet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_employee')); ?>:</b>
	<?php echo CHtml::encode($data->id_employee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inv_number')); ?>:</b>
	<?php echo CHtml::encode($data->inv_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sn')); ?>:</b>
	<?php echo CHtml::encode($data->sn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_varantly_yesr')); ?>:</b>
	<?php echo CHtml::encode($data->end_varantly_yesr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service')); ?>:</b>
	<?php echo CHtml::encode($data->service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expluatation')); ?>:</b>
	<?php echo CHtml::encode($data->expluatation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expluatation_data')); ?>:</b>
	<?php echo CHtml::encode($data->expluatation_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('private')); ?>:</b>
	<?php echo CHtml::encode($data->private); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('break')); ?>:</b>
	<?php echo CHtml::encode($data->break); ?>
	<br />

	*/ ?>

</div>