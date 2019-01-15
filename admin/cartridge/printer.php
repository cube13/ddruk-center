<?php 
include 'conf.php';
$cartridge->sql_connect();

$cartridge->sql_query="SELECT id, name FROM brands ORDER BY name";
$cartridge->sql_execute();
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$brand_array[$id]=$name;
	}
$type_array[0]="лазерный";
$type_array[1]="лазерный цветной";
$type_array[2]="струйный";
$type_array[3]="матричный/др.";


// Формирование вывода списка брендов для меню
$cartridge->sql_query="SELECT id, name FROM brands ORDER BY name ASC";
$cartridge->sql_execute();
$brands="";
while (list($id,$name)=mysql_fetch_row($cartridge->sql_res))
{
	$brands.="<a href=\"printer.php?brand=$id\">$name</a> | ";
}
$brands.="<a href=\"printer.php?brand=0\">Все</a>";

switch($_GET[act])
{

//---- Запись параметров принетара
case save_print_param:
$cena_n=$_POST[cena_n];
$user_manual=$_POST[user_manual];
$service_manual=$_POST[service_manual];
$picture=$_POST[picture];
$type=$_POST[type];

if($_POST[publish]=="on"){$publish=1;}else{$publish=0;}
$id=$_GET[id_print];

$cartridge->sql_query="UPDATE printers SET 
`cena_novogo`=$cena_n,
`user_manual`='$user_manual',
`service_manual`='$service_manual',
`picture`='$picture',
`publish`='$publish',
`type`='$type'
WHERE id=$id;
";
echo $cartridge->sql_query;
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$id'</script>";
}
else{echo $cartridge->sql_err;}
break;

case save_print_text:

$print_name=$_POST[print_name];
$print_alter_name=$_POST[print_alter_name];
$html_title=$_POST[html_title];
$m_kwords=$_POST[m_kwords];
$m_desc=$_POST[m_desc];
$page_content=$_POST[page_content];

$id=$_GET[id_print];

$cartridge->sql_query="UPDATE printers SET
name='$print_name',
alter_name='$print_alter_name',
html_title='$html_title',
m_kwords='$m_kwords',
m_desc='$m_desc',
page_content='$page_content' 
WHERE id=$id";

echo $cartridge->sql_query;
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$id'</script>";
}
else{echo $cartridge->sql_err;}
break;

//---- Создание нового принтера
case creat_new_print:
$brand=$_GET[brand];

$cartridge->sql_query="insert into printers(id,name,brand,m_desc) values('','назови меня', $brand,'коротко опиши меня');";
$cartridge->sql_execute();
$last_id=mysql_insert_id();
echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$last_id'</script>";
break;

case add_cart:
    $cartridge->sql_query="INSERT INTO print_join_cart(printer_id,cartridge_id,enable) values
        ($_GET[id_print],$_POST[cart1],'1');";
    $cartridge->sql_execute();
echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[id_print]'</script>";
    break;

case enable_cart:
        $cartridge->sql_query="UPDATE print_join_cart SET
        enable='$_GET[enable]'
        WHERE
        printer_id=$_GET[printer] AND cartridge_id=$_GET[cartridge];";
         $cartridge->sql_execute();
        echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
    break;

case del_cart:
         $cartridge->sql_query="DELETE FROM print_join_cart
        WHERE
        printer_id=$_GET[printer] AND cartridge_id=$_GET[cartridge];;";
          $cartridge->sql_execute();
        echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
break;


case add_param:
    $hash=md5(date('U').rand(1,99999999999));
  $cartridge->sql_query="INSERT INTO print_join_param(id,printer_id,znach,hash) values
        ($_GET[param],$_GET[printer],'','$hash');";
    $cartridge->sql_execute();
echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
    break;

case del_param:
         $cartridge->sql_query="DELETE FROM print_join_param
        WHERE
        printer_id=$_GET[printer] AND id=$_GET[param] AND hash='$_GET[hash]';";
          $cartridge->sql_execute();
        echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
