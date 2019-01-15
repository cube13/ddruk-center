<?php
/* @var $this ReportsController */
?>

<h1>Звіти</h1>

<fieldset>
    <legend>По типам пристроїв</legend>
    <div class="form">
        <?php echo CHtml::beginForm(Yii::app()->createUrl('reports/types'));  ?>
        <div class="row">

        </div>
        <?php echo CHtml::submitButton('Сформувати'); ?>
        <?php echo CHtml::endForm(); ?>
    </div>
</fieldset>