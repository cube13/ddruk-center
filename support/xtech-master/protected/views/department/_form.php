<?php
/* @var $this DepartmentController */
/* @var $model Department */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'department-form',
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
		<?php echo $form->labelEx($model,'id_branch'); ?>
		<?php if (!$model->isNewRecord) {

			  $criteria = new CDbCriteria();
			  $criteria->addCondition("id_organization = :id_organization");
			  $criteria->params = array(':id_organization'=>$model->branch->organization->id_organization);
		 
		 	  $list = CHtml::listData(Branch::model()->findAll($criteria),'id_branch', 'name');
		 	  echo $form->dropDownList($model,'id_branch',$list, array(
									 'options'=>array(
												$model->boss=>array(
															'selected'=>'selected')),									 	
									 'empty'=>'Виберіть філію')); 
		 	} else {
                $model->id_branch = $parent;
		 		$list = CHtml::listData(Branch::model()->findAll(),'id_branch', 'name');
		 		echo $form->dropDownList($model,'id_branch',$list, array(
									 'options'=>array(
												$model->id_branch => array(
															'selected'=>'selected')),									 	
									 'empty'=>'Виберіть філію')); 
		 	}
		?>
		<?php echo $form->error($model,'id_branch'); ?>
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
		<?php echo $form->labelEx($model,'boss'); ?>
		<?php $list = CHtml::listData(Employee::model()->findAll(),'id_employee', 'firstname');?>
		<?php echo $form->dropDownList($model,'boss',$list, array(
									 'options'=>array(
												$model->boss=>array(
															'selected'=>'selected')),
									 	
									'empty'=>'Виберіть керівника')); ?>
		<?php echo $form->error($model,'boss'); ?>
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