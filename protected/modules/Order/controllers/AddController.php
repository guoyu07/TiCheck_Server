<?php

class AddController extends \Order\controllers\DefaultController
{
	public function actionIndex()
	{
		$this->prepareUser();
		$this->prepareTempOrder();

		$this->createOrder();

		//$this->render('index');
	}
	private function createOrder()
	{
		$order = new \Order();
		$order->TempOrder = $this->tempOrder;
		$order->ID_user = $this->tiUser->ID;
		//TODO deal with flight here
		if(!$order->save())
		{
			var_dump($order);
			exit;
		}
		new \Error(1);
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