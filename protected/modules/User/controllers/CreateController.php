<?php

class CreateController extends Controller
{
//	public function actionIndex()
//	{
//		$this->render('index');
//	}

	public function actionIndex()
	{
		if (!isset($_POST['User']))
		{
			new Error(4, "User");
		}
		$user = json_decode($_POST['User'], true);
		//var_dump($user);

		if (!$this->verifyInfo($user))
		{
			new Error(3);
		}
		$tiUser = new TiUser;
		$tiUser->attributes = $user;

		//echo $tiUser->Account;
		//var_dump($tiUser);
		try
		{
			$tiUser->save();
		}
		catch(Exception $e)
		{
			new Error(2);
		}
		new Error(1);
	}

	// Utilities
	private function verifyEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			return true;
		}
		new Error(3, NULL, "Email");
		return false;
	}

	private function verifyAccount($account)
	{
		if ($account == '')
		{
			return true;
		}
		$pattern = "/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/";
		if (preg_match($pattern,$account))
			return true;
		new Error(3, NULL, "Account");
		return false;
	}

	private function verifyPassword($passwd)
	{
		$pattern = "/[\s|\S]{5,64}$/";
		if (preg_match($pattern,$passwd))
			return true;
		new Error(3, NULL, "Password");
		return false;
	}

	private function verifyInfo($user)
	{
		return $this->verifyAccount($user['Account']) && $this->verifyEmail($user['Email']) && $this->verifyPassword($user['Password']);
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
