<?php 
include 'conf.php';
$cartridge->sql_connect();

switch($_GET[act])
{
case save_s:
foreach ($_POST as $key=>$value)
{
$temp=explode('_',$key); 
if($temp[0]=='s')
{

$cartridge->sql_query="UPDATE `settings` SET `value`='$value' where `id`=$temp[1];";
$cartridge->sql_execute();
}
}

break;

case save_p:

foreach ($_POST as $key=>$value)
{
    $temp=explode('_',$key);
 
    if($temp[0]=='p')
    {
        $cartridge->sql_query="UPDATE `params_print` SET `name`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
    }
    if($temp[0]=='sort')
    {
        $cartridge->sql_query="UPDATE `params_print` SET `sort`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
        
        $inmaintable="inmaintable_".$temp[1];
        if($_POST[$inmaintable]=="on") $val=1;
        if($_POST[$inmaintable]=="off" || !$_POST[$inmaintable]) $val=0;
        
        $cartridge->sql_query="UPDATE `params_print` SET `inmaintable`='$val' where `id`=$temp[1];";
        $cartridge->sql_execute();
        
    }
}
break;
case save_raboty_printer:
$query="";
foreach ($_POST as $key=>$value)
{
    $temp=explode('_',$key);
    
//    $query.="UPDATE `vid_rabot` SET `".$temp[0]."`='$value' where `id`=".$temp[1].";";

    if($temp[0]=='name')
    {
        $cartridge->sql_query="UPDATE `vid_rabot` SET `name`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
        
    }
     if($temp[0]=='cena')
    {
        $cartridge->sql_query="UPDATE `vid_rabot` SET `cena`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
        
    }
    if($temp[0]=='cenatxt')
    {
        $cartridge->sql_query="UPDATE `vid_rabot` SET `cenatxt`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
    }
    if($temp[0]=='sort')
    {
        $cartridge->sql_query="UPDATE `vid_rabot` SET `sort`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
    }
    if($temp[0]=='opisanie')
    {
        $cartridge->sql_query="UPDATE `vid_rabot` SET `opisanie`='$value' where `id`=$temp[1];";
        $cartridge->sql_execute();
    }
    
    
   
}
//echo $query;
//$cartridge->sql_query=$query;
//$cartridge->sql_execute();
break;

case import_price:
$cartridge->sql_query="select value from settings where name='nacenka_cartridg'";
$cartridge->sql_execute();
if(!$cartridge->sql_err){list($nacenka_cartridg)=mysql_fetch_row($cartridge->sql_res);}
$file=fopen("import.csv","r");
        while(!feof($file))
        {
                $prices=fgets($file,128);
                $temp_arrey=explode(",",$prices);
                $cena_new=$temp_arrey[1]*(($nacenka_cartridg+100)/100);
                $cartridge->sql_query="UPDATE cartridge SET cena_novogo='$cena_new' WHERE partnumber='$temp_arrey[0]'";
                $cartridge->sql_execute();
flush();
        }
fclose($file);
break;

case add_new_param:

$cartridge1=new cls_mysql();
$cartridge1->sql_connect();
    
$cartridge->sql_query="INSERT INTO `params_print` (name) VALUES ('$_POST[new_param]')";
$cartridge->sql_execute();
$last_id=mysql_insert_id();

$cartridge->sql_query="SELECT `id` FROM `printers` WHERE 1";
$cartridge->sql_execute();

while(list($printer_id)=mysql_fetch_row($cartridge->sql_res))
{
    $hash=md5(date('U').rand(1,99999999999));
    $cartridge1->sql_query="INSERT INTO  print_join_param (`id`, `znach`, `printer_id`, `hash`) values('$last_id','','$printer_id','$hash');";
//echo "<br>".$cartridge1->sql_query;    
$cartridge1->sql_execute();
}


break;

case add_new_rabota:

echo $cartridge->sql_query="INSERT INTO `vid_rabot` (name,type) VALUES ('$_POST[new_work]',1)";
$cartridge->sql_execute();
break;


default:
}




