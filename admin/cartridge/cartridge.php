<?php 
include 'conf.php';

$cartridge->sql_connect();

$cartridge->sql_query="SELECT value FROM settings WHERE id=1";
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
list($kurs_usd_nal)=mysql_fetch_row($cartridge->sql_res);
}


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

$chip_array[0]="нет";
$chip_array[1]="строго да";
$chip_array[2]="можно без чипа";
$chip_array[3]="Прошивка принтера";

// Формирование вывода списка брендов для меню
$cartridge->sql_query="SELECT id, name FROM brands ORDER BY name ASC";
$cartridge->sql_execute();
$brands="";
while (list($id,$name)=mysql_fetch_row($cartridge->sql_res))
{
	$brands.="<a href=\"cartridge.php?brand=$id\">$name</a> | ";
}
$brands.="<a href=\"cartridge.php?brand=0\">Все</a>";

switch($_GET[act])
{

//---- Запись цен и публикация картриджа
case save_cart_price:
$cena_z=$_POST[cena_z];
$cena_v=$_POST[cena_v];
$cena_n=$_POST[cena_n];
$cena_bu=$_POST[cena_bu];
if($_POST[publish]=="on"){$publish=1;}else{$publish=0;}
$id=$_GET[id_cart];

$cartridge->sql_query="UPDATE cartridge SET 
cena_zapravki=$cena_z,
cena_vostanovlenia=$cena_v,
cena_novogo=$cena_n,
cena_pokupki_bu=$cena_bu,
publish='$publish'
WHERE id=$id;
";
echo $cartridge->sql_query;
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$id'</script>";
}
else{echo $cartridge->sql_err;}
break;

case save_cart_param:

$type=$_POST[type];
$chip=$_POST[chip];
$color=$_POST[color];
$resurs=$_POST[resurs];
$service_manual=$_POST[service_manual];
$partnumber=$_POST[partnumber];
$id=$_GET[id_cart];

$cartridge->sql_query="UPDATE cartridge SET
type='$type',
is_chip='$chip',
color='$color',
resurs='$resurs',
service_manual='$service_manual',
partnumber='$partnumber'
WHERE id=$id";

echo $cartridge->sql_query;
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$id'</script>";
}
else{echo $cartridge->sql_err;}

break;

case save_cart_text:

$picture=$_POST[picture];
$cart_name=$_POST[cart_name];
$page_title=$_POST[page_title];
$html_title=$_POST[html_title];
$m_kwords=$_POST[m_kwords];
$m_desc=$_POST[m_desc];
$content=$_POST[content];

$id=$_GET[id_cart];

$cartridge->sql_query="UPDATE cartridge SET
name='$cart_name',
html_title='$html_title',
m_kwords='$m_kwords',
m_desc='$m_desc',
picture='$picture',
page_title='$page_title' ,
page_content='$content' 
WHERE id=$id";

echo $cartridge->sql_query;
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$id'</script>";
}
else{echo $cartridge->sql_err;}
break;

//---- Создание нового картриджа
case creat_new_cart:
$brand=$_GET[brand];

$cartridge->sql_query="insert into cartridge(id,name,brand,m_desc) values('','назови меня', $brand,'коротко опиши меня');";
$cartridge->sql_execute();
$last_id=mysql_insert_id();
echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$last_id'</script>";
break;

