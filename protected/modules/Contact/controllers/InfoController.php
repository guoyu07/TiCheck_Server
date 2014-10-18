<?php

class InfoController extends \Contact\controllers\DefaultController
{
	private $data;
	public function actionIndex()
	{
		//$this->render('index');
		
		$this->prepareUser();
		if (!isset($_POST['Contacts']))
		{
			$this->fetchContactsOfUser();
		}
		else
		{
			$this->prepareContacts();
			$this->fetchSpecificContact();
		}
		//var_dump($this->data);
		//exit;
		echo json_encode(array('Code'=>1, 'Message'=>'Succeed', 'Data'=>$this->data));
		
	}

	private function fetchContactsOfUser()
	{
		$con_model = Contacts::model()->findAllByAttributes(array('ID_user'=>$this->tiUser->ID));
		//var_dump($con_model);
		//exit;
		foreach($con_model as $con)
		{
			$this->data[] = $con->attributes;
		}
	}

	private function fetchSpecificContact()
	{
		$con_model = Contacts::model()->findAllByAttributes($this->contacts);
		foreach ($con_model as $data)
		{
			$this->data[] = $data->attributes;
		}
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
