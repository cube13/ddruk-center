<?php
session_start();
session_set_cookie_params(10800);
session_register($user_name, $user_id);

include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();


 if(!$_SESSION[user_id])

        {
            $redirect='<meta http-equiv="refresh" content="0; url=/index.php">';

        }
 if($_SESSION[user_id])
 {
   include '../user_menu.php';
switch($_GET[act])
{
//--Раздел работы с клиентами
//----Форма добавления клиента
/*    case org_form:
        $refhesh=0;
        if($_GET[org_id])
        {
            $act="org_save"; $zaglav="радактирование";
            $cartridge->sql_query="select * from org where id=$_GET[org_id]";
            $cartridge->sql_execute();
            list($id,$f_name,$s_name,$adres,$adres2,$tel,$mob_tel,$mail,$edrpou,$ipn,$svid_pdv,$direktor,$zametki)=mysql_fetch_row($cartridge->sql_res);
        }
        else { $act="org_add";$zaglav="добавление";}
        
        $org_form="
        <form enctype='multipart/form-data' action='$PHP_SELF?act=$act&org_id=$id' method=post>
            <table>
		<tr><td>Полное название</td><td><input type=text size=50 name='full_name' value='$f_name'></td></tr>
                <tr><td>Название коротко</td><td><input type=text size=50 name='short_name' value='$s_name'></td></tr>
		<tr><td>Адрес</td><td><input type=text size=50 name='adres' value='$adres'></td></tr>
                <tr><td>Адрес</td><td><input type=text size=50 name='adres2' value='$adres2'></td></tr>
		<tr><td>Телефон</td><td><input type=text size=50 name='tel' value='$tel'></td></tr>
		<tr><td>Мобильный тел</td><td><input type=text size=50 name='mob_tel' value='$mob_tel'></td></tr>
		<tr><td>мейл</td><td><input type=text size=50 name='mail' value='$mail'></td></tr>
		<tr><td>ЕДРПОУ</td><td><input type=text size=50 name='edrpou' value='$edrpou'></td></tr>
                <tr><td>ИНН</td><td><input type=text size=50 name='ipn' value='$ipn'></td></tr>
                <tr><td>№ свед.НДС</td><td><input type=text size=50 name='svid_pdv' value='$svid_pdv'></td></tr>
                <tr><td>Директор</td><td><input type=text size=50 name='direktor' value='$direktor'></td></tr>
                <tr><td>Заметки</td><td><textarea name='zametki'>$zametki</textarea></td></tr>
                <tr><td><input type=submit value='Записать'></td><td></td></tr>
            </table>
	</form>
	";
$to_screen=$zaglav.$org_form;

break;
//----Запись клиента в базу
case org_add:
    $refhesh=0;
	$cartridge->sql_query="INSERT INTO org
        (id,full_name,short_name,adres,adres2,tel,mob_tel,mail,edrpou,ipn,svid_pdv,direktor,zametki) values
	('','".$_POST[full_name]."','".$_POST[short_name]."','".$_POST[adres]."','".$_POST[adres2]."',
            '".$_POST[tel]."','".$_POST[mob_tel]."','".$_POST[mail]."','".$_POST[edrpou]."',
            '".$_POST[ipn]."','".$_POST[svid_pdv]."','".$_POST[direktor]."','".$_POST[zametki]."')";
	$cartridge->sql_execute();
    //echo $cartridge->sql_query;
        echo "<script>top.location.href = 'index.php?act=view_org'</script>";
break;
case org_save:
    $refhesh=0;
	$cartridge->sql_query="update org set
        full_name='$_POST[full_name]',
        short_name='$_POST[short_name]',
        adres='$_POST[adres]',
        adres2='$_POST[adres2]',
        tel='$_POST[tel]',
        mob_tel='$_POST[mob_tel]',
        mail='$_POST[mail]',
        edrpou='$_POST[edrpou]',
        ipn='$_POST[ipn]',
        svid_pdv='$_POST[svid_pdv]',
        direktor='$_POST[direktor]',
        zametki='$_POST[zametki]'
        WHERE id='$_GET[org_id]'";
	$cartridge->sql_execute();
    //echo $cartridge->sql_query;
        echo "<script>top.location.href = 'index.php?act=org_form&org_id=$_GET[org_id]'</script>";
break;

 */

//--Раздел работы с картриджами
//----Форма добвления картриджа в базу
case cartridge_add_form:
    $refhesh=0;
$cartridge->sql_query="select id, name from brands order by name asc";
    $cartridge->sql_execute();
    $brand_table="<table>";
    while(list($id,$name)=mysql_fetch_row($cartridge->sql_res))
    {
        $brand_table.="<tr><td><a href=\"$PHP_SELF?act=cartridge_add_form&to_filter_brand=$id\">$name</a></td></tr>";
    }
    $brand_table.="</table>";


    if ($_GET[to_filter_org]){$filter_org="WHERE id=".$_GET[to_filter_org];}
	$cartridge->sql_query="SELECT id,short_name FROM org $filter_org ORDER BY short_name ASC";
        $cartridge->sql_execute();

        $org_spisok="<SELECT  name='org_id'>";
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$org_spisok.="<OPTION value=$id>$name</OPTION>";
	}
	$org_spisok.="</SELECT>";

        
        if ($_GET[to_filter_brand]){$filter="WHERE brand=".$_GET[to_filter_brand];}
	$cartridge->sql_query="SELECT id,name FROM cartridge $filter ORDER BY name ASC";
        $cartridge->sql_execute();
        
        $cart_spisok="<SELECT  name='cart_id'>";
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$cart_spisok.="<OPTION value=$id>$name</OPTION>";
	}
	$cart_spisok.="</SELECT>";
        
        if ($_GET[not_uniq_num]){echo "Этот номер уже занят";}

        $cart_form="<form enctype='multipart/form-data' action='$PHP_SELF?act=cartridge_add&to_filter_brand=$_GET[to_filter_brand]' method=post>
            <table>
                <tr><td>Номер</td><td><input type=text size=30 name='number' value=\"$_POST[number]\"></td></tr>
		<tr><td>Наименование</td><td>$cart_spisok</td></tr>
		<tr><td>Клиент</td><td>$org_spisok</td></tr>
		<tr><td><input type=submit value='Записать'></td><td></td></tr>
            </table>
	</form>";
        $to_screen="<table><tr><td width=\"500\" valign=top>$cart_form</td><td>$brand_table</td></tr></table>";

