<div id="device_pc_info">
<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		array(
			'name' => 'Материнська плата',
			'type' => 'raw',
            'value' => $model->devicepc->mb,
		),
		array(
			'name' => 'Процесор',
			'type' => 'raw',
            'value' => $model->devicepc->cpu_name,          
		),
		array(
			'name' => 'Швидкість ЦП',
			'type' => 'raw',
            'value' => $model->devicepc->cpu_p." ГГц",          
		),
		array(
			'name' => 'Жорсткий диск',
			'type' => 'raw',
            'value' => $model->devicepc->hdd_name,
		),
		array(
			'name' => 'Об\'єм жорсткого диску',
			'type' => 'raw',
            'value' => $model->devicepc->hdd_p." Гб",          
		),
		array(
			'name' => 'Оперативна пам\'ять',
			'type' => 'raw',
            'value' => $model->devicepc->ram_name,          
		),
		array(
			'name' => 'Об\'єм оперативної пам\'яті',
			'type' => 'raw',
            'value' => $model->devicepc->ram_p." Мб",          
		),
		array(
			'name' => 'Відеокарта',
			'type' => 'raw',
            'value' => $model->devicepc->video_name,          
		),
		array(
			'name' => 'Об\'єм відеопам\'яті',
			'type' => 'raw',
            'value' => $model->devicepc->video_p." Мб",
		),
		array(
			'name' => 'CD/DVD привід',
			'type' => 'raw',
            'value' => $model->devicepc->cdrom_name,          
		),
		array(
			'name' => 'Мережна карта',
			'type' => 'raw',
            'value' => $model->devicepc->lan_name,          
		),
		array(
			'name' => 'Операційна система',
			'type' => 'raw',
            'value' => $model->devicepc->os,
		),
		array(
			'name' => 'Мережне ім\'я',
			'type' => 'raw',
            'value' => $model->devicepc->net_name,
		),
		array(
			'name' => 'IP адреса',
			'type' => 'raw',
            'value' => $model->devicepc->ip,
		),	
	),
)); 

?>
</div>