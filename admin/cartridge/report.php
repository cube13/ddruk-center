<html>
<head><title></title></head>
<body>
<a href="/ddruk/cartridge">Главная</a> | <a href="/ddruk">Склад</a><br>
<a href="index.php?act=view_org">Организации</a> | 
<a href="index.php?act=view_raboty">Виды работ</a> | 
<a href="index.php?act=view_sotrudniki">Сотрудники</a><br>
<a href="report.php?act=view_sotrudniki">Отчеты</a></br>
<?php 
include 'conf.php';
$cartridge->sql_connect();

if($_GET[to_filter_org])  {$where_org="WHERE `org_id`=$_GET[to_filter_org]";}
$cartridge->sql_query="SELECT COUNT(id) from reestr $where_org";
$cartridge->sql_execute();
list($count_cart)=mysql_fetch_row($cartridge->sql_res);
echo "Кол-во картриджей $count_cart";

//$cur_month=date("n");
//$cur_year=date('y');
$start_day=date('U',mktime(0,0,0,$_POST[start_month],$_POST[start_day],$_POST[start_year]));
$end_day=date('U',mktime(23,59,59,$_POST[end_month],$_POST[end_day],$_POST[end_year]));

//$cartridge->sql_query="SELECT COUNT(id) from raboty WHERE id_raboty=1 AND `date` BETWEEN $sday AND $eday";
//$cartridge->sql_execute();
//list($count_cart)=mysql_fetch_row($cartridge->sql_res);
//echo "Кол-во заправок в текущем месяце $count_cart<br>";

$cartridge->sql_query="SELECT * FROM vid_rabot ORDER BY name ASC";
$cartridge->sql_execute();
$vid_rabot_spisok="<table>";
$count_vid_rabot=0;
	while(list($id, $name,$cena_raboty)=mysql_fetch_row($cartridge->sql_res))
	{
		$vid_rabot_spisok.="<tr><td>$name</td><td><input type=checkbox name=$id></td></tr>";
		$array_vid_rabot_id[$count_vid_rabot]=$id;
		$count_vid_rabot++;
	}
	$vid_rabot_spisok.="</table>";
	
$cartridge->sql_query="SELECT id,name FROM sotrudniki ORDER BY name ASC";
$cartridge->sql_execute();
$sotrudniki_spisok="<SELECT name='sotrudnik_id'>";
	while(list($id, $name)=mysql_fetch_row($cartridge->sql_res))
	{
		$sotrudniki_spisok.="<OPTION value=$id>$name</OPTION>";
	}
	$sotrudniki_spisok.="</SELECT>";
	
if($_GET[act]=="gen_report")
{	
	$filtr_rabot=" AND ("; 
	$filtr_sotrudnik=" AND id_master=$_POST[sotrudnik_id]";
	for($i=0;$i<$count_vid_rabot;$i++)
	{
		if($or_flag) $or="OR";
		if($_POST[$array_vid_rabot_id[$i]])
		{
			$filtr_rabot.="$or id_raboty=$array_vid_rabot_id[$i] ";
			$or_flag=TRUE;
		}
	}
	$filtr_rabot.=")"; 
}

echo $cartridge->sql_query="SELECT COUNT(id_raboty),vid_rabot.name FROM raboty,vid_rabot WHERE `date`
        BETWEEN $start_day AND $end_day AND vid_rabot.id = raboty.id_raboty".$filtr_sotrudnik.$filtr_rabot." GROUP BY vid_rabot.name";
$cartridge->sql_execute();

if(mysql_num_rows($cartridge->sql_res)!=0)
{
	$work_table="<table><tr><td width=300>Вид работы</td><td>кол-во</td></tr>";
	while(list($count_raboty, $vid_raboty)=mysql_fetch_row($cartridge->sql_res))
	{
		$work_table.="<tr><td>$vid_raboty</td><td>$count_raboty</td></tr>";
	}
	$work_table.="</table>";
}
?>
<br><form enctype='multipart/form-data' action='<?php echo $PHP_SELF?>?act=gen_report' method=post>
	<table>
		<tr><td valign="top" width=300><?php echo $sotrudniki_spisok;?><br>
			с&nbsp;&nbsp;&nbsp;<input type=text name=start_day size=3 value=1> 
				<select name=start_month>
					<option value=1>Январь</option>
					<option value=2>Февраль</option>
					<option value=3>Март</option>
					<option value=4>Апрель</option>
					<option value=5>Май</option>
					<option value=6>Июнь</option>
					<option value=7>Июль</option>
					<option value=8>Август</option>
					<option value=9>Сентябрь</option>
					<option value=10>Октябрь</option>
					<option value=11>Ноябрь</option>
					<option value=12>Декабрь</option>
				</select>
				<input type=text name=start_year size=5 value=2010><br>
			по&nbsp;<input type=text name=end_day size=3 value=30> 
				<select name=end_month>
					<option value=1>Январь</option>
					<option value=2>Февраль</option>
					<option value=3>Март</option>
					<option value=4>Апрель</option>
					<option value=5>Май</option>
					<option value=6>Июнь</option>
					<option value=7>Июль</option>
					<option value=8>Август</option>
					<option value=9>Сентябрь</option>
					<option value=10>Октябрь</option>
					<option value=11>Ноябрь</option>
					<option value=12>Декабрь</option>
				</select>
				<input type=text name=end_year size=5 value=2010><br>
			 <?php echo $vid_rabot_spisok;?></td>
			 <td valign=top><?php echo $work_table;?></td></tr>
	</table>
	<input type=submit value='Отчет'>
</form>

</body>
</html>