//---- Вывод карточки картриджа
case view_cart:
	
	$cartridge->sql_query="SELECT * FROM `cartridge` WHERE `id`='$_GET[cart_id]'";
	$cartridge->sql_execute();
	if(mysql_num_rows($cartridge->sql_res)!=0)
	{
	list($id_cart,$part_number,$cart_name,$brand,$brand_name,$html_title,$m_kwords,$m_desc,$picture,$page_title,$page_cont,$cena_z,$cena_v,$cena_n,$cena_n_bn,$cena_bu,
$color,$type,$service_manual,$resurs,$is_chip,$publish,$sort)=mysql_fetch_row($cartridge->sql_res);
	}
	$cartridge->sql_query="SELECT id,name FROM `cartridge` WHERE `brand`='$brand'";
	$cartridge->sql_execute();
	$quick_menu="";
	if(mysql_num_rows($cartridge->sql_res)!=0)
	{
		while(list($id,$name)=mysql_fetch_row($cartridge->sql_res))
		{
		if($id==$id_cart){$quick_menu.="<b><a href=\"cartridge.php?act=view_cart&cart_id=$id\">$name</a></b><br>";}
		else{$quick_menu.="<a href=\"cartridge.php?act=view_cart&cart_id=$id\">$name</a><br>";}
		}
$color_list="<select name=\"color\">";
switch($color)
{
case C: $color_t="синий"; 
$color_list.="<option value=C selected>синий</option>";
$color_list.="<option value=M>малиновый</option>";
$color_list.="<option value=Y>желтый</option>";
$color_list.="<option value=K>черный</option>";
break;

case M: $color_t="малиновий";

$color_list.="<option value=C>синий</option>";
$color_list.="<option value=M selected>малиновый</option>";
$color_list.="<option value=Y>желтый</option>";
$color_list.="<option value=K>черный</option>";
break;

case Y: 
$color_t="желтый";
$color_list.="<option value=C>синий</option>";
$color_list.="<option value=M>малиновый</option>";
$color_list.="<option value=Y selected>желтый</option>";
$color_list.="<option value=K>черный</option>";
break;

case K: 
$color_t="черный";
$color_list.="<option value=C>синий</option>";
$color_list.="<option value=M>малиновый</option>";
$color_list.="<option value=Y>желтый</option>";
$color_list.="<option value=K selected>черный</option>";
break;

default:
$color_t="черный";
$color_list.="<option value=C>синий</option>";
$color_list.="<option value=M>малиновый</option>";
$color_list.="<option value=Y>желтый</option>";
$color_list.="<option value=K selected>черный</option>";
}
$color_list.="</select>";
if($publish==1){$checked="checked=\"checked\"";}	
$type_t=$type_array[$type];	
	}
$cena_n_uah=$cena_n*$kurs_usd_nal;
$price_form="
	<form enctype='multipart/form-data' action='cartridge.php?act=save_cart_price&id_cart=$id_cart' method=post>
			<table>
				<tr><td>Заправка</td><td><input type=text size=5 name='cena_z' value=\"$cena_z\"></td></tr>
				<tr><td>Востановление</td><td><input type=text size=5 name='cena_v' value=\"$cena_v\"></td></tr>
				<tr><td>Новый</td><td><input type=text size=5 name='cena_n' value=\"$cena_n\">  $cena_n_uah грн.</td></tr>
				<tr><td>Вечный картридж</td><td><input type=text size=5 name='cena_bu' value=\"$cena_bu\"></td></tr>
				<tr><td>Публикация</td><td><input type=checkbox name='publish' $checked></td></tr>
				<tr><td><input type=submit value='Сохранить'></td><td></td></tr>
			</table>
</form>
";

$type_list="<select name=type>";
for($i=0;$i<4;$i++)
{
if($type==$i){$selected="selected";}
$type_list.="<option value=$i $selected>".$type_array[$i]."</option>";
$selected="";
}
$type_list.="</select>";

$chip_list="<select name=chip>";
for($i=0;$i<4;$i++)
{
if($is_chip==$i){$selected="selected";}
$chip_list.="<option value=$i $selected>".$chip_array[$i]."</option>";
$selected="";
}
$chip_list.="</select>";

$param_form="
	<form enctype='multipart/form-data' action='cartridge.php?act=save_cart_param&id_cart=$id_cart' method=post>
			<table>
				<tr><td>Тип</td><td>$type_list</td></tr>
				<tr><td>Цвет</td><td>$color_list</td></tr>
				<tr><td>Ресурс</td><td><input type=text size=5 name='resurs' value=\"$resurs\"></td></tr>
				<tr><td>Чип</td><td>$chip_list</td></td>
