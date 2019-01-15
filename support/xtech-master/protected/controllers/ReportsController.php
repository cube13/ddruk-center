<?php

class ReportsController extends Controller
{
	public function actionIndex() 
	{
		$this->render('index',array());
	}

    public function actionConstruct()
    {
        $result = null;
        if (Yii::app()->request->requestType == 'POST') {
            $request = Yii::app()->request->getRestParams();
            $result = Device::model()->construct($request);
        }

        Yii::app()->session['construct_result'] = $result;

        $this->render('construct',
                array(
                    'result'=>$result,
                ));
    }

    public function actionExport(){
        $dataProvider = Yii::app()->session['construct_result'];
        $p = $dataProvider->getData();
        if (empty($p)) {
            throw new Exception("Вибірка порожня!");
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("JazzzDima")
            ->setLastModifiedBy("JazzzDima")
            ->setTitle("Результати запиту")
            ->setSubject("Результати запиту")
            ->setDescription("Вивантаження даних")
            ->setKeywords("вивантаження облік техніки")
            ->setCategory("Вивантаження");

        $objPHPExcel->getActiveSheet()->setTitle('Вивантаження');

        foreach ($dataProvider->data as $obj) {
            $data[] = $obj->getAttributes();
        }

        /*Set data to cell*/
        $i = array('A','B','C','D','E','F','G','H','I','J','K','L','M',
                    'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                    'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
                    'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
                   );
        $z = 2;
        foreach ($data as $d) {
            $j = 1;
            foreach ($d as $k=>$v) {
                $objPHPExcel->getActiveSheet()
                    ->setCellValue($i[$j-1].$z, $v);
                $j++;
            }
            $z++;
        }
        /*End set data to cell*/

        /*Set columns labels*/
        $labels = $dataProvider->data[0]->attributeLabels();
        $j = 0;
        foreach ($labels as $l) {
            $objPHPExcel->getActiveSheet()
                ->setCellValue($i[$j].'1', $l);
            $j++;
        }
        /*End set columns labels*/

        /*Set date*/
        $objPHPExcel->getActiveSheet()
            ->setCellValue($i[0].($z+4), date("Y-m-d H:i:s"));
        /*End set date*/

        /*Save file*/
        $filename = date("Y-m-d-H-i-s");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save(Yii::app()->params['report_dir'].'/'.$filename.'.xls');
        unset($this->objWriter);
        unset($this->objWorksheet);
        unset($this->objReader);
        unset($this->objPHPExcel);

        $file = Yii::getPathOfAlias('webroot').'/'.Yii::app()->params['report_dir'].'/'.$filename.'.xls';

        $this->redirect(CController::createUrl('download',array('file'=>$file)));
        //$this->downloadFile($file);

        //exit();
        /*End save file*/
    }


    public function actionDownload($file)
    {
        if (file_exists($file)) {
            //var_dump($file);
            if (ob_get_level()) {
                ob_end_clean();
            }

            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit();
            //header('Location: '.$filename);
        } else {
            header($_SERVER["SERVER_PROTOCOL"].' 404 Not Found');
            header('Status: 404 Not Found');
        }
    }
}