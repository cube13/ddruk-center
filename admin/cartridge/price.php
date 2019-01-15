<?php 
include 'conf.php';
$cartridge->sql_connect();

$cartridge->sql_query="SELECT id, name FROM brands ORDER BY name";
$cartridge->sql_execute();
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$brand_array[$id]=$name;
	}


// Формирование вывода списка брендов для меню
$cartridge->sql_query="SELECT id, name FROM brands ORDER BY name ASC";
$cartridge->sql_execute();
$brands="";
while (list($id,$name)=mysql_fetch_row($cartridge->sql_res))
{
	$brands.="<a href=\"price.php?brand=$id\">$name</a> | ";
}
$brands.="<a href=\"price.php?brand=0\">Все</a>";

// Формирование вывода прайса принтера
$order="name";
$brand_filter=">0";
if($_GET[brand]==0) {$brand_filter=">0";}
if($_GET[brand]) {$brand_filter="=".$_GET[brand];}
if($_GET[order]) {$order=$_GET[order];}
/*
printers.id    	    	 
printers.name 	  	  	 
printers.alter_name  	  	 
printers.brand 	  	  	 
printers.html_title   	  	 
printers.m_kwords   	  	 
printers.m_desc 	  	  	 
printers.picture   	  	 
printers.page_content  	  	 
printers.cena_novogo   	  	 
printers.user_manual   	  	 
printers.service_manual
printers.type  	  
cart1
cart2
cart3
cart4	 
printers.publish 
*/
$cartridge->sql_query="SELECT
printers.id as print_id,
printers.name as printer,
cartridge.id as cart_id,    	    	 
cartridge.name as cartridg, 	  	  	 
cartridge.cena_zapravki as zapravka,  	  	 
cartridge.cena_vostanovlenia as vost, 	  	  	 
cartridge.cena_novogo as noviy,   	  	 
cartridge.resurs  
FROM printers, cartridge 
WHERE
(printers.cart1=cartridge.id 
OR printers.cart2=cartridge.id 
OR printers.cart3=cartridge.id 
OR printers.cart4=cartridge.id)
AND
(printers.publish='1' AND cartridge.publish='1')
AND 
printers.brand$brand_filter 
ORDER BY printer ASC;";
//echo $cartridge->sql_query;	
$cartridge->sql_execute();
//$sql_query="INSERT INTO print_join_cart(printer_id,cartridge_id,enable) values";
$price_table="<table width=\"100%\"i class=\"sortable\"><tr bgcolor=\"#dddddd\"><td>Принтер</td><td>Картридж</td><td>Цена заправки</td><td>Цена востановления</td><td>Цена нового</td><td>Ресурс, стр.</td></tr>";
while (list($print_id, $printer, $cart_id, $cartridg, $cena_z, $cena_v, $cena_n, $resurs)=mysql_fetch_row($cartridge->sql_res))
{

$price_table.="<tr><td><a href=\"printer.php?act=view_print&print_id=$print_id\">$printer</a></td>
<td><a href=\"cartridge.php?act=view_cart&cart_id=$cart_id\">$cartridg</a></td>
<td>$cena_z</td><td>$cena_v</td><td>$cena_n</td><td>$resurs</td></tr>";

//$sql_query.="($print_id,$cart_id,'1'),";
}

$price_table.="</table>";

$to_screen=$price_table;

?>
<html>
<head><title>Прайс</title>
<style>
        * { font-family: verdana; font-size: 11 ; COLOR: black; }
        b { font-weight: bold; }
        table { height:5; border: 0px solid gray;}
        td { text-align: left; padding: 0;}
.i {font-style:italic;}
.num {width:3em;}
.str {width:5em;}
.disnone {display:none;}
.disnone_child .disnone_if {display:none;}
        </style>
<script type='text/javascript' src='../js/ir2.js'></script>
<script type='text/javascript' src='../js/tabsort2.js'></script>


</head>

<body>
<table width="100%" border="1">
<tr><td><a href="cartridge.php?brand<?php echo $brand_filter;?>">Каталог Картриджей</a> | <a href="printer.php?brand<?php echo $brand_filter;?>">Каталог принтеров</a></td></tr>

<tr height="10">
<td><?php echo $brands;?></td>
</tr>
<tr>
<td><?php echo $to_screen; ?></td>
</tr>

</table>
    <br>
    <?php echo $sql_query;?>
</body>
</html>





