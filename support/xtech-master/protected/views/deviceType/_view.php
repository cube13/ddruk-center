<?php
/* @var $this DeviceTypeController */
/* @var $data DeviceType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_device_type')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_device_type), array('view', 'id'=>$data->id_device_type)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>