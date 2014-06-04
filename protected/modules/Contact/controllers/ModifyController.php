<?php

class ModifyController extends \Contact\controllers\DefaultController
{
	protected $newContacts;
	public function actionIndex()
	{
		//$this->render('index');
		$this->prepareContacts();
		$this->prepareNewContacts();

		$con_model = \Contacts::model()->findAllByAttributes($this->contacts);
		if (count($con_model)==0)
		{
			new \Error(5, null, "no such contacts");
		}
		foreach ($con_model as $data)
		{
			$data->attributes = $this->newContacts;
			try
			{
				if (!$data->save())
				{
					new \Error(5, null, json_encode($data->getErrors()));
				}
			}
			catch(Exception $e)
			{
				new \Error(5, null, $e->getMessage());
			}
		}
		new \Error(1);
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
