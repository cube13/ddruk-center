<?php
//Yii::import('zii.widgets.CPortlet');

class AddDevice extends CWidget{

    public $parent;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->render('AddDevice', array('parent'));
    }
}