break;



case save_print_values:
foreach ($_POST as $key=>$value)
{
    $temp=explode('_',$key);
    if($temp[0]=='znach')
    {
        $value=strip_tags($value,'<b><a>');
        $value=str_replace(array("\r","\n"),'',$value);
        echo $cartridge->sql_query="UPDATE `print_join_param` SET `znach`='$value'
                where `id`=$temp[1] AND hash='$temp[2]' AND `printer_id`=$_GET[printer];";
        $cartridge->sql_execute();
    
        $value_arr[$temp[1]].="$value, ";
    }

}
echo $cartridge->sql_query="DELETE FROM `print_join_param_txt`  WHERE `printer_id`=$_GET[printer];";
$cartridge->sql_execute();

foreach($value_arr as $key=>$val)
{
    $value=rtrim($val,', ');
    echo $cartridge->sql_query="INSERT INTO `print_join_param_txt` values ('$key','$value','$_GET[printer]');";
        $cartridge->sql_execute();
}
    echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
    break;
case add_rabota:
    echo $cartridge->sql_query="INSERT INTO print_join_cena_rabot(printer_id,rabota_id,cena)
        values($_GET[printer],$_GET[rabota],'99');";
    $cartridge->sql_execute();
   echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
    break;

case save_print_work:
foreach ($_POST as $key=>$value)
{
    $temp=explode('_',$key);
    if($temp[0]=='cena')
    {
        $cartridge->sql_query="UPDATE `print_join_cena_rabot` SET `cena`='$value'
                where `rabota_id`=$temp[1] AND `printer_id`=$_GET[printer];";
        $cartridge->sql_execute();
    }

}

case enable_cena:
       echo $cartridge->sql_query="UPDATE print_join_cena_rabot SET
        public='$_GET[enable]'
        WHERE
        printer_id=$_GET[printer] AND rabota_id=$_GET[rabota];";
         $cartridge->sql_execute();
        echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
    break;

echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
break;

case del_rabota:
        echo  $cartridge->sql_query="DELETE FROM print_join_cena_rabot
        WHERE
        printer_id=$_GET[printer] AND rabota_id=$_GET[rabota];";
          $cartridge->sql_execute();
        echo "<script>top.location.href = 'printer.php?act=view_print&print_id=$_GET[printer]'</script>";
break;

//---- Вывод карточки принтера 
case view_print:

	$cartridge->sql_query="SELECT * FROM `printers` WHERE `id`='$_GET[print_id]'";
	$cartridge->sql_execute();
	if(mysql_num_rows($cartridge->sql_res)!=0)
	{
	list($id_print,$print_name,$print_alter_name,$brand,$html_title,$m_kwords,$m_desc,$picture,$page_content,$cena_n,$user_manual,$service_manual,$type,$cart1,
$cart2,$cart3,$cart4,$publish)=mysql_fetch_row($cartridge->sql_res);
$cart_a=array($cart1,$cart2,$cart3,$cart4);
$checked="";
if($publish==1){$checked="checked=\"checked\"";}	
	
}
	$cartridge->sql_query="SELECT id,name FROM `printers` WHERE `brand`='$brand'";
	$cartridge->sql_execute();
	$quick_menu="";
	if(mysql_num_rows($cartridge->sql_res)!=0)
	{
		while(list($id,$name)=mysql_fetch_row($cartridge->sql_res))
		{
		if($id==$id_print){$quick_menu.="<b><a href=\"printer.php?act=view_print&print_id=$id\">$name</a></b><br>";}
		else{$quick_menu.="<a href=\"printer.php?act=view_print&print_id=$id\">$name</a><br>";}
		}
}

$type_list="<select name=type>";
for($i=0;$i<4;$i++)
{
if($type==$i){$selected="selected";}
$type_list.="<option value=$i $selected>".$type_array[$i]."</option>";
$selected="";
}
$type_list.="</select>";

