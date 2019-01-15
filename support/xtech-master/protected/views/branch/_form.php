<?php
/* @var $this BranchController */
/* @var $model Branch */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'branch-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Дані позначені <span class="required">*</span> обов'язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_organization'); ?>
		<?php $list = CHtml::listData(Organization::model()->findAll(),'id_organization', 'name');?>
        <?php if ($model->isNewRecord) $model->id_organization = $parent; ?>
		<?php echo $form->dropDownList($model,'id_organization',$list, array(
									 'options'=>array(
												$model->id_organization=>array(
															'selected'=>'selected')),
									 	
									'empty'=>'Виберіть організацію',
												)); ?>
		<?php echo $form->error($model,'id_organization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephones'); ?>
		<?php echo $form->textField($model,'telephones',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telephones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emails'); ?>
		<?php echo $form->textField($model,'emails',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'emails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'www'); ?>
		<?php echo $form->urlField($model,'www',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'www'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('cols'=>45, 'rows'=>10,'maxlength'=>500)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->