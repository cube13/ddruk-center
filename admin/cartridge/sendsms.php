<?php
require_once('../sms/smsclient.class.php');
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();
 $cartridge->sql_query="SELECT num_of_receipt, cart_num, reestr.name, client_name,client_mob_tel
        FROM cartridge_proces
        JOIN reestr ON cart_num=reestr.uniq_num
        JOIN cartridge ON reestr.name_id=cartridge.id
        WHERE cartridge_proces.id=$_GET[id]
        LIMIT 1";
 $cartridge->sql_execute();
 list($num_of_receipt,$cart_num,$cart_name,$client_name,$client_mob_tel)=mysql_fetch_row($cartridge->sql_res);
 $message="Ваш заказ готов.Квитанция №$num_of_receipt.Добрый Друк";
//init class with your login/password
 //echo $message;
$sms = new SMSclient('380919140681', '4j10vxzo', '');

/*
sendSMS(from (phone, name),to phone, message, timestamp when to send sms, wap-push link, flash flag (bool));
*/

//send on SMS and receive it's id for tracking
//message in UTF-8
$id = $sms->sendSMS('DobriyDruk', $client_mob_tel, $message);

//send WAP-PUSH message
//$id = $sms->sendSMS('Alpha Name','0504423230', 'Самый классынй сайт!', time(), 'http://alphasms.com.ua/');

//send flash message at certain time
//$id = $sms->sendSMS('80501234567','80504423230', 'Flash message in english letters only!', strtotime('+1 minute'), '', 1);

//just for usage - text can be translierated to use less symbols in sms
//echo SMSclient::translit('Текст сообщения на русском языка в UTF-8 любой длинны');


//if no ID - then message is not sent and you should check errors
//if($sms->hasErrors())
//	die(var_dump($sms->getErrors()));
//else
	//var_dump($id);

//doing something interesting...
sleep(7);

//track message status after about 0,5 minute.
$result=$sms->receiveSMS($id);
echo $result;
if($result=="Отправлено")
{
    $cartridge->sql_query="UPDATE cartridge_proces SET
                send_sms=2
               WHERE id='$_GET[id]'";
          $cartridge->sql_execute();
          echo "<script>top.location.href = 'http://ddruk/cartridge/'</script>";
}
elseif($result=="Доставлено")
{
    $cartridge->sql_query="UPDATE cartridge_proces SET
                send_sms=3
               WHERE id='$_GET[id]'";
          $cartridge->sql_execute();
          echo "<script>top.location.href = 'http://ddruk/cartridge/'</script>";
}
else
{
    $cartridge->sql_query="UPDATE cartridge_proces SET
                send_sms=100
               WHERE id='$_GET[id]'";
          $cartridge->sql_execute();
          echo "<script>top.location.href = 'http://ddruk/cartridge/'</script>";
}
//var_dump($res);
//var_dump($sms->getResponse());//full data

//get amount of money in account
//var_dump($sms->getBalance());
//echo $sms->getBalance();
?>