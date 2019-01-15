<?php
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();

$work_plan=array('Чистка','Заправка','Восстановление');
$refhesh=1;

//Формирование готовых и проверенных
 $cartridge->sql_query="SELECT cartridge_proces.id,num_of_receipt, cart_num,
     reestr.name, client_name, client_mob_tel, client_adres,
     work_fact,  cartridge.cena_zapravki, cartridge.cena_vostanovlenia, send_sms
        FROM cartridge_proces
        JOIN reestr ON cart_num=reestr.uniq_num
        JOIN cartridge ON reestr.name_id=cartridge.id
        WHERE cartridge_proces.status=3
        ORDER BY num_of_receipt ASC,priority ASC;";


    $cartridge->sql_execute();
    $td=0;$count=0;
    $td_max=5;
    $welldone="<table border=0>";
    while(list($id,$num_of_receipt, $cart_num, $cart_name, $client_name, $client_mob_tel, $client_adres,
     $work_fact_i, $cena_zapravki, $cena_vostanovlenia, $send_sms)=mysql_fetch_row($cartridge->sql_res))
    {

        if($td==0)$welldone.="<tr>";
        if($td<$td_max)
        {
            $welldone.="<td width=250 valign='top' align='center' class=cart_block>
                <div class=cart_name>".$cart_num."  ".$cart_name."</div>\n
                    Квитанция №$num_of_receipt";
            if($work_fact_i==1)
            {
                $welldone.="<div class=work>".$work_plan[$work_fact_i].". Цена: $cena_zapravki</div><br>\n";
            }
            if($work_fact_i==2)
            {
                $welldone.="<div class=work>".$work_plan[$work_fact_i].". Цена: $cena_vostanovlenia</div><br>\n";
            }
               $welldone.="<div class=client>$client_name<br>$client_mob_tel<br><b>Адрес доставки:</b> $client_adres</div>\n";
               $welldone.="<br><table width=100%><tr>";
            if($send_sms==0 && $client_mob_tel){$welldone.="<td class=button width=50%><a class=button href='sendsms.php?id=$id'>SMS</a></td>";}
            elseif($send_sms==2){$welldone.="<td class=button width=50%>SMS отправлено</td>";}
            elseif($send_sms==3){$welldone.="<td class=button width=50%>SMS доставлено</td>";}
            elseif($send_sms==100){$welldone.="<td class=button width=50%>SMS не доставлено<br>Перезвонить!</td>";}
            else {$welldone.="<td class=button width=50%></td>";}
                $welldone.="<td class=button width=50%><a class=button href='index.php?act=cartridge_done&status=4&id=$id'>Готов</a></td>
                   </tr></table>";
               $welldone.="</td>\n";
            $td++;

        }
        if($td==$td_max){$welldone.="</tr>";$td=0;}
     }
     $welldone.="</table>";
     $to_screen=$welldone;

?>
<html>
<head><title></title>
<?php if($refhesh) echo '<meta http-equiv="refresh" content="30; url=http://ddruk/cartridge/manager.php">';?>
<style>
	* { font-family: verdana; font-size: 11	; COLOR: black; }

	table { height:5; border: 0px solid gray;}
	td { padding: 0;}
.i {font-style:italic;}
.num {width:3em;}
.str {width:5em;}
.disnone {display:none;}
.disnone_child .disnone_if {display:none;}

	</style>

<link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>



</head>
<body>
        <br/><br/>
<table width="100%" border=->
    <tr align="left" valign="top">
	<td width="*">
			<?php echo $to_screen;?>
		</td>


	</tr>
</table>

</body>
</html>