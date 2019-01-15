<?php
/**
 * DevShowGrid class file.
 *
 * @author JazzzDima <dimag.concept@gmail.com>
 * @copyright 2014
 */

/**
 * DevShowGrid makes upward sample devices.
 *
 * @return CActiveDataProvider
 */

class DevShowGrid {

    public static function getData($level, $id){
        if (empty($level) || empty($id)) throw new CException('Not enought parameter');

        $levels = array(6 => 't_organizations',
                        5 => 't_branches',
                        4 => 't_departmens',
                        3 => 't_cabinets',
                        2 => 't_employees',
                        1 => 't_devices');

        $select = 't_devices.*';

        $l = array_search($level,$levels);

        for ($i=1; $i<=($l-1); $i++) {
            $from[] = $levels[$i];
        }

        switch ($l){
            case 6:
                $where = 't_branches.id_organization=:id
                    AND t_departmens.id_branch = t_branches.id_branch
                    AND t_cabinets.id_department = t_departmens.id_department
                    AND t_employees.id_cabinet = t_cabinets.id_cabinet
                    AND t_devices.id_employee = t_employees.id_employee';
                break;
            case 5:
                $where = 't_departmens.id_branch=:id
                    AND t_cabinets.id_department = t_departmens.id_department
                    AND t_employees.id_cabinet = t_cabinets.id_cabinet
                    AND t_devices.id_employee = t_employees.id_employee';
                break;
            case 4:
                $where = 't_cabinets.id_department = :id
                    AND t_employees.id_cabinet = t_cabinets.id_cabinet
                    AND t_devices.id_employee = t_employees.id_employee';
                break;
            case 3:
                $where = 't_employees.id_cabinet = :id
                    AND t_devices.id_employee = t_employees.id_employee';
                break;
            case 2:
                $where = 't_devices.id_employee = :id';
                break;

        }

        $devices = Yii::app()->db->createCommand()
            ->select($select)
            ->from($from)
            ->where($where, array(':id'=>$id))
            ->queryAll();

        $id_devices = array();

        if (!empty($devices)){
            foreach ($devices as $d){
                $id_devices[] = $d['id_device'];
            }
        }

        $criteria = new CDbCriteria();
        $criteria->addInCondition('id_device', $id_devices, 'AND');

        return new CActiveDataProvider('Device',array('criteria'=>$criteria,
                                                    'pagination'=>array('pageSize'=>30),));
    }
}