break;
//----Внесения картриджа в базу
case cartridge_add:
    $refhesh=0;
if(!$_POST[number]){echo "Введите номер";}
    $cartridge->sql_query="SELECT brands.name, cartridge.name
        FROM cartridge
        LEFT JOIN brands ON cartridge.brand=brands.id WHERE cartridge.id=$_POST[cart_id]";
    $cartridge->sql_execute();
    list($brand,$name)=mysql_fetch_row($cartridge->sql_res);

	$cartridge->sql_query="SELECT id FROM reestr WHERE uniq_num='".$_POST[number]."'";
	$cartridge->sql_execute();

	if (mysql_num_rows($cartridge->sql_res))
        {
            echo "Номер занят";
        }
	else 
	{
		 $cartridge->sql_query="INSERT INTO reestr(id,name,name_id,uniq_num,org_id) values
		('','$brand $name','$_POST[cart_id]','$_POST[number]','$_POST[org_id]')";
		$cartridge->sql_execute();

	}
	break;
	

//----Внесение записи работы по картриджу
case raboty_add:
    $refhesh=0;
$date_a=explode('.',$_POST[date]);
$date=mktime(17,0,0,$date_a[1],$date_a[0],$date_a[2]);

$cartridge->sql_query="INSERT INTO raboty (`id`,`cartridge_num`,`id_raboty`,`id_master`,`date`,
        `opysanie`,`material`,`kolvo`,`from_to_id`,`cena_raboty`) values
('','$_GET[cart_num]','$_GET[zorv]','8','$date','$_POST[zametki]','$_GET[tovar]','$_POST[kol_vo]','','')";
echo $cartridge->sql_query;
$cartridge->sql_execute();

