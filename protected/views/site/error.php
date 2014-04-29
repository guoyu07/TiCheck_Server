<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
$error = json_encode(array(
	'ErrorCode'=>$code, 
	'ErrorMessage'=>$message
));
//Error echo $code; 
//echo CHtml::encode($message); 
echo $error;

?>
