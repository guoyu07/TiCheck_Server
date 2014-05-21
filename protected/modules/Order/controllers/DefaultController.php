<?php
namespace Order\controllers;
class DefaultController extends \User\controllers\DefaultController
{
	protected $tempOrder = null;
	public function actionIndex()
	{

		//$this->render('index');
	}

	public function prepareTempOrder()
	{
		if (!isset($_POST['TempOrder']))
		{
			new \Error(4, "TempOrder");
		}

		$this->tempOrder = json_decode($_POST['TempOrder'], true)['OrderID'];
	}
	
}
