<?php

class DeleteController extends \Contact\controllers\DefaultController
{
	public function actionIndex()
	{
		//$this->render('index');
		$this->prepareUser();
		$this->prepareContacts();

		if (array_key_exists('Name', $this->contacts))
			$this->deleteContact($this->contacts);
		else
		{
			foreach($this->contacts as $con)
			{
				$this->deleteContact($con);
			}
		}
		new \Error(1);
	}

	private function deleteContact($con)
	{
		//var_dump($con);
		//exit;
		$con_model = \Contacts::model()->findAllByAttributes($con);
		foreach ($con_model as $data)
		{
			try
			{
				$data->delete();
			}
			catch(Exception $e)
			{
				new \Error(5, null, $e->getMessage());
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
