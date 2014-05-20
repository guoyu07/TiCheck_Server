<?php

class DeleteController extends \Contact\controllers\DefaultController
{
	public function actionIndex()
	{
		//$this->render('index');
		$this->prepareContacts();

		foreach($this->contacts as $con)
		{
			$this->deleteContact($con);
		}
	}

	private function deleteContact($con)
	{
		$con_model = new \Contacts;
		$con_model->attributes = $con;
		$con_model->ID_user = $this->tiUser->ID;
		$adp = $con_model->search();
		foreach ($adp->getData() as $data)
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
