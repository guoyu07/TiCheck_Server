<?php

class InfoController extends \Contact\controllers\DefaultController
{
	private $data;
	public function actionIndex()
	{
		//$this->render('index');
		
		if (!isset($_POST['Contacts']))
		{
			$this->fetchContactsOfUser();
		}
		else
		{
			$this->prepareContacts();
			$this->fetchSpecificContact();
		}
		echo json_encode(array('Code'=>1, 'Message'=>'Succeed', 'Data'=>$this->data));
		
	}

	private function fetchContactsOfUser()
	{
		$con_model = Contacts::model()->findByAttributes(array('ID_user'=>$this->tiUser->ID));
		foreach($con_model as $con)
		{
			$this->data[] = $con;
		}
	}

	private function fetchSpecificContact()
	{
		foreach ($this->contacts as $con)
		{
			$con_model = new \Contacts;
			$con_model->attributes = $con;
			$adp = $con_model->search();
			foreach ($adp->getData() as $data)
			{
				$this->data[] = $data;
			}
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
