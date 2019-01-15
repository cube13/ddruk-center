<?php
//var_dump($dataProvider->model->related('employee'));

$attr = Yii::app()->request->getRestParams();

$model = new Device('search');
$model->unsetAttributes();
$model->setAttributes($attr);

$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'enableSorting' => true,
      'filter'=>$dataProvider->model,
      //'filter'=>$dataProvider,
      //'filter'=>new Device('search'),
      //'filter'=>$model,
      'itemsCssClass'=>'table-striped',
      'columns'=>array(
            /*array(
              'name' => 'Організація',
              'type' => 'raw',
              //'value' => '$data->organization->name',
              'value' => '(isset($data->employee->cabinet->department->branch->organization->name))?
                          $data->employee->cabinet->department->branch->organization->name:\'Не визначено\'',
            ),*/
            array(
              'header'=>'Філія',
              //'name' => 'Філія',
              'name' => 'employee.cabinet.department.branch.name',
              //'name' => 'departmentname',
              'type' => 'raw',
              'value' => '(isset($data->employee->cabinet->department->branch->name))?
                           $data->employee->cabinet->department->branch->name:\'Не визначено\'',
            ),
            array(
              'header'=>'Відділ',
              //'name' => 'Відділ',
              'name' => 'employee.cabinet.department.name',
              'type' => 'raw',
              'value' => '(isset($data->employee->cabinet->department->name))?
                          $data->employee->cabinet->department->name:\'Не визначено\'',
            ),
            array(
              'header'=>'Кабінет',
              //'name' => 'Кабінет',
              'name' => 'employee.cabinet.number',
              'type' => 'raw',
              'value' => '(isset($data->employee->cabinet->number))?
                          $data->employee->cabinet->number:\'Не визначено\'',
            ),
            array(
              'header'=>'Співробітник',
              'name' => 'employee',
              'type' => 'raw',
              'value' => '(isset($data->employee->firstname))?$data->employee->firstname:\'Не визначено\'',
            ),
            array(
              'header'=>'Пристрій',
              'name' => 'devicetype',
              'type' => 'raw',
              'value' => '$data->devicetype->name',
              //'filter'=> CHtml::activeTextField(new CActiveDataProvider('DeviceType'), 'name'),
            ),
          //'inv_number',
            array(
              'name' => 'Інв №',
              'type' => 'raw',
              'value' => '$data->inv_number',
              'filter'=> CHtml::activeTextField($dataProvider->model, 'inv_number'),
            ),
           'name',
          /*array(
              'header'=>'Назва',
              'name' => 'name',
              'type' => 'raw',
              'value' => '$data->name',
          ),*/
            /*array(
              'name' => 'Серійний №',
              'type' => 'raw',
              'value' => '$data->sn',
            ),*/
          'year',
            /*array(
              'name' => 'Рік випуску',
              'type' => 'raw',
              'value' => '$data->year',
            ),*/
            array(
              'header'=>'Забаланс',
              //'name' => 'Забаланс',
              'name' => 'private',
              'type' => 'raw',
              'value' => '$data->private ? \'Так\' : \'Ні\'',
            ),
            array(
              'header'=>'Стан',
              //'name' => 'Стан',
              'name' => 'break',
              'type' => 'raw',
              'value' => '$data->break ? \'Не працює\' : \'Працює\'',
            ),
            array(
              'class'=>'CButtonColumn',
              'template'=>'{view}{update}{delete}',
              'buttons'=>array(
                  'view' => array(
                    'label'=>'Просмотр',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
                    'url'=>'Yii::app()->createUrl("device/view", array("id"=>$data->id_device))',
                  ),
                  'update' => array(
                    'label'=>'Изменить',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
                    'url'=>'Yii::app()->createUrl("device/update", array("id"=>$data->id_device))',
                  ),
                  'delete' => array(
                    'label'=>'Удалить',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                    'url'=>'Yii::app()->createUrl("device/delete", array("id"=>$data->id_device))',
                      'deleteConfirmation'=>"js:'Ви дійсно бажаєте видалити даний пристрій?'",
                  ),
                ),
            ),
      ),
  ));
?>