echo $cartridge->sql_query="update reestr set last_date=$date where uniq_num='$_GET[cart_num]'";
$cartridge->sql_execute();

$kolvo_tovar=$_POST[kol_vo]*-1;

echo $cartridge->sql_query="insert into jurnal(`id`,`date`,`id_tovar`,`kolvo`,`rashod_prihod`,`kto_id`,`komu_id`)
values('',$date,$_GET[tovar],$kolvo_tovar,'0',0,0)";
$cartridge->sql_execute();
echo "<script>top.location.href = '$PHP_SELF?act=view_cart&cartridge_num=$_GET[cart_num]'</script>";

break;



//---- Вывод списка работ по картриджу
case view_cart:
    $refhesh=0;

	$cartridge->sql_query="SELECT * FROM vid_rabot ORDER BY name ASC";
$cartridge->sql_execute();
$vid_rabot_spisok="";
	while(list($id, $name,$cena_raboty)=mysql_fetch_row($cartridge->sql_res))
	{
		$vid_rabot_spisok.="<a href=$PHP_SELF??act=rabota_add_form&
            number='$_GET[cartridge_num]'&vid_raboty=$id>$name</a>";
	}
	
	
	
	$cartridge->sql_query="SELECT `uniq_num`, `name`, `short_name`,`name_id` FROM `reestr`
                LEFT JOIN org ON org.id=reestr.org_id
                WHERE `uniq_num`='$_GET[cartridge_num]'";
        
	$cartridge->sql_execute();
	if(mysql_num_rows($cartridge->sql_res)!=0)
	{
            list($cart_num, $cartridge_name, $org_name,$name_id)=mysql_fetch_row($cartridge->sql_res);
            $cartridge_num_t="<br>Картридж $cartridge_name номер
            <a href=\"$PHP_SELF?act=admin_cart&cart_num=$cart_num\">$cart_num</a> (владелец $org_name)<br/><br/>
                ";

            $cartridge->sql_query="SELECT z_or_v, rashodnik_id,	kolvo,tovary.name,kat.name,kat.id,tovary.edinicy
                    FROM cart_rashodka
                LEFT JOIN tovary ON rashodnik_id=tovary.id
                LEFT JOIN kat ON tovary.kat=kat.id
                WHERE id_cart=$name_id";
            $cartridge->sql_execute();
            $date_t=date("d.m.Y"); $calnum=0;


	}
	
	$cartridge->sql_query="SELECT raboty.cartridge_num, vid_rabot.name, sotrudniki.name, 
                `date`, opysanie,tovary.name,raboty.kolvo,tovary.edinicy,kat.name
                FROM raboty
                LEFT JOIN vid_rabot ON raboty.id_raboty=vid_rabot.id
                LEFT JOIN sotrudniki ON raboty.id_master=sotrudniki.id
                LEFT JOIN tovary ON raboty.material=tovary.id
                 LEFT JOIN kat ON tovary.kat=kat.id
        WHERE raboty.cartridge_num='$_GET[cartridge_num]'
        ORDER BY `date` DESC";
	$cartridge->sql_execute();

	while(list($cartridge_num, $vid_raboty, $sotrudnik_name, $date, $opysanie,$material,$kolvo,$edinicy,$kat_name)=mysql_fetch_row($cartridge->sql_res))
	{
		
		$cartridge_view_tr.="<tr><td>".date('d.m.Y',$date)."</td><td>$vid_raboty</td>
                        <td>$kat_name - $material - $kolvo $edinicy</td><td>$sotrudnik_name</td>
                        <td>$opysanie</td></tr>";
 		
	}
	$cartridge_view="";
	$cartridge_view.="<table><tr bgcolor=\"#dddddd\"><td width=100>Дата</td>
            <td width=200>Вид работы</td>
            <td width=200>материалы</td>
            <td width=150>Кто</td>
            <td width=200>Заметки</td></tr>";
	$cartridge_view.=$cartridge_view_tr;
	$cartridge_view.="</table>";

        $cartridge_view.="<div>$work_list</div>";


	// НОВЫЙ ВЫВОД
       $cartridge->sql_query="SELECT cartridge_proces.id,`work_fact`,sotrudniki.name,`date`
        FROM `cartridge_proces`
                JOIN sotrudniki ON cartridge_proces.master_id=sotrudniki.id
        WHERE cart_num='$_GET[cartridge_num]'";
    $cartridge->sql_execute();

	while(list($id_proces, $vid_raboty_id, $master_id, $date)=mysql_fetch_row($cartridge->sql_res))
	{
               $materialy=new cls_mysql();
                $materialy->sql_connect();
               $materialy->sql_query="SELECT tovary.name, jurnal.kolvo, tovary.edinicy,kat.name FROM jurnal
                    JOIN tovary ON jurnal.id_tovar=tovary.id
                       JOIN kat ON tovary.kat=kat.id
                    WHERE jurnal.komu_id=$id_proces";
                $materialy->sql_execute();
                $tovary="";
           while(list($tovar, $kolvo, $edinicy,$kat_name)=mysql_fetch_row($materialy->sql_res))
           {
               $kolvo=$kolvo*-1;
                $tovary.="$kat_name $tovar - $kolvo $edinicy<br>";
           }
		$new_view_tr.="<tr><td valign=top>".date('d.m.Y',$date)."</td>
                        <td valign=top>$work_plan[$vid_raboty_id]</td>
                        <td valign=top>$tovary</td><td valign=top>$master_id</td>
                        </tr>";
                
             
                
            

        }

	$new_view.="<table><tr bgcolor=\"#dddddd\"><td width=100>Дата</td>
            <td width=200>Вид работы</td>
            <td width=200>материалы</td>
            <td width=150>Кто</td>
            <td width=200>Заметки</td></tr>";
	$new_view.=$new_view_tr;
	$new_view.="</table>";



