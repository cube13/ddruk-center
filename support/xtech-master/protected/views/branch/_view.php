<?php
/* @var $this BranchController */
/* @var $data Branch */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_branch')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_branch), array('view', 'id'=>$data->id_branch)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_organization')); ?>:</b>
	<?php echo CHtml::encode($data->id_organization); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('www')); ?>:</b>
	<?php echo CHtml::encode($data->www); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	*/ ?>

</div>