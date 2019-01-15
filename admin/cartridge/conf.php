<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
require '../req/mysql.php';
$cartridge=new cls_mysql();
$work_plan=array('Чистка','Заправка','Восстановление');
?>