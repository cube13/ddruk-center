<div class="notifier">
    При пошуку з "Умовою" можливо використовувати спеціальні символи:
    <span>%</span> (будь яка кількість символів),
    <span>_</span> (один символ).
</div>
<div class="notifier">
    При пошуку "В списку" значення треба розділити комами.
</div>
<?php
/*
$columns = Device::model()->getAttributes();
$columns = array_merge($columns, DevicePc::model()->getAttributes());
//var_dump($columns);

foreach ($columns as $k=>$v) {
    $columnsLabels[$k] = Device::model()->getAttributeLabel($k);
}

$operations = array('='=>'=','>'=>'>','<'=>'<','LIKE'=>'Умова', 'IN'=>'В списку');
?>


<?php echo CHtml::beginForm($this->createUrl('construct'),'post');?>

<table>
  <thead>
    <tr>
        <td>Вибір</td>
        <td>Сортування</td>
        <td>Рядок</td>
        <td>Умова</td>
        <td>Значення</td>
    </tr>
 </thead>
 <tbody>
<?php
foreach ($columns as $k=>$v)
{
    echo "<tr>";
        echo "<td>";
            echo CHtml::checkBox('attr['.$k.']','',array('value'=>$k));
        echo "</td>";
        echo "<td>";
            echo CHtml::radioButtonList('sort','',
                    array($k.'_DESC'=>'Зменшення',$k.'_ASC'=>'Збільшення'));
        echo "</td>";
        echo "<td>";
            echo $columnsLabels[$k];
        echo "</td>";
        echo "<td>";
            echo CHtml::dropDownList('operations['.$k.']',$k,$operations);
        echo "</td>";
        echo "<td>";
            getFieldValue($k,$v);
        echo "</td>";
    echo "</tr>";
}
?>
 </tbody>
</table>*/?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/construct_form.css'); ?>
<div class="form construct">
<?php
    //$operations = array('='=>'=','>'=>'>','<'=>'<','LIKE'=>'Умова', 'IN'=>'В списку');
    //echo CHtml::submitButton('Пошук');
    //echo CHtml::endForm();
?>