// Выбор картриджей

	$cartridge->sql_query="SELECT id,name FROM `cartridge` WHERE `brand`='$brand'";
	$cartridge->sql_execute();
	$cart_s=array();
	if(mysql_num_rows($cartridge->sql_res)!=0)
	{
		while(list($id,$name)=mysql_fetch_row($cartridge->sql_res))
		{
			$cart_s[$id]=$name;
		}
	}

$cart_list1="<select name=cart1>";
$cart_list1.="<option value=0>--------</option>";
foreach($cart_s as $key => $value)
{
if($key==$cart1){$selected="selected";}
$cart_list1.="<option value=$key $selected>$value</option>";
$selected="";
}
$cart_list1.="</select>";

//Выбор картриджей по новому методу из таблицы привязок

 $cartridge->sql_query="SELECT cartridge.id, cartridge.name, print_join_cart.enable
        FROM cartridge
        LEFT JOIN print_join_cart ON print_join_cart.cartridge_id=cartridge.id
        WHERE print_join_cart.printer_id=$id_print";
$cartridge->sql_execute();

$cartridge_form="<h2>Картриджи</h2>
    <form enctype='multipart/form-data' action='printer.php?act=add_cart&id_print=$id_print' method=post>
    <table border=0>";
if(!$cartridge->sql_err)
{
    while(list($cart_id,$cart_name,$enable)=mysql_fetch_row($cartridge->sql_res))
    {
        $enable ? $bgcolor="#ffffff" : $bgcolor='#cccccc';
        $enable ? $off_on="<a href=\"printer.php?act=enable_cart&enable=0&printer=$id_print&cartridge=$cart_id\">выкл</a>" : $off_on="<a href=\"printer.php?act=enable_cart&enable=1&printer=$id_print&cartridge=$cart_id\">вкл</a>";
        $cartridge_form.="
        <tr bgcolor=$bgcolor><td width=150>$cart_name</td><td>$off_on | <a href=\"printer.php?act=del_cart&printer=$id_print&cartridge=$cart_id\">удалить</a></td></tr>";

    }
}

$cartridge_form.="<tr height=10><td></td><td></td></tr>
        <tr><td width=150>$cart_list1</td><td><input type=submit value='Добавить'></td></tr>

   </table>
</form>
";

//Редактор характеристик принтера
$cartridge->sql_query="SELECT id, name
            FROM  `params_print`
            WHERE id NOT IN(0)";
$cartridge->sql_execute();
$printer_value_form_add="";
if(!$cartridge->sql_err)
{
    while(list($param_id,$param_name)=mysql_fetch_row($cartridge->sql_res))
    {
        $printer_value_form_add.="
        | <a href=\"printer.php?act=add_param&printer=$id_print&param=$param_id\">$param_name</a> |";
     }
}


 $cartridge->sql_query="SELECT print_join_param.id, znach, params_print.name,hash
            FROM  `print_join_param`
            JOIN params_print ON params_print.id = print_join_param.id
WHERE print_join_param.printer_id=$id_print
         ORDER BY params_print.sort ASC;";
$cartridge->sql_execute();


$printer_value_form="<span style='font-size:16px;font-weight: bold;'>Характеристики принтера</span><br>
$printer_value_form_add<br><br>
<form enctype='multipart/form-data' action='printer.php?act=save_print_values&printer=$id_print' method=post>
    <table border=0 cellspacing=0  cellpadding=1>";
if(!$cartridge->sql_err)
{
    $filter="";
    while(list($param_id,$param_znach,$param_name,$hash)=mysql_fetch_row($cartridge->sql_res))
    {
         $flag_style ? $style="style='background-color: white;'" : $style="style='background-color: #dddddd;'";
        $flag_style ? $flag_style-- : $flag_style++;
$znach_name="znach_".$param_id."_".$hash;
        $printer_value_form.="
        <tr><td width=350 $style>$param_name</td>\n
        <td $style><textarea id=\"text_param_$param_id\" cols=50 rows=1 name=$znach_name>$param_znach</textarea></td>\n
        <td $style width=100><a href=\"printer.php?act=del_param&printer=$id_print&param=$param_id&hash=$hash\">удалить</a></td></tr>\n";
}
}
$printer_value_form.="</table><input type=submit value='Сохранить'></form>";