<tr><td colspan=2><a href=\"$service_manual\">Инструкция по заправке</a></td></tr>
<tr><td colspan=2><input type=text size=20 name='service_manual' id=\"ManPath\" value=\"$service_manual\">
<input type=\"button\" value=\"Добавить\" onclick=\"BrowseServer('Files:/', 'ManPath');\"></td></tr>
				<tr><td>Partnumber</td><td><input type=text size=10 name='partnumber' value=\"$part_number\"></td></tr>
				<tr><td><input type=submit value='Сохранить'></td><td></td></tr>
			</table>
</form>
";


$text_form="
	<form enctype='multipart/form-data' action='cartridge.php?act=save_cart_text&id_cart=$id_cart' method=post>
<table width=\"100%\">
<tr>
<td><img src=\"$picture\" width=\"200\" title=\"картинка\"><br><br>

<input id=\"PicPath\" name=\"picture\" type=\"text\" value=\"$picture\" size=\"27\"/>
<input type=\"button\" value=\"Найти картинку\" onclick=\"BrowseServer('Images:/', 'PicPath');\"</td>
<td valign=\"top\">
<table width=\"100%\">
<tr><td>Имя</td><td><input type=\"text\" name=\"cart_name\" value=\"$cart_name\" size=\"100\"></td></tr>
<tr><td>Загл.</td><td><input type=\"text\" name=\"page_title\" value=\"$page_title\" size=\"100\"></td></tr>
<tr><td>тэг title</td><td><input type=\"text\" name=\"html_title\" value=\"$html_title\" size=\"100\"></td></tr>
<tr><td>Ключ слова</td><td><input type=\"text\" name=\"m_kwords\" value=\"$m_kwords\" size=\"100\"></td></tr>
<tr><td>тэг описания</td><td><input type=\"text\" name=\"m_desc\" value=\"$m_desc\" size=\"100\"></td></tr>
</table>
</td>
</tr>

<tr>
<td colspan=\"2\" align=\"left\"><br>
<textarea id=\"ckeditor_\" name=\"content\" rows=\"2\" cols=\"100\">$page_cont</textarea></td>
 <script type=\"text/javascript\">
    var editor=CKEDITOR.replace( 'ckeditor' );
    CKFinder.setupCKEditor( editor,'../ckfinder/') ;
</script>

</tr>
<tr><td><input type=submit value='Сохранить'></td></tr>
</table>
</form>
";


$cartridge->sql_query="SELECT tovary.id, tovary.name, tovary_kat.name FROM `tovary`
JOIN tovary_kat ON tovary_kat.id=tovary.kat
ORDER BY tovary_kat.name ASC, tovary.name ASC";
	$cartridge->sql_execute();
	$param_list="<SELECT name='tovar'><OPTION value='0'>Выбрать материал</OPTION>";
	while(list($id, $name,$kat)=mysql_fetch_row($cartridge->sql_res))
	{
		$param_list.="<OPTION value=$id>$kat | $name</OPTION>";
	}
	$param_list.='</SELECT><br/>
            <input type="radio" name="stage_code" value="inrfl"/ checked="checked">для заправки<br/>
                <input type="radio" name="stage_code" value="inrck"/>для восстановления<br/>';


$cartridge->sql_query="SELECT id_cart,stage_code,rashodnik_id,kolvo,tovary.name,tovary_kat.name
        FROM cart_rashodka
        LEFT JOIN tovary ON tovary.id=cart_rashodka.rashodnik_id
        LEFT JOIN tovary_kat ON tovary_kat.id=tovary.kat
        WHERE id_cart=$_GET[cart_id]";
