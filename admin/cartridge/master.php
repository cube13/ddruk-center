<?php
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();
$MASTER_ID=8;
$date=date('U');
$work_plan=array('Чистка','Заправка','Восстановление');

switch($_GET[act])
{
    case raboty_add:
   /*     $cartridge->sql_query="SELECT id FROM cartridge_proces
                               WHERE cart_num='$_GET[cart_num]' and status=2
                                ORDER BY date DESC LIMIT 1;";
        $cartridge->sql_execute();
        list($last_update_id)=mysql_fetch_row($cartridge->sql_res);
*/
         $last_update_id=$_GET[proces_id];
$work_count=0;
        foreach ($_POST as $key=>$value)
        {
        if($value=="on")
            {

$kolvo_tovar=$_GET[$key]*-1;

echo $cartridge->sql_query="insert into jurnal(`id`,`date`,`id_tovar`,`kolvo`,`rashod_prihod`,`kto_id`,`komu_id`)
values('',$date,$key,$kolvo_tovar,'0',0,$last_update_id)";
$cartridge->sql_execute();

$work_count++;
            }
        }
if($work_count>1)
{
    echo $cartridge->sql_query="UPDATE cartridge_proces SET
                work_fact=2, status=2, date=$date
               WHERE id='$_GET[proces_id]'";
    echo "<br>";
          $cartridge->sql_execute();
}
if($work_count<=1)
{
    echo $cartridge->sql_query="UPDATE cartridge_proces SET
                work_fact=1, status=2, date=$date
               WHERE id='$_GET[proces_id]'";
    echo "<br>";
          $cartridge->sql_execute();
}

    echo "<script>top.location.href = 'http://ddruk/cartridge/master.php'</script>";
        break;

 default:
     $work_limit=30;
     $cartridge->sql_query="SELECT work_plan,cart_num,reestr.name,coment,cartridge.id,cartridge_proces.id
        FROM cartridge_proces
        JOIN reestr ON cart_num=reestr.uniq_num
        JOIN cartridge ON reestr.name_id=cartridge.id
        WHERE cartridge_proces.status=1
        ORDER BY priority ASC
        LIMIT $work_limit;";

    
    $cartridge->sql_execute();
    
    $td=0;$count=0;
    $td_max=4;
    while(list($work_plan_i,$cart_num,$cart_name,$coment,$cart_id,$proces_id)=mysql_fetch_row($cartridge->sql_res))
    {
        $cart_array[cart_name][$count]=$cart_name;
        $cart_array[cart_num][$count]=$cart_num;
        $cart_array[work_plan][$count]=$work_plan[$work_plan_i];
        $cart_array[work_plan_i][$count]=$work_plan_i;
        $cart_array[coment][$count]=$coment;
        $cart_array[cart_id][$count]=$cart_id;
        $cart_array[proces_id][$count]=$proces_id;
        $count++;
        
    }
     $incoming="<table border=0>";
     for($i=0;$i<$count;$i++)
     {$doza="";
         $cartridge->sql_query="SELECT rashodnik_id,kolvo,tovary.name,kat.name,kat.id,tovary.edinicy
                FROM cart_rashodka LEFT JOIN tovary ON rashodnik_id=tovary.id LEFT JOIN kat ON tovary.kat=kat.id
                WHERE id_cart=".$cart_array[cart_id][$i]."
                    ORDER BY kat.id ASC";
            $cartridge->sql_execute();
            $work_list1="";$get="";
            while(list($rashodnik_id,$kolvo,$rashodnik_name,$kat_name,$kat_id,$edinicy)=mysql_fetch_row($cartridge->sql_res))
            {
                if($kat_id==2)
                {
                    $checked="";$class="";
                echo $work_plan_i;
                if($cart_array[work_plan_i][$i]==1)
                {
                    $checked="checked=checked";
                    $class="bold";
                }
                $work_list1.="<tr><td><input type=checkbox $checked name=$rashodnik_id></td><td class='$class'>Заправка</td></tr>\n";

                $doza="$kat_name $rashodnik_name - $kolvo $edinicy";
                $get.="&$rashodnik_id=$kolvo";
                }
                else
                {$work_list1.="<tr><td><input type=checkbox name=$rashodnik_id></td><td>$kat_name $rashodnik_name</td>\n";

                $get.="&$rashodnik_id=$kolvo";
                }
            }
        $work_list="<table>
   <form enctype='multipart/form-data'
            action='$PHP_SELF?act=raboty_add&proces_id=".$cart_array[proces_id][$i]."&cart_num=".$cart_array[cart_num][$i]."&work_plan=".$cart_array[work_plan_i][$i]."$get' method=post>".$work_list1;

       $work_list.="<tr><td colspan=2><input type=submit value='Готово'></form>\n</td></tr></table>";

        if($td==0)$incoming.="<tr>";
        if($td<$td_max)
        {
            $incoming.="<td width=250 valign='top' align='center' class=cart_block>
                <div class=cart_name>".$cart_array[cart_num][$i]."  ".$cart_array[cart_name][$i]."</div>\n
            <div class=doza>".$doza."</div>\n<br>";
            if($cart_array[work_plan_i][$i]==2)
                {
                $incoming.="<div class='atention'>".$cart_array[work_plan][$i]."</div>";
            }

            if($cart_array[coment][$i])
            {
                $incoming.="<div class='atention'>".$cart_array[coment][$i]."</div>";
            }
               $incoming.=$work_list."</td>\n";
            $td++;

        }
        if($td==$td_max){$incoming.="</tr>";$td=0;}
     }
     $incoming.="</table>";

     $cartridge->sql_query="SELECT COUNT(id)
        FROM cartridge_proces
        WHERE cartridge_proces.status=1";

    $cartridge->sql_execute();
    list($count_to_work)=mysql_fetch_row($cartridge->sql_res);
    if($count_to_work>$work_limit)
    {
        $inturn=$count_to_work-$work_limit;

    $to_work="Еще $inturn в очереди";
    }
    $to_screen=$incoming."<br>".$to_work;

}
    


?>
<html>
<head><title></title>
 <meta http-equiv="refresh" content="180; url=http://ddruk/cartridge/master.php">
 

<style>
	* { font-family: verdana; font-size: 11	; COLOR: black; }
            
	table { height:5; border: 0px solid gray;}
	td {  padding: 0;}
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
    <br>
<table width="100%" border=0>
    <tr align="left" valign="top">
	<td width="*">
			<?php echo $to_screen;?>
		</td>


	</tr>
</table>

</body>
</html>