$to_screen="
        
  <div><h2>Новый вывод</h2>
  ".$cartridge_num_t."<br>".$new_view."

  </div><br><br><br>

  <div class=\"les\"><h2>Старый вывод</h2>
  ".$cartridge_num_t."<br>".$cartridge_view."
  </div>
 ";
break;

case admin_cart:
    $refhesh=0;
    $cartridge->sql_query="SELECT id,name FROM cartridge ORDER BY name ASC";
        $cartridge->sql_execute();

        $cart_spisok="<SELECT  name='cart_id'><OPTION value=0>---------------------</OPTION>";
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$cart_spisok.="<OPTION value=$id>$name</OPTION>";
	}
	$cart_spisok.="</SELECT>";

    $cartridge->sql_query="SELECT id,short_name FROM org ORDER BY short_name ASC";
        $cartridge->sql_execute();

        $org_spisok="<SELECT name='org_id'><OPTION value=0>---------------------</OPTION>";
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$org_spisok.="<OPTION value=$id>$name</OPTION>";
	}
	$org_spisok.="</SELECT>";


    $cartridge->sql_query="SELECT reestr.id,reestr.name,reestr.uniq_num,org.short_name
        FROM reestr
        LEFT JOIN org ON reestr.org_id=org.id
        WHERE reestr.uniq_num='$_GET[cart_num]'";
    $cartridge->sql_execute();
    if(!$cartridge->sql_err)
    {
        list($id,$cart_name,$cart_num,$org_name)=mysql_fetch_row($cartridge->sql_res);
    }
    $to_screen="
    <table>
    <tr><td width=\"100\">Картридж</td><td>$cart_name</td><td>
    <form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=cart_name_change&cart_num=$cart_num\" method=post>
		$cart_spisok<input type=submit value='Изменить'>
		</form>
    </td></tr>
    <tr><td>Номер</td><td>$cart_num</td><td></td></tr>
    <tr><td>Владелец</td><td>$org_name</td><td>
    <form enctype=\"multipart/form-data\" action=\"$PHP_SELF?act=cart_org_change&cart_num=$cart_num\" method=post>
		$org_spisok<input type=submit value='Изменить'>
		</form>
    </td></tr>";

    break;

