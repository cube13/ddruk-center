<?php
/* @var $this CabinetController */
/* @var $model Cabinet */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cabinet-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Дані позначені <span class="required">*</span> обов'язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_department'); ?>
		<?php if (!$model->isNewRecord) {
		 	  $list = CHtml::listData(Department::model()->findAll(),'id_department', 'name');
		 	  echo $form->dropDownList($model,'id_department',$list, array(
									 'options'=>array(
												$model->id_department=>array(
															'selected'=>'selected')),									 	
									 'empty'=>'Виберіть відділ')); 
		 	} else {
                $model->id_department = $parent;
		 		$list = CHtml::listData(Department::model()->findAll(),'id_department', 'name');
		 		echo $form->dropDownList($model,'id_department',$list, array(
									 'options'=>array(
												$model->id_department => array(
															'selected'=>'selected')),									 	
									 'empty'=>'Виберіть відділ')); 
		 	}
		?>
		<?php echo $form->error($model,'id_department'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephones'); ?>
		<?php echo $form->textField($model,'telephones',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telephones'); ?>
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