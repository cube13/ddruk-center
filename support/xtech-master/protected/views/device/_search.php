<?php
/* @var $this DeviceController */
/* @var $model Device */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_device'); ?>
		<?php echo $form->textField($model,'id_device'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_organization'); ?>
		<?php echo $form->textField($model,'id_organization'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_branch'); ?>
		<?php echo $form->textField($model,'id_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_department'); ?>
		<?php echo $form->textField($model,'id_department'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cabinet'); ?>
		<?php echo $form->textField($model,'id_cabinet'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_employee'); ?>
		<?php echo $form->textField($model,'id_employee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_type'); ?>
		<?php echo $form->textField($model,'id_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inv_number'); ?>
		<?php echo $form->textField($model,'inv_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sn'); ?>
		<?php echo $form->textField($model,'sn',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_varantly_yesr'); ?>
		<?php echo $form->textField($model,'end_varantly_yesr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service'); ?>
		<?php echo $form->textField($model,'service',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expluatation'); ?>
		<?php echo $form->textField($model,'expluatation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expluatation_data'); ?>
		<?php echo $form->textField($model,'expluatation_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'private'); ?>
		<?php echo $form->textField($model,'private'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'break'); ?>
		<?php echo $form->textField($model,'break'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->