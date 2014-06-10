<?php

class DeleteController extends \Order\controllers\DefaultController
{
	public function actionIndex()
	{
		//$this->render('index');
		//new \Error(1);
		$this->prepareUser();
		$order = new \Order;
		$this->prepareTempOrder();
		$order->TempOrder = $this->tempOrder;
		$order->ID_user = $this->tiUser->ID;
		$order_provider = $order->search();
		$arr_order = $order_provider->getData();

		foreach ($arr_order as $value)
		{
			try
			{
				$value->delete();
			}
			catch(Exception $e)
			{
				new \Error(5, null, $e->getMessage());
			}
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
