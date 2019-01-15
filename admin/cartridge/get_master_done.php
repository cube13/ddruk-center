<?php
header('Content-Type: text/html; charset=utf-8');
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();

//Формирование готовых
 $cartridge->sql_query="SELECT cartridge_proces.id,num_of_receipt,client_name,client_mob_tel,work_plan,cart_num,
        reestr.name,org.short_name,org.tel,org.mob_tel,work_fact
        FROM cartridge_proces
        JOIN reestr ON cart_num=reestr.uniq_num
        JOIN org ON reestr.org_id=org.id
        WHERE cartridge_proces.status=2
        ORDER BY num_of_receipt ASC, cart_num ASC;";
    $done="<table border=0 width=100% cellspacing=5><tr bgcolor=cccccc><td>Квитанция</td><td>Картридж</td>
        <td>Факт</td><td>План</td><td>Имя Телефон</td><td>Владелец</td><td></td></tr>";
    $cartridge->sql_execute();

    while(list($id,$num_of_receipt,$client_name,$client_mob_tel,$work_plan_i,$cart_num,
        $cart_name,$org_name,$org_tel,$org_mob_tel,$work_fact_i)=mysql_fetch_row($cartridge->sql_res))
    {
        if($color=="#ffffff") $color="#eeeeee";
    else $color="#ffffff";
    $work_fact="";
    foreach($work_plan as $key=>$value)
    {
        if($key==$work_fact_i)
        {
            $work_fact.="<b>$value</b><br>";
        }
        else
        {
            $work_fact.="<a href='$PHP_SELF?act=change_fact_work&work_fact=$key&id=$id'>$value</a><br>";
        }
    }

    $done.="<tr bgcolor=$color><td>$num_of_receipt</td><td>$cart_num $cart_name<br>
    <a class=cartridge_done href='$PHP_SELF?act=cartridge_done&id=$id&status=3'>готов</a></br>
    <a class=cartridge_rework href='$PHP_SELF?act=incoming_form&id=$id&status=1'>доделать</a></td>
    <td>$work_fact</td><td>$work_plan[$work_plan_i]</td>
    <td>$client_name<br>$client_mob_tel</td>

        <td>$org_name $org_tel $org_mob_tel</td></tr>";
    }
$done.="</table>";

echo $done;

?>
