<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/tree.css');
    Yii::app()->clientScript->registerScript('tree-menu', '
        $("body *").not("div#tree").click(function(event){
            if ($(".tree-menu").hasClass("show")) {
                $(".tree-menu ul li.tree-menu-add").removeClass("show");
                $(".tree-menu ul li.tree-menu-addchild").removeClass("show");
                $(".tree-menu ul li.tree-menu-view").removeClass("show");
                $(".tree-menu ul li.tree-menu-edit").removeClass("show");
                $(".tree-menu ul li.tree-menu-delete").removeClass("show");
                $(".tree-menu").removeClass("show");
            }
        });

        $("[class ^= tree-menu-button-] a").live("click",function(event){
            event.preventDefault();

            controller = $(this).parent().attr("class").split("-")[3];

            id = $(this).parent().parent().attr("id").split("-")[1];
            p = $(this).parent().parent().parent().parent().attr("id").split("-")[1];
            p_child = $(this).parent().parent().attr("id").split("-")[1];

            switch (controller) {
                case "organization" :
                    child_controller = "branch";
                    text = "організацію";
                    text_child = "філію";
                    break;
                case "branch" :
                    child_controller = "department";
                    text = "філію";
                    text_child = "відділ";
                    break;
                case "department" :
                    child_controller = "cabinet";
                    text = "відділ";
                    text_child = "кабінет";
                    break;
                case "cabinet" :
                    child_controller = "employee";
                    text = "кабінет";
                    text_child = "співробітника";
                    break;
            }

            $(".tree-menu ul li.tree-menu-add a").attr("href",
                                        "?r="+controller+"/create&parent="+p+"")
                                        .text("Додати "+text);;
            $(".tree-menu ul li.tree-menu-addchild a").attr("href",
                                        "?r="+child_controller+"/create&parent="+p_child+"")
                                        .text("Додати "+text_child);
            $(".tree-menu ul li.tree-menu-view a").attr("href",
                                        "?r="+controller+"/view&id="+id+"");
            $(".tree-menu ul li.tree-menu-edit a").attr("href",
                                        "?r="+controller+"/update&id="+id+"");
            $(".tree-menu ul li.tree-menu-delete a").attr("href",
                                        "?r="+controller+"/delete&id="+id+"");

            $(".tree-menu").css("left",10+event.pageX+"px").css("top",event.pageY+"px");

            $(".tree-menu ul li.tree-menu-add").toggleClass("show");
            if (controller !== "employee")
                $(".tree-menu ul li.tree-menu-addchild").toggleClass("show");
            $(".tree-menu ul li.tree-menu-edit").toggleClass("show");
            $(".tree-menu ul li.tree-menu-delete").toggleClass("show");

            $(".tree-menu").toggleClass("show");
        });',
        CClientScript::POS_READY);
?>

<?php if (count($organizations)): ?>
<?php  
  $count = count($organizations);
  $i = 0;
?>
    <div class="tree-title">Організації</div>
    <!--<div class="tree-menu-button"><a href="#">+</a></div>-->
    <ul class="Container">
      <?php foreach ($organizations as $organization): ?>
      <?php 
          if ($i == ($count-1)) {$class = "IsLast";}
          elseif ($i == 0) {$class = "IsFirst";}
          $i++;
      ?>
        <li class="Node IsRoot ExpandClosed <?php echo $class; ?>" 
            id="org-<?php echo $organization->id_organization; ?>">
          <div class="Expand"></div>
          <!--<input type="checkbox"/>-->
          <div class="tree-menu-button-organization"><a href="#"></a></div>
          <div class="Content">
            <?php  
              echo CHtml::ajaxLink($organization->name,
                                Controller::createUrl('dev/show', 
                                              array('id'=>$organization->id_organization,)),
                                array('update' => '#data-grid'));?> 
          
          </div>
        </li> 
      <?php endforeach; ?>
    </ul>

  <div id="show_all" class="buttons">
  <?php echo CHtml::ajaxButton ("Всі пристрої",
                              CController::createUrl('dev/showAll'), 
                              array('update' => '#data-grid'));?>  
  </div>                            

<?php else: ?>  
  <span>Нет организаций</span>
<?php endif; ?>  
  
<div class="tree-menu">
    <ul>
        <li class="tree-menu-add"><a href="#">Додати</a></li>
        <li class="tree-menu-addchild"><a  style="color: red" href="#">Додати +</a></li>
        <li class="tree-menu-view"><a href="#">Перегляд</a></li>
        <li class="tree-menu-edit"><a href="#">Редагувати</a></li>
        <li class="tree-menu-delete"><a href="#">Видалити</a></li>
        <!--<li>
            <?php echo CHtml::link('Видалити', '#',
                    array('submit'=>array('delete','id'=>''),
                          'confirm'=>'Ви впевнені?')); ?>
        </li>-->
    </ul>
    <div><a href="#" onClick="$(this).parent().removeClass('show');">X</a></div>
</div>