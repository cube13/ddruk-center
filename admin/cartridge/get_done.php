<?php
header('Content-Type: text/html; charset=utf-8');
include 'conf.php';
$cartridge=new cls_mysql();
$cartridge->sql_connect();

//if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
//{
        $cartridge->sql_query="SELECT cartridge_proces.id,num_of_receipt, cart_num,
     reestr.name, client_name, client_mob_tel, client_adres,
     work_fact,  cartridge.cena_zapravki, cartridge.cena_vostanovlenia, send_sms
        FROM cartridge_proces
        JOIN reestr ON cart_num=reestr.uniq_num
        JOIN cartridge ON reestr.name_id=cartridge.id
        WHERE cartridge_proces.status=3
        ORDER BY num_of_receipt ASC,priority ASC;";


        $cartridge->sql_execute();
        $td=0;$count=0;$cart_count=0;
        $td_max=5;

        while(list($id,$num_of_receipt, $cart_num, $cart_name, $client_name, $client_mob_tel, $client_adres,
         $work_fact_i, $cena_zapravki, $cena_vostanovlenia, $send_sms)=mysql_fetch_row($cartridge->sql_res))
        {
//Набор картриджей в массив
            $cart_array[id][$cart_count]=$id;
            $cart_array[num_of_receipt][$cart_count]=$num_of_receipt;
            $cart_array[cart_num][$cart_count]=$cart_num;
            $cart_array[cart_name][$cart_count]=$cart_name;
            $cart_array[client_name][$cart_count]=$client_name;
            $cart_array[client_mob_tel][$cart_count]=$client_mob_tel;
            $cart_array[client_adres][$cart_count]=$client_adres;
            $cart_array[work_fact_i][$cart_count]=$work_fact_i;
            $cart_array[cena_zapravki][$cart_count]=$cena_zapravki;
            $cart_array[cena_vostanovlenia][$cart_count]=$cena_vostanovlenia;
            $cart_array[send_sms][$cart_count]=$send_sms;
            $cart_count++;
        }

     //Строим вывод по квитанциям
    for($i=0;$i<$cart_count;$i++)
    {
        if($cart_array[num_of_receipt][$i]!=$temp_num){$flag=1;$start_table=0;}
        
        $temp_num=$cart_array[num_of_receipt][$i];
        if($cart_array[num_of_receipt][$i]==$temp_num && $flag==1)
        {
            $kvitanc.="<div width=350 align=left>"; //Начало квитанции

            $kvitanc.="<div class=cart_name>Квитанция №: ".$cart_array[num_of_receipt][$i]."</div><br>";
            $kvitanc.="Клиент: ".$cart_array[client_name][$i]." ".$cart_array[client_mob_tel][$i]."<br>";
            $kvitanc.="Доставка: ".$cart_array[client_adres][$i]."<br>";

            $send_sms="";
            $well_done="";
            

         if($cart_array[send_sms][$i]==0 && $cart_array[client_mob_tel][$i])
             {$send_sms="<a class=button href='sendsms.php?id=".$cart_array[id][$i]."'>SMS</a>";}
            elseif($cart_array[send_sms][$i]==2){$send_sms="SMS отправлено";}
            elseif($cart_array[send_sms][$i]==3){$send_sms="SMS доставлено";}
            elseif($cart_array[send_sms][$i]==100){$send_sms="SMS не доставлено<br>Перезвонить!";}
            $well_done.="<a class=button href='index.php?act=kvitanc_done&status=4&num_of_receipt=".$cart_array[num_of_receipt][$i]."'>Готов</a>";
$flag=0;
}
        if($flag==0)
        {
            if($start_table==0)
            {
                $kvitanc.="<table border=1><tr>
                    <td width=200>Картридж</td>
                    <td width=100>Что сделано</td>
                    <td>Цена</td>
                    </tr>";
                $start_table=1;
            }

               if($cart_array[work_fact_i][$i]==1)
            {
                $cena=$cart_array[cena_zapravki][$i];
            }
            if($cart_array[work_fact_i][$i]==2)
            {
                $cena=$cart_array[cena_vostanovlenia][$i];
            }

         
            $kvitanc.="<tr>
                    <td>".$cart_array[cart_num][$i]." ".$cart_array[cart_name][$i]."</td>
                    <td>".$work_plan[$cart_array[work_fact_i][$i]]."</td>
                    <td>$cena</td>
                    </tr>";
            

            if($cart_array[num_of_receipt][$i+1]!=$temp_num)
                {
                
                $kvitanc.="</table><br>$send_sms&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$well_done</div>
                ---------------------------------------------------------------------<br><br>";

                } //Конец квитанции
        }
        

    };
    echo date("H:i:s")."<br>".$kvitanc;

//}
?>