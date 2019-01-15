<?php

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$this->renderPartial('construct_form');
if ($result) {
    $this->renderPartial('construct_result', array('result'=>$result));
}

?>