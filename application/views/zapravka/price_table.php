<div id="highlighted">
      <div class="container">
        <div class="row-fluid header">
            <div class="span9">
                <h2 class="page-title"><span>Заправка и восстановление картриджей <b><?php echo $brand?></b></span> </h2>
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
              
                <h3 class="block-title sub-title"><strong>Заправляем картриджи</strong></h3>
              <p>Сервисный центр «Добрий друк» –  заправка и 
                  восстановление картриджей для лазерной печати, принтеров Brother, 
                  Canon, Epson, Gestetner, HP, Kyocera, Lexmark, Minolta, OKI, Panasonic, Ricoh, Samsung, Sharp, 
                  Toshiba, Xerox. Мастера Сервисного Центра «Добрый друк» заправят картридж к принтерам, МФУ, 
                  копирам, факсам. Оснащенная по последнему слову техники мастерская по заправке картриджей, 
                  провереные на практике технологии, квалифицированный персонал – все это позволяет гарантировать 
                  Вам отличное качество работ и высокий уровень сервиса.</p>
              
              <h3 class="block-title sub-title"><strong>Гарантируем качество</strong></h3>
              <p>Каждому картриджу присваеваеться индивидуальный код, обеспечивающий учет всех работ по заправке 
                  картриджей. Мы всегда знаем, когда и какие работы производились с Вашими картриджами.
                    Картридж проходит предварительную диагностику для определения деталей, требующих замены, 
                    если необходим ремонт/восстановление картриджа.
              
              <h3 class="block-title sub-title"><strong>Помогаем экономить</strong></h3>
             
              <p>Уменьшайте расходы на заправку картриджей при гарантированном качестве и 
                  скорости работ. Благодаря плодотворному сотрудничеству с лучшими поставщиками высококачественных 
                  расходных материалов, мы можем предложить низкие цены на наши услуги по заправке и обслуживанию 
                  картриджей. Стоимость заправки картриджа для популярных моделий 
                  принтеров составляет от 49 грн.</p>
            </div>
            
           
                <?php endif;?>
            </div>
<!-- content end -->