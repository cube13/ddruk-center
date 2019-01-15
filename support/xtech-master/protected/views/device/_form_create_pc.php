<?php
/* @var $this DeviceController */
/* @var $model Device */
/* @var $form CActiveForm */

$model->unsetAttributes();
$model_pc->unsetAttributes();

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.input-ip.js');
Yii::app()->clientScript->registerScript('ip','
    $(function(){
        $("#DevicePc_ip").ipAddress();
    });
',CClientScript::POS_HEAD);
//var_dump($parent);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-form-create',
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_employee'); ?>
		<?php $list = CHtml::listData(Employee::model()->findAll(),'id_employee', 'firstname');?>
		<?php echo $form->dropDownList($model,'id_employee',$list, array(
										'empty'=>'Оберіть співробітника',
                                        'options'=>array(
                                                $parent=>array(
                                                'selected'=>'selected')),
                                        )); ?>
		<?php echo $form->error($model,'id_employee'); ?>
	</div>

	<div class="row">
  	 
		<?php echo $form->labelEx($model,'name'); ?>
	<?php $this->beginContent('//decorators/buttons'); ?>   	
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	 <?php $this->endContent(); ?>	
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->labelEx($model,'inv_number'); ?>
	<?php $this->beginContent('//decorators/buttons'); ?>     
		<?php echo $form->textField($model,'inv_number',array('size'=>15,'maxlength'=>10)); ?>
	<?php $this->endContent(); ?>	
		<?php echo $form->error($model,'inv_number'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->labelEx($model,'sn'); ?>
	<?php $this->beginContent('//decorators/buttons'); ?>     	
		<?php echo $form->textField($model,'sn',array('size'=>60,'maxlength'=>255)); ?>
	<?php $this->endContent(); ?>	
		<?php echo $form->error($model,'sn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php  
			$yearNow = date("Y");
			$yearFrom = 1980;
			$arrYears = array();
			foreach (range($yearFrom, $yearNow) as $number) {
		 		$arrYears[$number] = $number; 
		 	}
		 	$arrYears = array_reverse($arrYears, true);
		?>
		<?php echo $form->dropDownList($model,'year',$arrYears); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_varantly_yesr'); ?>
		<?php  
			$yearNow = date("Y");
			$yearTo = $yearNow + 5;
			$yearFrom = 1985;
			$arrYears = array();
			foreach (range($yearFrom, $yearTo) as $number) {
		 		$arrYears[$number] = $number; 
		 	}
		 	$arrYears = array_reverse($arrYears, true);
		?>
		<?php echo $form->dropDownList($model,'end_varantly_yesr',$arrYears); ?>
		<?php echo $form->error($model,'end_varantly_yesr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service'); ?>
		<?php echo $form->textArea($model,'service',array('cols'=>46, 'rows'=>5, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'service'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expluatation'); ?>
		<?php echo $form->dropDownList($model,'expluatation', array('0'=>'Ні','1'=>'Так'), array(
									'options'=>array(
												$model->expluatation=>array(
															'selected'=>'selected')))
										); ?>
		<?php echo $form->error($model,'expluatation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expluatation_data'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    			'model' => $model,
	    			'attribute' => 'expluatation_data',
	    			'language' => 'uk',
	    			'options' => array(
	    				'size' => '10',
	    				'dateFormat' => 'dd-mm-yy',
	    				'showButtonPanel' => true,
	    				'changeYear' => true,           // can change year
				        'changeMonth' => true,
				        'showOtherMonths' => true,      // show dates in other months
				        'selectOtherMonths' => true,
	    				),
				));
		?>
		<?php echo $form->error($model,'expluatation_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'private'); ?>
		<?php echo $form->dropDownList($model,'private', array('0'=>'Ні','1'=>'Так'), array(
									'options'=>array(
												$model->private=>array(
															'selected'=>'selected')))
										); ?>

		<?php echo $form->error($model,'private'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'break'); ?>
		<?php echo $form->dropDownList($model,'break', array('0'=>'Працює','1'=>'Не працює'), array(
									'options'=>array(
												$model->break=>array(
															'selected'=>'selected')))
										); ?>

		<?php echo $form->error($model,'break'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'mb'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'mb',
                        array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'mb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'cpu_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'cpu_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'cpu_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'cpu_p'); ?>
		<?php echo $form->numberField($model_pc,'cpu_p',
                                array('size'=>8,'maxlength'=>10, 'step'=>'0.1')); ?>
		<?php echo $form->error($model_pc,'cpu_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'hdd_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'hdd_name',
                                array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'hdd_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'hdd_p'); ?>
		<?php echo $form->numberField($model_pc,'hdd_p',
                                    array('size'=>8,'maxlength'=>255)); ?>
		<?php echo $form->error($model_pc,'hdd_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'ram_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'ram_name',
                                        array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'ram_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'ram_p'); ?>
		<?php echo $form->numberField($model_pc,'ram_p',
                                array('size'=>8,'maxlength'=>255)); ?>
		<?php echo $form->error($model_pc,'ram_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'video_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'video_name',
                                array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'video_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'video_p'); ?>
		<?php echo $form->numberField($model_pc,'video_p',array('size'=>8,'maxlength'=>255)); ?>
		<?php echo $form->error($model_pc,'video_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'cdrom_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'cdrom_name',
                                    array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'cdrom_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'lan_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'lan_name',
                                    array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'lan_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'os'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'os',
                                    array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'os'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'net_name'); ?>
        <?php $this->beginContent('//decorators/buttons'); ?>
		<?php echo $form->textField($model_pc,'net_name',
                                    array('size'=>30,'maxlength'=>255)); ?>
        <?php $this->endContent(); ?>
		<?php echo $form->error($model_pc,'net_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model_pc,'ip'); ?>
		<?php echo $form->textField($model_pc,'ip',
                                           array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model_pc,'ip'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',
                                            array('cols'=>46, 'rows'=>5, 'maxlength'=>255)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

	<div class="row">
		<input type="hidden" id="Device_id_type" name="Device[id_type]" value="<?php echo $device_type ?>">
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->