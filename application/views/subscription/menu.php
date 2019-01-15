<!-- Menu/brand start-->
            <div class="span3 sidebar sidebar-right ">
                <div class="inner">
 
                    <div class="block">
                            <ul class="nav nav-list secondary-nav">
                                <?php foreach ($menu_array->result() as $menu_item):?>
                                <?php if($brand==$menu_item->name):?>
                                <li><a href="/zapravka/kartridgey/<?php echo $menu_item->name;?>/<?php echo $menu_item->id;?>/0">
                                        <i class="icon-chevron-left"></i> <b><?php echo $menu_item->name;?></b></a>
                                </li>
                                <?php if(!$type):?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/zapravka/kartridgey/<?php echo $menu_item->name;?>/<?php echo $menu_item->id;?>/0">
                                    <b>Монохромные</b></a>
                                    &nbsp;&nbsp;<a href="/zapravka/kartridgey/<?php echo $menu_item->name;?>/<?php echo $menu_item->id;?>/1">
                                    Цветные</a><br/><br/>
                                <?php else:?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/zapravka/kartridgey/<?php echo $menu_item->name;?>/<?php echo $menu_item->id;?>/0">
                                    Монохромные</a>
                                    &nbsp;&nbsp;<a href="/zapravka/kartridgey/<?php echo $menu_item->name;?>/<?php echo $menu_item->id;?>/1">
                                        <b>Цветные</b></a><br/><br/>
                                <?php endif;?>
                                <?php else:?>
                                <li><a href="/zapravka/kartridgey/<?php echo $menu_item->name;?>/<?php echo $menu_item->id;?>/0"><i class="icon-chevron-right"></i> <?php echo $menu_item->name;?></a></li>
                                <?php endif;?>
                                <?php endforeach;?>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--menu end->