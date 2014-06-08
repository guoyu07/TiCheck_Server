<?php

class AddController extends \AirlineCompany\controllers\DefaultController
{

	public function actionIndex()
	{
		//$this->render('index');
		$this->prepareAirlineCompany();

		//var_dump($this->airline);
		$airlineModel = \AirlineCompany::model()->findByAttributes(array('Airline'=>$this->airline));
		//var_dump($airlineModel);
		if ($airlineModel != null)
		{
			$frequency = $airlineModel->Frequency;
			$frequency++;
			$airlineModel->Frequency = $frequency;
			try
			{
				if (!$airlineModel->save())
				{
					new \Error(5, null, json_encode($airlineModel->getErrors()));
				}
			}
			catch(Exception $e)
			{
				new \Error(5, null, $e->getMessage());
			}
			new \Error(1);
		}
		new \Error(5, null, "no this airline company");
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
