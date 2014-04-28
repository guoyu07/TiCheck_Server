<?php

class CreateController extends Controller
{
//	public function actionIndex()
//	{
//		$this->render('index');
//	}

	public function actionIndex()
	{
		if (isset($_POST['User']))
		{
			$user = json_decode($_POST['User']);
			echo var_dump($user);

			if (!$this->verifyInfo($user))
			{
				echo "user erro";			
				return false;
			}
			$tiUser = new TiUser;
			foreach ($user as $name=>$value)
			{
				$tiUser->$name = $value;
			}
 

			echo $tiUser->Account;
			try
			{
				$tiUser->save();
			}
			catch(Exception $e)
			{
				throw new CDbException($e->getMessage());
				return false;
			}

			echo "create TiUser record<br>";
			return true;
		}
		else
		{
			throw new CException("no user");
			echo "no user posted";
			return false;
		}
	}

	// Utilities
	private function verifyEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			    echo "This ($email) email address is considered valid.<br>";
				return true;
		}
		echo "email not valid";
		return false;
	}

	private function verifyAccount($account)
	{
		$pattern = "/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/";
		if (preg_match($pattern,$account))
		{
			echo "account ($account) ok <br>";
			return true;
		}
		else
		{
			echo "not valid account<br>";
		}
		
		return false;
	}

	private function verifyPassword($passwd)
	{
		$pattern = "/[\s|\S]{5,64}$/";
		if (preg_match($pattern,$passwd))
		{
			echo "length of ($passwd) ok <br>";
			return true;
		}
		else
		{
			echo "not valid passwd<br>";
		}
		
		return false;
	}


	private function verifyInfo($user)
	{
		if (!$this->verifyAccount($user->Account))
		{
			echo "wrong account";
			return false;
		}
		if (!$this->verifyEmail($user->Email))
			return false;
		if (!$this->verifyPassword($user->Password))
			return false;
		return true;
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