case cart_name_change:
    $refhesh=0;
     $cartridge->sql_query="SELECT brands.name, cartridge.name
        FROM cartridge
        LEFT JOIN brands ON cartridge.brand=brands.id WHERE cartridge.id=$_POST[cart_id]";
    $cartridge->sql_execute();
    list($brand,$name)=mysql_fetch_row($cartridge->sql_res);


    $cartridge->sql_query="UPDATE reestr SET name_id='$_POST[cart_id]',name='$brand $name' WHERE uniq_num='$_GET[cart_num]'";
    $cartridge->sql_execute();
     echo "<script>top.location.href = '$PHP_SELF?act=admin_cart&cart_num=$_GET[cart_num]'</script>";

break;

case cart_org_change:
    $refhesh=0;
    $cartridge->sql_query="UPDATE reestr SET org_id='$_POST[org_id]' WHERE uniq_num='$_GET[cart_num]'";
    $cartridge->sql_execute();
    echo "<script>top.location.href = '$PHP_SELF?act=admin_cart&cart_num=$_GET[cart_num]'</script>";
break;


// Формирование вывода списка клиентов (организаций и частных лиц)
/*case view_org:
    $refhesh=0;
    $cartridge->sql_query="SELECT id,short_name,adres,tel,zametki FROM org ORDER BY short_name ASC";
$cartridge->sql_execute();
$org_table="<a href=\"$PHP_SELF?act=org_form\">Добавить</a><table width=\"100%\"><tr bgcolor=\"#dddddd\">
    <td></td>
    <td width=\"\">наименование</td>
    <td width=\"\">адрес</td>
    <td width=\"\">телефон</td>
    <td width=\"\">заметки</td>
    <td></td>
    </tr>";
while (list($id,$short_name,$adres,$tel,$zametki)=mysql_fetch_row($cartridge->sql_res))
{
    $i++;

    if($color=="#ffffff") $color="#eeeeee";
    else $color="#ffffff";
	$org_table.="<tr bgcolor='$color'>
    <td>$i</td>
    <td width=\"\"><a href=\"index.php?act=view_org\">$short_name</a></td>
    <td width=\"\">$adres</td>
    <td width=\"\">$tel</td>
    <td width=\"\">$zametki</td>
    <td><a href=\"index.php?act=org_form&org_id=$id\">ред.</a></td></tr>";
}
$org_table.="</table>";
$to_screen=$org_table;
    break;
*/
case view_reestr:
    $refhesh=0;
// Формирование вывода рестра картридже

