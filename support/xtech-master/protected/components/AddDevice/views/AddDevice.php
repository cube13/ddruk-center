<?php
    Yii::app()->clientScript->registerCss('add-device-button','
        #add-device {
            background-color: rgba(200, 200, 200, 0.2);
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 15px 5px 5px;
            padding: 5px 10px 15px;
        }

        #add-device-title {
            border-bottom: 1px solid gray;
            font-size: 1.5em;
            margin: 10px;
            padding-bottom: 10px;
        }

        #device_type {
            float: left;
            margin-left: 10px;
            margin-top: 6px;
        }

        #add-device div.row.submit input:before {
            background: linear-gradient(rgba(200, 200, 200, 0.5), rgba(240, 240, 240, 0.5)) repeat scroll 0 0 rgba(0, 0, 0, 0);
            border-radius: 8px;
            bottom: -10px;
            content: "";
            left: -10px;
            position: absolute;
            right: -10px;
            top: -10px;
            z-index: -1;
}
        #add-device div.row.submit input {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background: linear-gradient(rgb(206, 220, 231), rgb(89, 106, 114)) repeat scroll 0 0 rgb(206, 220, 231);
            border-color: rgba(0, 0, 0, 0.3) rgba(110, 121, 128, 0.8) rgba(110, 121, 128, 0.8);
            border-image: none;
            border-radius: 5px;
            border-right: 1px solid rgba(110, 121, 128, 0.8);
            border-style: solid;
            border-width: 1px;
            box-shadow: 0 -1px rgba(10, 21, 28, 0.9) inset, 0 1px rgba(255, 255, 255, 0.5) inset;
            color: #f8f8f8;
            cursor: pointer;
            display: inline-block;
            height: 2.5em;
            left: 10px;
            line-height: 2.1em;
            outline: medium none;
            position: relative;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            width: 100px;
        }
    ');
?>
<div id="add-device">
        <?php echo CHtml::beginForm(Yii::app()->createUrl('device/create', array('parent'=>$this->parent)),'get'); ?>
<div class="row">
    <div id="add-device-title">Додати пристрій</div>
    <?php $list = CHtml::listData(DeviceType::model()->findAll(),'id_device_type', 'name');?>
    <?php echo CHtml::dropDownList('device_type','id_type',$list); ?>
</div>
<div class="row submit">
    <?php echo CHtml::submitButton('Додати'); ?>
</div>
<?php echo CHtml::endForm(); ?>
</div>
