<?php

class InfoController extends User\controllers\DefaultController
{
	public function actionIndex()
	{
		$this->prepareUser();
		$userInfo = $this->tiUser->attributes;
		$info = array(
			'Account'=>$userInfo['Account'],
			'Pushable'=>$userInfo['Pushable'],
			'UID'=>$userInfo['UID']
		);
		echo json_encode(array('Code'=>1, 'Message'=>"Succeed", 'Data'=>$info));
		exit;
		//new Error(1, NULL, NULL, $info); 
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
