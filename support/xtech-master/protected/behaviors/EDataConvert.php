<?php

class EDataConvert extends CActiveRecordBehavior
{
    private $date;
    public $params;
    public $prop = array();

    public function beforeSave($event)
    {
            if ($this->params) {
                foreach ($this->params as $p) {
                    $this->dataToSql($p);
                    if (isset($this->prop[$p])){
                        $this->owner->$p = $this->prop[$p];
                    } else {
                        $this->owner->$p = '0000-00-00';
                    }
                }
                return true;
            }
        return false;
    }

    public function afterFind($event)
    {
        if ($this->params){
            foreach ($this->params as $p) {
                $this->dataFromSql($p);
                if (isset($this->prop[$p])) {
                    $this->owner->$p = $this->prop[$p];
                }
            }
            parent::afterFind($event);
        }
        return false;
    }

    public function dataToSql($p)
    {
        $date = $this->owner->$p;
        if ($date) {
            $this->prop[$p] = date('Y-m-d', strtotime($date));
            return true;
        }
        return false;
    }

    public function dataFromSql($p)
    {
        $date = $this->owner->$p;
        if ($date) {
            $date = date('d-m-Y', strtotime($date));
            $date = ($date === '01-01-1970')
                                ? '00-00-0000' : $date;
            $this->prop[$p] = $date;
            return true;
        }
        return false;
    }
}