//Вывод занчений принтера с групировкой в одну строку
 $cartridge->sql_query="SELECT print_join_param_txt.id, znach, params_print.name
            FROM  `print_join_param_txt`
            JOIN params_print ON params_print.id = print_join_param_txt.id
WHERE print_join_param_txt.printer_id=$id_print
         ORDER BY params_print.sort ASC;";
$cartridge->sql_execute();

$printer_value_form_txt="<table border=0 cellspacing=0  cellpadding=1>";
if(!$cartridge->sql_err)
{
    
    while(list($param_id,$param_znach,$param_name)=mysql_fetch_row($cartridge->sql_res))
    {
         $flag_style ? $style="style='background-color: white;'" : $style="style='background-color: #dddddd;'";
        $flag_style ? $flag_style-- : $flag_style++;
        $printer_value_form_txt.="
        <tr><td width=350 $style>$param_name</td>\n
        <td $style>$param_znach</td></tr>\n";
}
}
$printer_value_form_txt.="</table>";






//редактор работ и цен принтера
$cartridge->sql_query="SELECT vid_rabot.id, vid_rabot.name, print_join_cena_rabot.cena, print_join_cena_rabot.public
FROM `print_join_cena_rabot`
JOIN vid_rabot ON print_join_cena_rabot.rabota_id=vid_rabot.id
       WHERE print_join_cena_rabot.printer_id=$id_print";
$cartridge->sql_execute();

$price_work_form="<h2>Цены на работы по принтерам</h2>
<table><tr><td valign=top>
<form enctype='multipart/form-data' action='printer.php?act=save_print_work&printer=$id_print' method=post>
    <table border=0>";
while(list($id, $rabota,$cena,$public)=  mysql_fetch_row($cartridge->sql_res))
{
    $public ? $bgcolor="#ffffff" : $bgcolor='#cccccc';
    $public ? $off_on="<a href=\"printer.php?act=enable_cena&enable=0&printer=$id_print&rabota=$id\">выкл</a>" : $off_on="<a href=\"printer.php?act=enable_cena&enable=1&printer=$id_print&rabota=$id\">вкл</a>";
    
    $price_work_form.="<tr bgcolor=$bgcolor><td>$rabota</td><td><input type=text size=3 name=cena_$id value=\"$cena\">
    &nbsp;&nbsp;&nbsp;$off_on&nbsp;&nbsp;&nbsp;<a href=\"printer.php?act=del_rabota&printer=$id_print&rabota=$id\">X</a></td></tr>";
     $filter.="$id,";

}
$price_work_form.="<tr><td colspan=2><input type=submit value='Сохранить'></td></tr></table></form></td>
    <td width=10></td>";
$cartridge->sql_query="SELECT id, name
            FROM  `vid_rabot`
            WHERE id NOT IN($filter 0) and type='1'";
$cartridge->sql_execute();
$price_work_form.="<td valign=top>";
if(!$cartridge->sql_err)
{
    while(list($rabota_id,$rabota_name)=mysql_fetch_row($cartridge->sql_res))
    {
        $price_work_form.="
        <a href=\"printer.php?act=add_rabota&printer=$id_print&rabota=$rabota_id\"><<<</a> $rabota_name<br/>";
    }
}
$price_work_form.="</td></tr></table>";



$param_form="<form enctype='multipart/form-data' action='printer.php?act=save_print_param&id_print=$id_print' method=post>
<table border=0>
 <tr>
  <td valign=\"top\"><img src=\"$picture\" width=\"200\" title=\"картинка\"><br><br>
