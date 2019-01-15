<?php
$chip[0]='Замена чипа не требуется';
$chip[1]='Нужно заменить чип';
$chip[2]='Нужно перепрошить чип';
$chip[3]='Необходима перепрошивка принтера';    

$color['C']='Синий';
$color['M']='Малиновый';
$color['Y']='Желтый';
$color['K']='Черный';

$cmyk['C']='cyan';
$cmyk['M']='magenta';
$cmyk['Y']='yellow';
$cmyk['K']='';


?>
<div id="highlighted">
      <div class="container">
        <div class="row-fluid header">
            <h2 class="page-title"><span>Заправка картриджа <strong>
                <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?></strong></span></h2>
          <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-mini back-link"><i class="icon-arrow-left"></i> в каталог</a>
        </div>
      </div>
    </div>
        
      <?php //print_r($cartridge->row());

?>

    <div id="content">
      <div class="container portfolio">        
        
        <!--Portfolio feature item-->
        <div class="row">
          <div class="span4 project-photos">
                <div class="item active">
                  <img src="<?php echo $cartridge->row()->picture;?>" alt="Картридж <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?>"/>
                </div>
           </div> 
          
            <div class="span4 sidebar sidebar-right">
            <!-- quick details -->
            <div class="block">
              <h1 class="block-title"><span>Цены</span></h1>
               <h4>Заправка: <?php if($cartridge->row()->cena_zapravki) echo $cartridge->row()->cena_zapravki;
               else echo ' - ';?> </h4>
                <h4>Восстановление: <?php if($cartridge->row()->cena_vostanovlenia) echo $cartridge->row()->cena_vostanovlenia;
                else echo ' - ';?></h4>
                <h4>Обмен: -</h4>
                <h4>Новый: <?php if($cartridge->row()->cena_novogo) echo round($cartridge->row()->cena_novogo*1.1*13);
                else echo ' - ';?></h4>
                
               
                  
              </div>
          </div>
            
            <div class="span4 sidebar sidebar-right">
            <!-- quick details -->
            <div class="block">
              <h3 class="block-title"><span>Характеристики</span></h3>
              <dl>
                <dt>Цвет</dt>
                <dd style="background-color: <?php echo $cmyk[$cartridge->row()->color];?>">
                    <b><?php echo $color[$cartridge->row()->color];?></b></dd>
                <dt>Ресурс (при 5% заполнении страницы)</dt>
                <dd><?php echo $cartridge->row()->resurs;?></dd>
                <dt>Замена чипа. Обнуление чипа</dt>
                <dd><?php echo $chip[$cartridge->row()->is_chip];?></dd>
              </dl>
            </div>
          </div>
        </div>
        <div clas="row-fluid block">
            <div class="span8 block">
                <div class="block">
                <h3 class="block-title"><span>Информация</span> 
                    <span class="label label-warning pull-right">Как мы заправляем картридж 
                        <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?> </span></h3>
                <!--accordion-->
                <div class="accordion accordion-primary" id="accordion2">
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                       Заправка картриджа
                      </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse">
                      <div class="accordion-inner">
                         Заправка картриджа <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?> 
    включает в себя полную разборку картриджа,
проверку деталей картриджа на изношенность, качественную очистку
валов и лезвий картриджа, заправку картриджа тонером, сборку картриджа после заправки.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                        Восстановление картриджа
                      </a>
                    </div>
                    <div id="collapseTwo" class="accordion-body collapse">
                      <div class="accordion-inner">
                          Восстановление картриджа <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?> 
    включает в себя полную разборку картриджа, 
диагностику деталей заправляемого картриджа на изношенность, <b>замену всех изношенных деталей</b>, 
качественную очистку картриджа, <strong>заправку картриджа тонером</strong>, 
сборку картриджа после заправки.</div>
                    </div>
                  </div>
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                        Проверка и упаковка картриджа
                      </a>
                    </div>
                    <div id="collapseThree" class="accordion-body collapse">
                      <div class="accordion-inner">
                         Сданный на заправку картридж  <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?> 
                         тщательно проверяется для выявления дефектов узлов и деталей, требующих замены в связи с их
критическим износом.
<p>
    После заправки картридж <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?> 
    проверяется на тестовов принтере и упаковывается в защитную упаковку. 
   
</p>
                          
                      </div>
                    </div>
                  </div>
                    <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                        Учет
                      </a>
                    </div>
                    <div id="collapseFour" class="accordion-body collapse">
                      <div class="accordion-inner">
                         При приеме картриджу  <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?>  
    присваеваеться индивидуальный код для учета всех работ по картриджу. 
    Мы всегда знаем, когда и какие работы производились с Вашими картриджами. 
                      </div>
                    </div>
                  </div>
                    <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                        Гарантии
                      </a>
                    </div>
                    <div id="collapseFive" class="accordion-body collapse">
                      <div class="accordion-inner">
                         На заправленный картридж, а также на восстановленный картридж <?php echo $cartridge->row()->brand_name;?> <?php echo $cartridge->row()->name;?>, 
                         дается гарантия работоспособности (при наличии <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">индивидуального учетного номера</a>)
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
                <div class="span4 block">
                    <div class="block">
                        <h3 class="block-title">Совместимые принтеры</h3>  
                        <?php //foreach($with_printer->result() as $printer):?>
                            <?php //echo $printer->name;?><br/>
                        <?php //endforeach;?>
                            
                            
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>