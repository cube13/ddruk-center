<?php

class ELoggingPC extends CActiveRecordBehavior {

    public $model_before;
    public $model_after;
    public $id;

    public function afterSave($event)
    {
        parent::afterSave($event);
        if (!$this->owner->isNewRecord){
            $this->model_after = $this->owner;
            $changes = $this->compare();
            $this->toLog($changes, $this->id);
        }
    }

    public function afterFind($event)
    {
        if (!$this->owner->isNewRecord) {
            $this->model_before = clone $this->owner;
            $this->id = $this->owner->id_device_pc;
        }
        parent::afterFind($event);
    }

    public function compare()
    {
        $difference = array();
        foreach ($this->model_after->attributes as $k=>$v) {
            if ($this->model_after->$k != $this->model_before->$k) {
                $difference[] = "Змінено ".
                       $this->model_before->getAttributeLabel($k).
                       " з ".$this->model_before->$k." на ".$this->model_after->$k;
            }
        }
        return $difference;
    }

    public function newDevice()
    {
        $difference = array();
        $type = $this->owner->devicetype->name;
        $employee = $this->owner->employee->firstname;
        $name = $this->owner->name;
        $inv_number = $this->owner->inv_number;
        $difference[] = "Створено новий пристрій ".$type." - ".$name.
                        ". Співробітник ".$employee.", інвентарний №".$inv_number;
        return $difference;
    }

    public function toLog($changes = null, $id_device = null)
    {
        if ($changes && $id_device) {
            $date = date("Y-m-d H:i:s");
            foreach ($changes as $change) {
                $attributes = array('id_device'=>$id_device,
                    'date' => $date,
                    'change' => $change);
                $model = new Log();
                $model->attributes = $attributes;
                $model->save();
                unset($model);
            }
            return true;
        } else return false;
    }
}