<input id=\"PicPath\" type=text name=\"picture\" value=\"$picture\" size=\"27\">
<input type=\"button\" value=\"Добавить\" onclick=\"BrowseServer('Images:/printers', 'PicPath');\"></td>
  <td valign=\"top\">
   <table width=\"100%\">
    <tr><td>Тип</td><td>$type_list</td></tr>
    <tr><td>Цена нового</td><td><input  type=text size=5 name='cena_n' value=\"$cena_n\"></td></tr>
    <tr><td>Юзер мануал</td><td><input id=\"UserMan\" type=text size=20 name='user_manual' value=\"$user_manual\">
<input type=\"button\" value=\"Добавить\" onclick=\"BrowseServer('Files:/user/printers', 'UserMan');\">
</td></tr>
    <tr><td>Сервис мануал</td><td><input id=\"ServiceMan\" type=text size=20 name='service_manual' value=\"$service_manual\">
<input type=\"button\" value=\"Добавить\" onclick=\"BrowseServer('Files:/service/printers', 'ServiceMan');\">
</td></tr>
    <tr><td>Публикация</td><td><input type=checkbox name='publish' $checked></td></tr>	
   </table>
<input type=submit value='Сохранить'>
</form>
$cartridge_form
  </td>
  <td valign=\"top\">
   $price_work_form
  </td>
 </tr>
</table>";




$text_form="<form enctype='multipart/form-data' action='printer.php?act=save_print_text&id_print=$id_print' method=post>
<table width=\"100%\" border=0>

<tr><td>Имя</td><td><input type=\"text\" name=\"print_name\" value=\"$print_name\" size=\"100\"></td></tr>
<tr><td>Альт-ное имя</td><td><input type=\"text\" name=\"print_alter_name\" value=\"$print_alter_name\" size=\"100\"></td></tr>
<tr><td>тэг title</td><td><input type=\"text\" name=\"html_title\" value=\"$html_title\" size=\"100\"></td></tr>
<tr><td>Ключ слова</td><td><input type=\"text\" name=\"m_kwords\" value=\"$m_kwords\" size=\"100\"></td></tr>
<tr><td>тэг описания</td><td><input type=\"text\" name=\"m_desc\" value=\"$m_desc\" size=\"100\"></td></tr>
<tr><td colspan=\"2\">Статья, описание<br><br><textarea id=\"ckeditor\" name=\"page_content\" rows=20 cols=100 stile=\"width=80%\">$page_content</textarea>
 <script type=\"text/javascript\">

    var editor=CKEDITOR.replace( 'ckeditor' );
    CKFinder.setupCKEditor( editor,'../ckfinder/') ;
</script>
</td>
</tr>
<tr><td><input type=submit value='Сохранить'></td></tr>
</table>
</form>
";

$to_screen="<table width=\"100%\" border=\"0\"><tr>
<td width=\"150\" align=\"left\" valign=\"top\">$quick_menu</td>
<td width=\"*\" align=\"center\" valign=\"top\"> 
<table width=\"100%\" border=\"1\">
<tr><td align=\"center\" colspan=2><h2>$print_alter_name</h2></td></tr>
<tr><td>$param_form </td></tr>
<tr><td>$printer_value_form<br>
$printer_value_form_txt</td></tr>
<tr><td>$text_form</td></tr>
</table>";	

break;

default:
// Формирование вывода каталога принтера
$order="name";
$brand_filter=">0";
if($_GET[brand]) {$brand_filter="=".$_GET[brand];}
if($_GET[order]) {$order=$_GET[order];}

$cartridge->sql_query="SELECT 
printers.id,    	    	 
printers.name, 	  	  	 
printers.alter_name,  	  	 
printers.brand, 	  	  	 
printers.cena_novogo,   	  	 
printers.user_manual,  
printers.service_manual, 	  	 
printers.type,
printers.publish 
FROM printers 
WHERE printers.brand$brand_filter ORDER BY printers.name ASC";
//echo $cartridge->sql_query;	
$cartridge->sql_execute();

