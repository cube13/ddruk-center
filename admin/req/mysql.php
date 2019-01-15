<?
class cls_mysql 
{
	var $sql_login="root";
	var $sql_pass="Baron_13";
	//var $sql_database="ddruk";
        var $sql_database="systema";
	var $sql_host="localhost";
	var $conn_id;
	var $sql_query;
	var $sql_err;
	var $sql_res;
	
	function sql_connect() 
	{
		$this->conn_id=mysql_connect($this->sql_host,$this->sql_login,$this->sql_pass);
		mysql_select_db($this->sql_database);
		return(0);
	}
	
	function sql_execute()
	{
		$this->sql_res=mysql_query($this->sql_query,$this->conn_id);
		$this->sql_err=mysql_error();
//echo "<br><div style='font-size:12px;'>->".$this->sql_query;
//echo "<br></div>".mysql_error();
		return(0);
	}
	
	function sql_close()
	{
		mysql_close($this->conn_id);
		return(0);
	}

        function view_day_spisanie($day, $month, $year)
{
 //   private spisanie_table;

$date_s=mktime(0, 0, 1, $month, $day, $year);
$date_e=mktime(23, 59, 59, $month, $day, $year);

$this->sql_query="SELECT SUM(kolvo), id_tovar, tovary.name, edinicy, tovary_kat.name
FROM jurnal
JOIN tovary ON tovary.id=id_tovar
JOIN tovary_kat ON tovary.kat=tovary_kat.id
WHERE (`date` between $date_s AND $date_e) AND rashod_prihod='0'
GROUP BY tovary.id
ORDER BY tovary_kat.name ASC, tovary.name ASC";
echo "<br>".$sklad->sql_query;
$this->sql_execute();
$spisanie_table="<table width=\"100%\"><tr bgcolor=\"#dddddd\"><td width=\"75%\">Наименование</td><td>списано</td></tr>";
while (list($sum,$tovar_id,$tovar_name,$edinicy, $kat_name)=mysql_fetch_row($this->sql_res))
{

	$spisanie_table.="<tr $row_bgcolor><td> $kat_name $tovar_name</td><td>$sum $edinicy</td></tr>";

}
$spisanie_table.="</table>";
return $spisanie_table;
}

 function view_period_spisanie($days, $months, $years,$daye, $monthe, $yeare)
{
 //   private spisanie_table;

$date_s=mktime(0, 0, 1, $months, $days, $years);
$date_e=mktime(23, 59, 59, $monthe, $daye, $yeare);

$this->sql_query="SELECT SUM(kolvo), id_tovar, tovary.name, edinicy, tovary_kat.name
FROM jurnal
JOIN tovary ON tovary.id=id_tovar
JOIN tovary_kat ON tovary.kat=tovary_kat.id
WHERE (`date` between $date_s AND $date_e) AND rashod_prihod='0'
GROUP BY tovary.id
ORDER BY tovary_kat.name ASC, tovary.name ASC";
echo "<br>".$sklad->sql_query;
$this->sql_execute();
$spisanie_table="<table width=\"100%\"><tr bgcolor=\"#dddddd\"><td width=\"75%\">Наименование</td><td>списано</td></tr>";
while (list($sum,$tovar_id,$tovar_name,$edinicy, $kat_name)=mysql_fetch_row($this->sql_res))
{

	$spisanie_table.="<tr $row_bgcolor><td> $kat_name $tovar_name</td><td>$sum $edinicy</td></tr>";

}
$spisanie_table.="</table>";
return $spisanie_table;
}

}
?>