$poisk="<form id=\"myForm\">
    Номер: <input id=\"cartridge_num\" type=\"text\" size=\"20\">
    <input type=\"submit\" value=\"Поиск\">
    </form> <a href=\"$PHP_SELF?act=cartridge_add_form\">Ввести новый</a>";

    $cartridge_table="<div id=\"content\"></div>
    <script>
        $(document).ready(function(){

            $('#myForm').submit(function(){
                $.ajax({
                    type: \"GET\",
                    url: \"get_reestr.php\",
                    data: \"q=\"+$(\"#cartridge_num\").val(),
                    success: function(html){
                        $(\"#content\").html(html);
                    }
                });
                return false;
            });

        });
      

    </script> ";
    $to_screen=$poisk.$cartridge_table;
break;

case add_to_work:
    $refhesh=0;

$cartridge->sql_query="INSERT INTO cartridge_proces
        (master_id,date,num_of_receipt,client_name,client_mob_tel,client_bonus_cart,client_adres,
        cart_num,work_plan,priority,coment)
        values";
$flag=0;$i=0;$count=1; $date=date('U');
    foreach ($_POST as $key=>$value)
{
    
    if($i<=4){$values[$i]=$value;}
    if($i==4 || $next==4){$next=0; $flag=1;}
    if($flag==1&&$i>=5)
    {
        $cartridge->sql_query.="('8','$date','$values[0]','$values[1]','$values[2]','$values[3]','$values[4]',";
        $flag=2;
        
    }
    if($flag==2)
    {   if($value==""){$value="";}
        $cartridge->sql_query.="'$value'";
        if($next<=2)
            {
                $cartridge->sql_query.=",";
            }
        $next++;
    }
    if($next==4)
        {
        $cartridge->sql_query.=")";
        if($count<$_GET[end]){$cartridge->sql_query.=",";}
        if($count==$_GET[end]){$cartridge->sql_query.=";";}
        $count++;

        }

$i++;
}
echo $cartridge->sql_query;
$cartridge->sql_execute();
$cartridge->sql_query="DELETE FROM cartridge_proces WHERE cart_num=''";
$cartridge->sql_execute();

echo "<script>top.location.href = 'index.php'</script>";
break;
case update_cartridge_proces:
    echo $cartridge->sql_query="UPDATE cartridge_proces SET
        work_plan=$_POST[workplan_0],
        coment='$_POST[coment_0]',
        priority='$_POST[priority_0]',
        status=1
        WHERE id=$_GET[id]";
    $cartridge->sql_execute();
echo "<script>top.location.href = 'index.php'</script>";

case incoming_form:
    
    $n_of_cart=$_GET[n_of_cart]+1;
    $cart_of_n=$_GET[n_of_cart]-1;
$act="act=add_to_work";
    if($_GET[id])
    {
         $cartridge->sql_query="SELECT num_of_receipt,client_name,client_mob_tel,
             client_bonus_cart,client_adres,cart_num,coment
             FROM cartridge_proces
        WHERE cartridge_proces.id=$_GET[id]
        LIMIT 1";

      $cartridge->sql_execute();
      list($num_of_receipt,$client_name,$client_mob_tel,$client_bonus_cart,$client_adres,$cartnum[0],$coment[0])=mysql_fetch_row($cartridge->sql_res);
$act="act=update_cartridge_proces&id=$_GET[id]";
    }
     $incoming_form="<form enctype='multipart/form-data' action='$PHP_SELF?$act&end=$_GET[n_of_cart]' method=post>
    <b>Клиент</b>
            <table>
                <tr><td colspan=\"2\" align=center>Квитанция № <input type=text size=10 name='num_of_receipt' value='$num_of_receipt'></td></tr>
		<tr><td>Имя</td><td><input type=text size=50 name='client_name' value='$client_name'></td></tr>
		<tr><td>Мобильный тел</td><td><input type=text size=50 name='client_mob_tel' value='$client_mob_tel'></td></tr>
		<tr><td>№ Бонусной карты</td><td><input type=text size=50 name='client_bonus_cart' value='4405885814435696'></td></tr>
		<tr><td>Адрес доставки</td><td><input type=text size=50 name='client_adres' value='$client_adres'></td></tr>
            </table>
            <br><br><b>Картридж</b>
    <a href=\"$PHP_SELF?act=incoming_form&n_of_cart=$n_of_cart\">+</a> <a href=\"$PHP_SELF?act=incoming_form&n_of_cart=$cart_of_n\">-</a>
            <table>
		
		<tr><td>Номер</td><td>Что делать</td><td>Приоритет(0-9)</td><td>Заметки</td></tr>
                <tr><td><input type=text size=10 name='cartnum_0' value='$cartnum[0]'></td>
                    <td><SELECT name=\"workplan_0\"><OPTION value=\"1\">заправка</OPTION>
                            <OPTION value=\"2\">востановление</OPTION>
                            <OPTION value=\"0\">чистка</OPTION></SELECT></td>
                    <td><input type=text size=2 name='priority_0' value='1'></td>
   <td><input type=text size=50 name='coment_0' value='$coment[0]'></td>
     </tr>";
    if($_GET[n_of_cart])
    {
        for($i=1;$i<$_GET[n_of_cart];$i++)
        {
            $n_of_cart=$_GET[n_of_cart]+1;
            $incoming_form.="<tr><td><input type=text size=10 name='cartnum_$i' value=''></td>
                    <td><SELECT name=\"workplan_$i\"><OPTION value=\"1\">$work_plan[1]</OPTION>
                            <OPTION value=\"2\">$work_plan[2]</OPTION>
                            <OPTION value=\"0\">$work_plan[0]</OPTION></SELECT></td>
                    <td><input type=text size=2 name='priority_$i' value='1'></td>
            <td><input type=text size=50 name='coment_$i' value=''></td>
            </td></tr>";
        }
    }
    $incoming_form.="
            <tr><td><input type=submit value='Записать'></td><td></td></tr> </table><br>
            
	</form>
	";
$to_screen=$incoming_form;

    break;

    case change_fact_work:
        
        $cartridge->sql_query="UPDATE cartridge_proces SET
                work_fact=$_GET[work_fact]
               WHERE id='$_GET[id]'";
          $cartridge->sql_execute();
          echo "<script>top.location.href = 'http://ddruk/cartridge/'</script>";
break;
    case cartridge_done:
     echo $cartridge->sql_query="UPDATE cartridge_proces SET
                status=$_GET[status]
               WHERE id='$_GET[id]'";
          $cartridge->sql_execute();
          echo "<script>top.location.href = 'http://ddruk/cartridge/'</script>";
        break;

    case kvitanc_done:
     echo $cartridge->sql_query="UPDATE cartridge_proces SET
                status=$_GET[status]
               WHERE num_of_receipt='$_GET[num_of_receipt]'
            AND status=3";
          $cartridge->sql_execute();
          echo "<script>top.location.href = 'http://ddruk/cartridge/'</script>";
        break;


default:
   
}
 }