$printers_table="<table width=\"100%\" class=\"sortable\"><tr bgcolor=\"#dddddd\"><th>Название</th><th>Тип</th><th>Юзер мануал</th><th>Сервис мануал</th><th>Цена</th></tr>";
while (list($id,$name,$alter_name,$brand,$cena_n,$user_manual,$service_manual,$type,$publish)=mysql_fetch_row($cartridge->sql_res))
{
switch($type)
{
case 0: $type="лазерный";break;
case 1: $type="лазерный цветной";break;
case 2: $type="струйный";break;
case 3: $type="матричный";
}

if($publish==0){$bgcolor_tr="bgcolor=\"#aaaaaa\"";}
if($publish==1){$bgcolor_tr="bgcolor=\"white\"";}

$printers_table.="<tr $bgcolor_tr><td $bgcolor_tr><a href=\"printer.php?act=view_print&print_id=$id\">$name</a></td><td $bgcolor_tr>$type</td><td $bgcolor_tr>$user_manual</td><td $bgcolor_tr>$service_manual</td><td $bgcolor_tr>$cena_n</td></tr>";
}

$printers_table.="<tr height=\"5\"><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>";
$printers_table.="<tr><td><a href=\"printer.php?act=creat_new_print&brand$brand_filter\">Создать новый</a></td><td></td><td></td><td></td><td></td></tr>";
$printers_table.="</table>";

$to_screen=$printers_table;
}
?>
<html>
<head><title>Каталог принтеров</title>
<script type='text/javascript' src='../js/ir2.js'></script>
<script type='text/javascript' src='../js/tabsort2.js'></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../ckfinder/ckfinder.js"></script>

<script type="text/javascript" src="/ddruk/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function BrowseServer(startupPath, functionData )
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '../../';	// The path for the installation of CKFinder (default = "/ckfinder/").
	
	// It can also be done in a single line, calling the "static"
	// Popup( basePath, width, height, selectFunction ) function:
	// CKFinder.Popup( '../../', null, null, SetFileField ) ;
	//
	// The "Popup" function can also accept an object as the only argument.
	// CKFinder.Popup( { BasePath : '../../', selectActionFunction : SetFileField } ) ;


	//Startup path in a form: "Type:/path/to/directory/"
	finder.startupPath = startupPath;
	// Name of a function which is called when a file is selected in CKFinder.
	finder.selectActionFunction = SetFileField;

	// Additional data to be passed to the selectActionFunction in a second argument.
	// We'll use this feature to pass the Id of a field that will be updated.
	finder.selectActionData = functionData;

	// Name of a function which is called when a thumbnail is selected in CKFinder.
	finder.selectThumbnailActionFunction = ShowThumbnails;

	// Launch CKFinder
	finder.popup();

}
// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl, data )
{
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}
// This is a sample function which is called when a thumbnail is selected in CKFinder.
function ShowThumbnails( fileUrl, data )
{
	// this = CKFinderAPI
	var sFileName = this.getSelectedFile().name;
	document.getElementById( 'thumbnails' ).innerHTML +=
			'<div class="thumb">' +
				'<img src="' + fileUrl + '" />' +
				'<div class="caption">' +
					'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
				'</div>' +
			'</div>';

	document.getElementById( 'preview' ).style.display = "";
	// It is not required to return any value.
	// When false is returned, CKFinder will not close automatically.
	return false;
}

</script>

<style>
	* { font-family: verdana; font-size: 13px	; COLOR: black; }
	b { font-weight: bold; }
	table { height:5; border: 0px solid gray;}
	td { text-align: left; padding: 0;}
.i {font-style:italic;} 
.num {width:3em;}
.str {width:5em;}
.disnone {display:none;}
.disnone_child .disnone_if {display:none;}


	</style>

	</head>

<body>
<table width="100%" border="1">

<tr><td><a href="cartridge.php?brand<?php echo $brand_filter;?>">Каталог Картриджей</a> | <a href="price.php?brand<?php echo $brand_filter;?>">Прайс</a></td></tr>

<tr height="10">
<td><?php echo $brands;?></td>
</tr>
<tr>
<td><?php echo $to_screen; ?></td>
</tr>

</table>
</body>
</html>
