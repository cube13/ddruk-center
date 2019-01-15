<section id="left_col"><!-- left_col -->
  <div id="tree">
    <?php $this->renderPartial('_tree', array(
                        'organizations' => $organizations,));?>
  </div>
  <?php $this->widget('application.components.AddDevice.AddDevice'); ?>
</section> <!-- end of left_col -->
  
<section id="right_col"><!-- right_col -->
  <div id="data-grid">
    <?php $this->renderPartial('_device', array(
                      'dataProvider' => $dataProvider,));?>
  </div>
</section> <!-- end of right_col -->

<div id="loader">
  <span>Загрузка...</span>
</div>

<div style="clear:both;"></div>