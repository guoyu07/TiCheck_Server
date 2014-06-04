<?php
namespace AirlineCompany\controllers;
class DefaultController extends \Controller
{
	public $airline;
	public function actionIndex()
	{
		$this->render('index');
	}

	public function prepareAirlineCompany()
	{
		if (!isset($_POST['AirlineCompany']))
		{
			new \Error(4, 'AirlineCompany');
		}
		$this->airline = $_POST['AirlineCompany'];
	}
}
