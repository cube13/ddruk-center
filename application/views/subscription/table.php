<div id="highlighted">
      <div class="container">
        <div class="row-fluid header">
            <div class="span9">
                <h2 class="page-title"><span>Абонемент на заправку и восстановление картриджей<b><?php echo $brand?></b></span> </h2>
            </div>
            <div class="span3"><div class="input-append"><h2></h2>
     <!--<input class="3" id="appendedInputButton" type="text" placeholder="поиск...">
     <button class="btn" type="button"><i class="icon-search"></i>  </button>-->
</div></div>
        </div>
      </div>
    </div>  
<?php
$bgcolor['K']='black';
$bgcolor['M']='magenta';
$bgcolor['C']='cyan';
$bgcolor['Y']='yellow';
?>
<!-- Content/table of cartridges start-->
<div id="content">
    <div class="container">   
        <div class="row">
            <div class="span9">
                <?php if($cartridges->num_rows()>0):?>
                
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead><tr><td>Принтер</td><td>Картридж</td>
                             <?php if($type):?>
                           <td></td>
                               <?php endif;?>
                            <td>Заправка </td>
                           <td>Восстановление</td><td>Новый</td></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartridges->result() as $cartridge):?>
                       <tr><td>
                            <?php echo $brand.' '.$cartridge->printer;?><br/>
                           </td>
                           <td><a href="/cartridge/reffil/<?php echo $cartridge->name;?>/<?php echo $cartridge->id;?>" 
                           title="Заправка картриджа <?php echo $brand.' '.$cartridge->name;?>"><?php echo $brand.' '.$cartridge->name;?>
                               </a>
                               
                           </td>
                           <?php if($type):?>
                           <td><div width="10" style="background-color: <?php echo $bgcolor[$cartridge->color];?>">&nbsp;&nbsp;&nbsp;</div></td>
                               <?php endif;?>
                           <td><?php if($cartridge->cena_zapravki)
                           { 
                               if($cartridge->cena_zapravki<140) echo $cartridge->cena_zapravki.' <span style="font-weight: bold;color:red;">Акція!</span>';
                               if($cartridge->cena_zapravki>139) echo $cartridge->cena_zapravki;
                           }
                                    else echo '-';?>
                           </td>
                           <td><?php if($cartridge->cena_vostanovlenia) echo $cartridge->cena_vostanovlenia;
                                    else echo '-';?></td>
                           <td><?php if($cartridge->cena_novogo) echo round($cartridge->cena_novogo*14*1.1);
                                    else echo '-';?></td>
                           
                        </tr>
                     <?php endforeach;?>
                    </tbody>
                </table>
                <?php else:?>
                    <!-- About company -->
            <div class="block">
              
               <!-- <h3 class="block-title sub-title"><strong>Правила пользования абонементом</strong></h3>
              <p></p>-->
              
              <h3 class="block-title sub-title"><strong>Перечень картриджей обслуживаемых по абонементу</strong></h3>
              <p><strong> Canon</strong><br>
                  728, FX-10,FX-1, FX-2, FX-3, FX-4, FX-6, FX-7, EP-A, EP-52, EP-32, EP-27, 724, 724H, 719, 713,
                  EP-22, EP-25, EP-26, 712, 710, 708, 706, C-EXV40, 725, 726, FX-5, 715, 703, E-30, E-16, C-EXV7, 
                  715H, 710H, 708H, 714</p>
              <p><strong> Xerox</strong> <br>
                  006R01278
113R00737
113R00735
113R00730
113R00667
113R00442
113R00095
109R00747
006R90170
106R01379
106R01487
108R00796
113R00296
108R00794
106R01414
106R01374
106R01373
106R00442
109R00748
109R00746
109R00725
106R01034
106R01033
106R00688
106R00687
106R00646
106R00586
106R00462
013R00621
013R00607
106R01048
106R01148
106R01149
109R00639
108R00909


108R00908
106R01485
106R01412
013R00625
106R01411
106R01245
106R01159
013R00606
006R01044
113R00462
106R02181
106R01277
106R00461
006R01020
106R01246
              </p>
              <p><strong> HP</strong> <br>
                  C4127X
C4182X
C4129X
Q3964A
C7115A
C7115X
C8061A
C4127A
C4092A
Q2613A
CC388A
CF283A
Q7553X
CF280A
92298A
C3903A
C3906A
C3909A
C92274A
CB435A
Q5949A


Q5949X
Q6511A
Q7551A
Q7553A
C4096A
Q7570A
Q5945A
Q2624A
Q2613X
CE255A
CE505A
Q1339A
Q2610A
CB436A
Q2612A
CE285A
CE278A
CE505X
              </p>
              <p><strong>Brother</strong><br>
                  TN-2275
TN-2000
TN-7300
TN-2085
TN-2090
TN-2235
TN-2175
TN-1075
TN-2335
TN-2135
TN-3130
TN-6300
TN-2075
              </p>
              <p><strong>Samsung</strong><br>
                  MLT-D1043S
ML-D2850A
ML-1650D8
MLT-D105S
ML-D1630A
SCX-4720D5
ML-D3470B
ML-2550D5
ML-D3050B
ML-D3050A
ML-D3470A
ML-D4550A
MLT-D105L


ML-D2850B
MLT-D104S
MLT-D115L
MLT-D205E
MLT-D103L
MLT-D101S
MLT-D209L
MLT-D103S
MLT-D106S
MLT-D1042S
MLT-D117S
MLT-D205L
MLT-D205S
MLT-D209S
ML-1210D3
ML-1520D3
ML-1610D2
MLT-D109S
SCX-4100D3
SCX-4216D3
SCX-4720D3
SCX-5312D6
SCX-D4200A
SCX-D4725A
SCX-4521D3
SCX-D5530A
MLT-D108S
SCX-6320D8
ML-2150D8
ML-2010D3
ML-2250D5
ML-1710D3
ML-2550DA
ML-3560D6
ML-4500D3
ML-5000D5
ML-6060D6
              </p>







             
              
              
            </div>
            
           
                <?php endif;?>
            </div>
<!-- content end -->