$cartridge->sql_execute();
if(!$cartridge->sql_err)
{
    while(list($id,$zorv,$tovar_id,$kolvo,$tovar_name,$kat_name)=mysql_fetch_row($cartridge->sql_res))
    {
        $params.="<tr><td>$kat_name $tovar_name</td>
        <td><input type=input name=$tovar_id value=$kolvo size=3>&nbsp;&nbsp;&nbsp
        <a href=\"cartridge.php?act=del_work_param&id_cart=$id_cart&tovar_id=$tovar_id\">X</a></tr>";
    }
}

$work_param_form="Материалы<br/><br/>
<form enctype='multipart/form-data' action='cartridge.php?act=save_work_param&id_cart=$id_cart' method=post>
    <table>
        <tr><td width=250>Наименование</td><td>кол-во</td></tr>
$params
        <tr><td><input type=submit value='Сохранить'></td><td></td></tr>
    </table>
</form><br/><br/>

<form enctype='multipart/form-data' action='cartridge.php?act=add_work_param&id_cart=$id_cart' method=post>
    <table>
       <tr><td>$param_list</td></tr>
        <tr><td><input type=submit value='Добавить'></td></tr>
    </table>
</form>
";

$to_screen="<table width=\"100%\" border=\"0\"><tr>
<td width=\"100\" align=\"left\" valign=\"top\">$quick_menu</td>
<td width=\"*\" align=\"center\" valign=\"top\"> 
<table width=\"100%\" border=\"0\" bgcolor=grey>
<tr><td colspan=\"3\" align=\"center\"  bgcolor=white><h2>$cart_name $type_t $color_t ресурс $resurs стр.</h2></td></tr>
<!--<tr>
    <td align=\"30%\" bgcolor=white>$price_form</td>
    <td align=\"30%\" bgcolor=white>$param_form</td>
    <td align=\"30%\" valign=top bgcolor=white>$work_param_form</td>
</tr>

<tr><td colspan=\"3\" bgcolor=white>$text_form</td></tr>
</td>
</tr>-->
<tr><td>
 <ul class=\"tabs\"> 
  <li><a href=\"#\">Карточка картриджа</a></li> 
  <li><a href=\"#\">Цены</a></li> 
  <li><a href=\"#\">Параметры</a></li> 
  
  </ul> 
<div class=\"panes\"> 
  <div><h2>Карточка картриджа</h2> 
  <p> 
  $text_form
  </p> 
  
  </div> 
  
  <div class=\"les\"><h2>Цены</h2> 
  <p> 
  $price_form
  </p> 
  
  </div> 
  <div class=\"les\"><h2>Параметры</h2> 
  <p> 
  $param_form
  </p> 
  
  </div> 


  </div>

</td></tr>
</table>";	

break;
case save_work_param:
    foreach ($_POST as $key=>$value)
{
    $cartridge->sql_query="UPDATE `cart_rashodka` SET `kolvo`='$value'
        where `rashodnik_id`=$key and id_cart=$_GET[id_cart];";
echo $cartridge->sql_query."<br/>";
$cartridge->sql_execute();
        

}
 echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$_GET[id_cart]'</script>";
    break;

case add_work_param:
    echo $cartridge->sql_query="insert into cart_rashodka(id_cart,stage_code,rashodnik_id,kolvo)
        value ('$_GET[id_cart]','$_POST[stage_code]','$_POST[tovar]','');";
    $cartridge->sql_execute();
    echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$_GET[id_cart]'</script>";
break;

case del_work_param:
    $cartridge->sql_query="delete from cart_rashodka
        where `rashodnik_id`=$_GET[tovar_id] and id_cart=$_GET[id_cart];";
    $cartridge->sql_execute();
    echo "<script>top.location.href = 'cartridge.php?act=view_cart&cart_id=$_GET[id_cart]'</script>";
break;


default:
// Формирование вывода каталога картриджей
$order="name";
$brand_filter=">0";
if($_GET[brand]) {$brand_filter="=".$_GET[brand];}
if($_GET[order]) {$order=$_GET[order];}


