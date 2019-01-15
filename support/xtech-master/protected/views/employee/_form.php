<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля зі знаком <span class="required">*</span> обов'язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model,'id_cabinet'); ?>
        <?php
            if (!$model->isNewRecord) {
                $list = CHtml::listData(Cabinet::model()->findAll(),'id_cabinet', 'number');
                echo $form->dropDownList($model,'id_cabinet',$list, array(
                    'options'=>array(
                        $model->id_cabinet=>array(
                            'selected'=>'selected')),
                    'empty'=>'Оберіть кабінет'));
            } else {
                $model->id_cabinet = $parent;
                $list = CHtml::listData(Cabinet::model()->findAll(),'id_cabinet', 'number');
                echo $form->dropDownList($model,'id_cabinet',$list, array(
                    'options'=>array(
                        $model->id_cabinet => array(
                            'selected'=>'selected')),
                        'empty'=>'Оберіть кабінет'));
        }
        ?>
        <?php echo $form->error($model,'id_cabinet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'telephones'); ?>
		<?php echo $form->textField($model,'telephones',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telephones'); ?>
	</div>

    <?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'post'); ?>
		<?php echo $form->textField($model,'post',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'post'); ?>
	</div>
    */?>

    <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tab_number'); ?>
		<?php echo $form->numberField($model,'tab_number',array('size'=>30,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tab_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_address'); ?>
		<?php echo $form->textArea($model,'home_address',array('cols'=>45, 'rows'=>5,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'dob',
            'language' => 'uk',
            'options' => array(
                'size' => '10',
                'dateFormat' => 'dd-mm-yy',
                'showButtonPanel' => true,
                'changeYear' => true,           // can change year
                'changeMonth' => true,
                'showOtherMonths' => true,      // show dates in other months
                'selectOtherMonths' => true,     // show button panel
            ),
        ));
        ?>

        <?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pasp'); ?>
		<?php echo $form->textField($model,'pasp',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pasp'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'fired'); ?>
        <?php if ($model->isNewRecord): ?>
            <input id="Employee_fired" type="radio" name="Employee[fired]" value="0" checked/>Ні
            <input id="Employee_fired" type="radio" name="Employee[fired]" value="1" />Так
        <?php else: ?>
            <?php if ($model->fired): ?>
                <input id="Employee_fired" type="radio" name="Employee[fired]" value="0" />Ні
                <input id="Employee_fired" type="radio" name="Employee[fired]" value="1" checked/>Так
            <?php else: ?>
                <input id="Employee_fired" type="radio" name="Employee[fired]" value="0" checked/>Ні
                <input id="Employee_fired" type="radio" name="Employee[fired]" value="1" />Так
            <?php endif; ?>
        <?php endif; ?>

        <?php echo $form->error($model,'fired'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dof'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'dof',
            'language' => 'uk',
            'htmlOptions' => array(
                'size' => '10',         		// textField size
                'maxlength' => '10',    		// textField maxlength
                'dateFormat' => 'yy-mm-dd',
                'showOtherMonths' => true,      // show dates in other months
                'selectOtherMonths' => true,    // can seelect dates in other months
                'changeYear' => true,           // can change year
                'changeMonth' => true,          // can change month
                'yearRange' => '2000:2099',     // range of year
                'minDate' => '1950-01-01',      // minimum date
                'maxDate' => '2099-12-31',      // maximum date
                'showButtonPanel' => true,      // show button panel
            ),
        ));
        ?>
		<?php echo $form->error($model,'dof'); ?>
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