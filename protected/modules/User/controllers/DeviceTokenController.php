<?php

class DeviceTokenController extends User\controllers\DefaultController
{
	protected $token;
	public function actionAdd()
	{
		$this->prepareUser();
		$this->prepareToken();
		$user_device = new UserDevice;
		$user_device->ID_user = $this->tiUser->ID;
		$user_device->Device_token = $this->token;
		try
		{
			$user_device->save();
		}
		catch(Exception $e)
		{
			new Error(5, NULL, $e->getMessage());
		}
		new Error(1);
	}

	public function actionRemove()
	{
		$this->prepareUser();
		$this->prepareToken();
		$user_device = UserDevice::model()->findByAttributes(
			array('ID_user'=>$this->tiUser->ID,
			'Device_token'=>$this->token) 
		);
		try
		{
			$user_device->delete();
		}
		catch(Exception $e)
		{
			new Error(5, NULL, $e->getMessage());
		}
		new Error(1);
	}

	public function prepareToken()
	{
		if (!isset($_POST['DeviceToken']))
		{
			new Error(4, "DeviceToken");
		}
		$this->token = json_decode($_POST['DeviceToken']);
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
