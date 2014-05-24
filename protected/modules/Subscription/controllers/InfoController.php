<?php

class InfoController extends \Subscription\controllers\DefaultController
{
	private $array_subs_users;
	private $array_subs;
	public function actionIndex()
	{
		$this->prepareUser();
		$this->array_subs_users = $this->tiUser->userSubscriptions;
		foreach ($this->array_subs_users as $user_subs)
		{
			$subs = $user_subs->iDSubscription;
			$subs_flights = \SubsFlight::model()->findAllByAttributes(array('ID_subscription'=>$subs->ID));
			$flight_xml = null;
			foreach ($subs_flights as $flight)
			{
				$flight_xml[] = $flight->attributes;
			}

			$this->array_subs[] = array('Subscription'=>$subs->attributes,
				'FlightXML'=>$flight_xml);
		}
		
		echo json_encode(array(
			'Code'=>1,
			'Message'=>"Succeed",
			'Data'=>$this->array_subs));
		exit;
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
