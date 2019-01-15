<?php
header('Content-Type: text/html; charset=utf-8');
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{
    if($_GET['q'])
    {
        $cartridge->sql_query="
        SELECT reestr.id, uniq_num, reestr.name, short_name, cartridge.name, brands.name
        FROM org, reestr
        LEFT JOIN cartridge ON reestr.name_id = cartridge.id
LEFT JOIN brands ON cartridge.brand = brands.id
WHERE reestr.org_id=org.id AND uniq_num LIKE '%$_GET[q]%'";
//echo  $cartridge->sql_query;
$cartridge->sql_execute();
$cartridge_table="<table width=\"100%\"><tr bgcolor=\"#dddddd\">
<td>Номер</td>
<td>Наименование</td>
<td>Клиент</td></tr>";

while (list($cartridge_id,$num,$name,$klient_name,$cart_name,$brand_name)=mysql_fetch_row($cartridge->sql_res))
{
	$cartridge_table.="<tr><td><a href=$PHP_SELF?act=view_cart&cartridge_num=$num>$num</a></td>
        <td>$brand_name $cart_name</td><td>$klient_name</td></tr>";

}
$cartridge_table.="</table>";
    }
    echo $cartridge_table;

}
?>