<?php
    $operations = array('='=>'=','>'=>'>','<'=>'<','LIKE'=>'Умова', 'IN'=>'В списку');
    echo CHtml::beginForm($this->createUrl('construct'),'post');?>
    <!-- employee -->
    <div class="row">
        <div class="title_select">Обрати</div>
        <div class="title_order">Сортування</div>
        <div class="title_name">Назва</div>
        <div class="title_def">Умова</div>
        <div class="title_value">Значення</div>
    </div>
    <div class="row">
        <?php echo CHtml::checkBox('attr[id_employee]',false,array('id'=>'attr_id_employee','value'=>'id_employee')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('id_employee_DESC'=>'Зменшення',
                                                                   'id_employee_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Співробітник','value[id_employee]'); ?>
        <?php echo CHtml::dropDownList('operations[id_employee]','',$operations, array('id'=>'operations_id_employee')); ?>
        <?php
            $list = CHtml::listData(Employee::model()->findAll(),'id_employee', 'firstname');
            echo CHtml::dropDownList('value[id_employee]','firstname',$list,
                                        array('empty' => '--Вибір--'));
        ?>
    </div>
    <!-- type -->
    <div class="row">
        <?php echo CHtml::checkBox('attr[id_type]',false,array('id'=>'attr_id_type','value'=>'id_type')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('id_type_DESC'=>'Зменшення',
            'id_type_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Тип пристрою','value[id_type]'); ?>
        <?php echo CHtml::dropDownList('operations[id_type]','',$operations, array('id'=>'operations_id_type')); ?>
        <?php
            $list = CHtml::listData(DeviceType::model()->findAll(),'id_device_type', 'name');
            echo CHtml::dropDownList('value[id_type]','name',$list,
                                        array('empty' => '--Вибір--'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[name]',false,array('id'=>'attr_name','value'=>'name')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('name_DESC'=>'Зменшення',
            'name_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Назва','value[name]'); ?>
        <?php echo CHtml::dropDownList('operations[name]','',$operations, array('id'=>'operations_name')); ?>
        <?php echo CHtml::textField('value[name]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[inv_number]',false,array('id'=>'attr_inv_number','value'=>'inv_number')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('inv_number_DESC'=>'Зменшення',
            'inv_number_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Інвентарний номер','value[inv_number]'); ?>
        <?php echo CHtml::dropDownList('operations[inv_number]','',$operations, array('id'=>'operations_inv_number')); ?>
        <?php echo CHtml::textField('value[inv_number]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[sn]',false,array('id'=>'attr_sn','value'=>'sn')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('sn_DESC'=>'Зменшення',
            'sn_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Серійний номер','value[sn]'); ?>
        <?php echo CHtml::dropDownList('operations[sn]','',$operations, array('id'=>'operations_sn')); ?>
        <?php echo CHtml::textField('value[sn]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[year]',false,array('id'=>'attr_year','value'=>'year')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('year_DESC'=>'Зменшення',
            'year_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Рік випуску','value[year]'); ?>
        <?php echo CHtml::dropDownList('operations[year]','',$operations, array('id'=>'operations_year')); ?>
        <?php echo CHtml::textField('value[year]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[end_varantly_yesr]',false,array('id'=>'attr_end_varantly_yesr','value'=>'end_varantly_yesr')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('end_varantly_yesr_DESC'=>'Зменшення',
            'end_varantly_yesr_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Рік закінчення гарантії','value[end_varantly_yesr]'); ?>
        <?php echo CHtml::dropDownList('operations[end_varantly_yesr]','',$operations, array('id'=>'operations_end_varantly_yesr')); ?>
        <?php echo CHtml::textField('value[end_varantly_yesr]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[private]',false,array('id'=>'attr_private','value'=>'private')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('private_DESC'=>'Зменшення',
            'private_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Забалансовий','value[private]'); ?>
        <?php echo CHtml::dropDownList('operations[private]','',$operations, array('id'=>'operations_private')); ?>
        <?php echo CHtml::dropDownList('value[private]','',array('0'=>'Ні','1'=>'Так'),
                                        array('empty' => '--Вибір--'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[break]',false,array('id'=>'attr_break','value'=>'break')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('break_DESC'=>'Зменшення',
            'break_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Стан','value[break]'); ?>
        <?php echo CHtml::dropDownList('operations[break]','',$operations, array('id'=>'operations_break')); ?>
        <?php echo CHtml::dropDownList('value[break]','',array('0'=>'Працює','1'=>'Не працює'),
            array('empty' => '--Вибір--'));
        ?>
    </div>
    <?/*
    <div class="row">
        <?php echo CHtml::checkBox('attr[cpu_p]',false,array('id'=>'attr_cpu_p','value'=>'cpu_p')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('cpu_p_DESC'=>'Зменшення',
            'cpu_p_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Швидкість процесора (ГГц)','value[cpu_p]'); ?>
        <?php echo CHtml::dropDownList('operations[cpu_p]','',$operations, array('id'=>'operations_cpu_p')); ?>
        <?php echo CHtml::textField('value[cpu_p]','',array('maxlength'=>'255', 'size'=>'5'));
        ?>
    </div>

    <div class="row">
    <?php echo CHtml::checkBox('attr[hdd_p]',false,array('id'=>'attr_hdd_p','value'=>'hdd_p')); ?>
    <?php echo CHtml::radioButtonList('sort','Зменшення',array('hdd_p_DESC'=>'Зменшення',
        'hdd_p_ASC'=>'Збільшення')); ?>
    <?php echo CHtml::label('Об\'єм жорсткого диску (ГБ)','value[hdd_p]'); ?>
    <?php echo CHtml::dropDownList('operations[hdd_p]','',$operations, array('id'=>'operations_hdd_p')); ?>
    <?php echo CHtml::textField('value[hdd_p]','',array('maxlength'=>'255', 'size'=>'5'));
    ?>
</div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[ram_p]',false,array('id'=>'attr_ram_p','value'=>'ram_p')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('ram_p_DESC'=>'Зменшення',
            'ram_p_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Об\'єм оперативної пам\'яті (ГБ)','value[ram_p]'); ?>
        <?php echo CHtml::dropDownList('operations[ram_p]','',$operations, array('id'=>'operations_ram_p')); ?>
        <?php echo CHtml::textField('value[ram_p]','',array('maxlength'=>'255', 'size'=>'5'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[net_name]',false,array('id'=>'attr_net_name','value'=>'net_name')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('net_name_DESC'=>'Зменшення',
            'net_name_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Ім\'я в мережі','value[net_name]'); ?>
        <?php echo CHtml::dropDownList('operations[net_name]','',$operations, array('id'=>'operations_net_name')); ?>
        <?php echo CHtml::textField('value[net_name]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[os]',false,array('id'=>'attr_os','value'=>'os')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('os_DESC'=>'Зменшення',
            'os_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('Операційна система','value[os]'); ?>
        <?php echo CHtml::dropDownList('operations[os]','',$operations, array('id'=>'operations_os')); ?>
        <?php echo CHtml::textField('value[os]','',array('maxlength'=>'255', 'size'=>'60'));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::checkBox('attr[ip]',false,array('id'=>'attr_ip','value'=>'ip')); ?>
        <?php echo CHtml::radioButtonList('sort','Зменшення',array('ip_DESC'=>'Зменшення',
            'ip_ASC'=>'Збільшення')); ?>
        <?php echo CHtml::label('IP адреса','value[ip]'); ?>
        <?php echo CHtml::dropDownList('operations[ip]','',$operations, array('id'=>'operations_ip')); ?>
        <?php echo CHtml::textField('value[ip]','',array('maxlength'=>'255', 'size'=>'12'));
        ?>
    </div>
*/?>
<?php
echo CHtml::submitButton('Пошук',array('class'=>'btn'));
echo CHtml::endForm();
?>
</div>
<?php
function getFieldValue($k, $v){
    if ($k == 'id_employee') {
        $list = CHtml::listData(Employee::model()->findAll(),'id_employee', 'firstname');
        echo CHtml::dropDownList('value['.$k.']','firstname',$list,
                        array('empty' => '--Вибір--'));
    }
    elseif ($k == 'id_type') {
        $list = CHtml::listData(DeviceType::model()->findAll(),'id_device_type', 'name');
        echo CHtml::dropDownList('value['.$k.']','name',$list,
                        array('empty' => '--Вибір--'));
    }
    elseif ($k == 'expluatation') {
        echo CHtml::dropDownList('value['.$k.']','',array('0'=>'Ні','1'=>'Так'),
                        array('empty' => '--Вибір--'));
    }
    elseif ($k == 'private') {
        echo CHtml::dropDownList('value['.$k.']','',array('0'=>'Ні','1'=>'Так'),
                        array('empty' => '--Вибір--'));
    }
    elseif ($k == 'break') {
        echo CHtml::dropDownList('value['.$k.']','',array('0'=>'Ні','1'=>'Так'),
                        array('empty' => '--Вибір--'));
    }
    elseif ($k == 'expluatation_data') {
        Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
            //'model' => Device::model('search'),
            //'attribute' => 'expluatation_data',
            'name'=>'value['.$k.']',
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
    }
    else {
        echo CHtml::textField('value['.$k.']','',array('size'=>60,'maxlength'=>255));
    }
}