?>
<html>
<head><title></title>
      <link type='text/css' href='style.css' rel='stylesheet'  />
  <script type="text/javascript" src="../js/jquery-1.6.4.js"></script>
<?php // if($refhesh) echo '<meta http-equiv="refresh" content="180; url=http://ddruk/cartridge">';?>
<style>
	* { font-family: verdana; font-size: 15px	; COLOR: black; }
	
	table { height:5; border: 0px solid gray;}
	td { padding: 0;}


	</style>


    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="../js/jquery-1.6.4.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script>
      jQuery(function($){
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: '&#x3c;Пред',
		nextText: 'След&#x3e;',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Не',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
                showButtonPanel: true,
                gotoCurrent: true,
		yearSuffix: ''};

	$.datepicker.setDefaults($.datepicker.regional['ru']);
});
  $(document).ready(function() {
    $("#cal1").datepicker();
    $("#cal2").datepicker();
    $("#cal3").datepicker();
    $("#cal4").datepicker();
    $("#cal5").datepicker();
    $("#cal6").datepicker();
    $("#cal7").datepicker();
    $("#cal8").datepicker();
$("#cal9").datepicker();

});

  </script>

  <script>
       function show()  
        {  
            $.ajax({  
                url: "get_done.php",  
                cache: false,  
                success: function(html){  
                    $("#done_cart").html(html);  
                }  
            });

            $.ajax({
                url: "get_work_in.php",
                cache: false,
                success: function(html){
                    $("#incoming").html(html);
                }
            });

             $.ajax({
                url: "get_master_done.php",
                cache: false,
                success: function(html){
                    $("#master_done").html(html);
                }
            });
        }  
      
        $(document).ready(function(){  
            show();  
            setInterval('show()',20000);
        });  
        
    </script>


</head>
<body>
    <?php echo $user_menu;?>
<a href="index.php?act=view_reestr">Поиск картриджей</a>
        <br/>
<table width="100%" border=->
    <tr align="left" valign="top"><td><?php echo $to_screen;?></td></tr>
    <tr align="left" valign="top">
	<td width="*">
<table align=center valign=top border=0 width=99%>
    <tr>
        <td valign=top width=40% align=center>Входящие/В работу
           <div id="incoming"></div></td>
        <td valign=top width=* align=center>Готовые/Надо проверить <div id="master_done"></div><?php //echo $done;?></td></tr>
<tr><td><br><div id="done_cart"></div></td></tr>
        <tr>
            <td valign=top align=center colspan=2><br><?php echo $welldone;?></td>
        </tr>
</table>
		</td>
		
		
	</tr>
        
</table>


</body>
</html>