$cartridge->sql_query="select * from settings";
$cartridge->sql_execute();

if(mysql_num_rows($cartridge->sql_res)!=0)
{
$settings_table="<form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=save_s\" method=\"post\"><table>";
	while(list($id, $name,$name_ru,$value)=mysql_fetch_row($cartridge->sql_res))
	{
		$settings_table.="<tr><td>$name_ru</td><td><input type=text size=4 name=s_$id value=$value></td></tr>";
	}
	
	$settings_table.="<tr><td colspan=\"2\"><input type=submit value='Сохранить'></td></tr></table></form>";
}
$to_screen=$settings_table;
$to_screen.="<br><a href=\"$PHP_SELF?act=import_price\">Импорт файла import.csv</a>";

// Справочник характеристи принтера
$cartridge->sql_query="SELECT * FROM params_print ORDER by sort ASC;";
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
$params_print="<form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=save_p\" method=\"post\"><table>";
        while(list($id, $name,$sort,$inmaintable)=mysql_fetch_row($cartridge->sql_res))
        {
            $inmaintable?$checked="checked='checked'":$checked="";
                $params_print.="<tr><td><input type=text size=50 name=p_$id value=\"$name\"></td>
            <td><input type=text size=3 name=sort_$id value=\"$sort\"></td>
            <td><input type=checkbox name=inmaintable_$id $checked></td></tr>";
        }

        $params_print.="<tr><td><input type=submit value='Сохранить'></td></tr></form>";
}
$params_print.="<tr><td colspan=2><form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=add_new_param\" method=\"post\">
<input type=text size=50 name=new_param>&nbsp<input type=submit value=\"Добавить\"></form></td></tr></table>";

//Справочник цен на работы по принтерам
$cartridge->sql_query="SELECT * FROM vid_rabot where type=1 ORDER by sort ASC;";
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
$raboty_print="<form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=save_raboty_printer\" method=\"post\"><table>";
        while(list($id, $name,$type,$cena,$cena_text,$sort,$opisanie)=mysql_fetch_row($cartridge->sql_res))
        {
            $raboty_print.="<tr><td><input type=text size=50 name=name_$id value='$name'></td>
            <td><input type=text size=10 name=cenatxt_$id value=\"$cena_text\">
            <input type=text size=4 name=cena_$id value=\"$cena\">
            <input type=text size=2 name=sort_$id value=\"$sort\">
            <input type=text size=2 name=opisanie_$id value=\"$opisanie\">
            </td></tr>";
        }

        $raboty_print.="<tr><td><input type=submit value='Сохранить'></td></tr></form>";
}
$raboty_print.="<tr><td colspan=2><form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=add_new_rabota\" method=\"post\">
<input type=text size=50 name=new_work>&nbsp<input type=submit value=\"Добавить\"></form></td></tr></table>";

?>
</body>
</html>

<html>
<head><title>Настройки</title>
<style>
        * { font-family: verdana; font-size: 11px ; COLOR: black; }
        b { font-weight: bold; }
        table { height:5; border: 0px solid gray;}
        td { text-align: left; padding: 0;}


        </style>

</head>
<body>

<table width="100%" border="1">

<tr><td><a href="cartridge.php?brand<?php echo $brand_filter;?>">Каталог Картриджей</a> | <a href="price.php?brand<?php echo $brand_filter;?>">Прайс</a>
 | <a href="settings.php">Настройки</a></td></tr>

<tr height="10">
</tr>
<tr>
<td><?php echo $to_screen; ?></td>
</tr>
<tr>
<td>
    <table border="1"><tr><td valign="top">   Справочник характеристик принтеров<br>

<?php echo $params_print;?></td>
<td valign="top">
    Справочник цен на работы по принтерам<br/>
    <?php echo $raboty_print;?>
</td></tr></table>
</tr>
</table>
</body>
</html>

