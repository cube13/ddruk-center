<?php
include 'conf.php';
$cartridge->sql_connect();


$cartridge->sql_query="SELECT cartridge.id, cartridge.name,brands.name
FROM cartridge
left join brands on cartridge.brand=brands.id
order by brands.name asc, cartridge.name asc";

$cartridge->sql_execute();
while(list($id,$name,$brand)=  mysql_fetch_row($cartridge->sql_res))
{
    $path="/ddruk.local/files/images/cartridges/$brand/$name.jpg<br/>";
    //<img src=\"http://ddruk.com.ua/files/images/cartridges/$brand/$name.jpg\"><br/>";
    $picpath = strtolower($path);
    $picpath=str_replace("-", "", $picpath);
    //echo $picpath;
    //echo $cartridge->sql_query="UPDATE cartridge SET picture='$picpath' WHERE id=$id;<br>";
    //$cartridge->sql_execute();
}
?>
