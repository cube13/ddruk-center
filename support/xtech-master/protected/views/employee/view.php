<?php
/* @var $this EmployeeController */
/* @var $model Employee */

/*$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->id_employee,
);*/

$this->menu=array(
	//array('label'=>'List Employee', 'url'=>array('index')),
	//array('label'=>'Create Employee', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->id_employee)),
    array('label'=>'Додати співробітника', 'url'=>array('create', 'parent'=>$model->id_cabinet)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_employee),'confirm'=>'Ви впевнені, що бажаєте видалити даного співробітника?')),
	//array('label'=>'Manage Employee', 'url'=>array('admin')),
);
?>

<h1>Перегляд даних співробітника: <?php echo $model->firstname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_employee',
		//'id_organization',
		//'id_branch',
		//'id_department',
		//'id_cabinet',
		'firstname',
		'lastname',
		'surname',
		'description',
		'telephones',
		//'post',
		'email',
		'login',
		'tab_number',
		'home_address',
		'dob',
		'pasp',
		//'fired',
        array(
            'name' => 'Звільнений',
            'value' => ($model->fired)?'Так':'Ні',
            'type' => 'html',
        ),
		//'dof',
        array(
            'name' => 'Дата звільнення',
            'value' => ($model->dof != '0000-00-00')?$model->dof:'-',
            'type' => 'html',
        ),
	),
)); ?>

<hr>

<?php $this->widget('application.components.AddDevice.AddDevice', array('parent'=>$model->id_employee)); ?>