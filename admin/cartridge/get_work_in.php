<?php
header('Content-Type: text/html; charset=utf-8');
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();

$cartridge->sql_query="SELECT num_of_receipt,client_name,client_mob_tel,work_plan,cart_num,
        reestr.name,org.short_name,org.tel,org.mob_tel,priority
        FROM cartridge_proces
        JOIN reestr ON cart_num=reestr.uniq_num
        JOIN org ON reestr.org_id=org.id
        WHERE cartridge_proces.status=1 or cartridge_proces.status=5
        ORDER BY priority ASC, date DESC;";
      $cartridge->sql_execute();
    $incoming="<table border=0 width=100% cellspacing=5><tr bgcolor=cccccc><td width=15></td><td>Квитанция</td><td>Картридж</td>
        <td>Имя Телефон</td><td>Владелец</td></tr>";

    while(list($num_of_receipt,$client_name,$client_mob_tel,$work_plan_i,$cart_num,
        $cart_name,$org_name,$org_tel,$org_mob_tel,$priority)=mysql_fetch_row($cartridge->sql_res))
    {
        if($color=="#ffffff") $color="#eeeeee";
        else $color="#ffffff";
        $incoming.="<tr bgcolor=$color><td>$priority</td><td>$num_of_receipt</td><td>$cart_num $cart_name<br> $work_plan[$work_plan_i]</td>
        <td>$client_name<br>$client_mob_tel</td>

        <td>$org_name $org_tel $org_mob_tel</td></tr>";
    }
$incoming.="</table>";

echo $incoming;
?>
