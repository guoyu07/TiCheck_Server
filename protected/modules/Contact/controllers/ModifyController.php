<?php

class ModifyController extends \User\controllers\DefautController
{
	protected $newContacts;
	public function actionIndex()
	{
		//$this->render('index');
		$this->prepareContacts();
		$this->prepareNewContacts();

		$con_model = new \Contacts;
		$con_model->attributes = $this->contacts;
		$adp = $con_model->search();
		foreach ($adp->getData() as $data)
		{
			$data->attributes = $this->newContacts;
			try
			{
				$data->save();
			}
			catch(Exception $e)
			{
				new \Error(5, null, $e->getMessage());
			}
		}
	}

	private function prepareNewContacts()
	{
		if (!isset($_POST['NewContacts']))
		{
			new Error(4, "NewContacts");
		}
		$this->newContacts = json_decode($_POST['NewContacts'], true);
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