$cartridge->sql_query="SELECT cartridge.id, cartridge.name,cartridge.cena_zapravki, cartridge.cena_vostanovlenia, cartridge.cena_novogo, 
cartridge.cena_pokupki_bu, cartridge.color,cartridge.type, cartridge.service_manual, cartridge.resurs, cartridge.is_chip, cartridge.publish,
cartridge.partnumber
FROM cartridge
WHERE cartridge.brand$brand_filter ORDER BY cartridge.$order ASC";

$cartridge->sql_execute();

$cartridge_table="<table width=\"100%\" class=\"sortable\"><tr bgcolor=\"#dddddd\"><td>Название</td><td>Цена З</td><td>Цена В</td><td>Цена Н</td><td>Цвет</td>
<td>тип</td><td>partnumber</td><td>ресурс</td><td>чип</td></tr>";
while (list($id,$name,$cena_z,$cena_v,$cena_n,$cena_bu,$color,$type,$k_tonera,$resurs,$is_chip,$publish,$partnumber)=mysql_fetch_row($cartridge->sql_res))
{
switch($color)
{
case C: $bgcolor="bgcolor=\"cyan\"";break;
case M: $bgcolor="bgcolor=\"magenta\"";break;
case Y: $bgcolor="bgcolor=\"yellow\"";break;
case K: $bgcolor="bgcolor=\"black\" fontcolor=\"white\"";break;
}
switch($type)
{
case 0: $type="лазерный";break;
case 1: $type="лазерный цветной";break;
case 2: $type="струйный";break;
case 3: $type="матричный";
}

if($publish==0){$bgcolor_tr="bgcolor=\"#aaaaaa\"";}
if($publish==1){$bgcolor_tr="bgcolor=\"white\"";}

$cartridge_table.="<tr $bgcolor_tr><td $bgcolor_tr><a href=\"cartridge.php?act=view_cart&cart_id=$id\">$name</a>
 <<a href=\"javascript:void(0);\" onclick=\"window.open('http://sys.ddruk.com.ua/cartridges/item/$id', '_blank');\">Расходные материалы</a>></td><td $bgcolor_tr>$cena_z</td><td $bgcolor_tr>$cena_v</td><td $bgcolor_tr>$cena_n</td><td $bgcolor>$color</td>
<td $bgcolor_tr>$type</td><td $bgcolor_tr>$partnumber</td><td $bgcolor_tr>$resurs</td><td $bgcolor_tr>$chip_array[$is_chip]</td></tr>";
}

$cartridge_table.="<tr height=\"5\"><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><td></td></tr>";
$cartridge_table.="<tr><td><a href=\"cartridge.php?act=creat_new_cart&brand$brand_filter\">Создать новый</a></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><td></td></tr>";
$cartridge_table.="</table>";

$to_screen=$cartridge_table;
}
?>
<html>
<head><title>Каталог картриджей</title>
    <link type='text/css' href='style.css' rel='stylesheet'  />
   <script src='../js/jquery.js' type='text/javascript'></script>

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../ckfinder/ckfinder.js"></script>
<script type='text/javascript' src='../js/ir2.js'></script>
<script type='text/javascript' src='../js/tabsort2.js'></script>

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
	* { font-family: verdana; font-size: 10px; COLOR: black; }
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
<table width="100%" border="0">

<tr><td><a href="printer.php?brand<?php echo $brand_filter;?>">Каталог принтеров</a> | 
        <a href="price.php?brand<?php echo $brand_filter;?>">Прайс</a></td></tr>


<tr height="10">
<td><?php echo $brands;?></td>
</tr>
<tr>
<td><?php echo $to_screen; ?></td>
</tr>

</table>

    <script>


$(function() {

	$("ul.tabs").tabs("div.panes > div");
});
</script>
</body>
</html>
