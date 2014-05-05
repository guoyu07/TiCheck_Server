<?php

class ModifyController extends User\controllers\DefaultController
{
	public function actionIndex()
	{
		$this->prepareUser();
		if (!isset($_POST['NewUser']))
			new Error(4, 'NewUser');

		$newUser = json_decode($_POST['NewUser']);
		//echo var_dump($user);

		if ($this->tiUser)
		{
			if (property_exists($newUser, 'Password') &&
				$newUser->Password != NULL)
				$this->tiUser->Password = $newUser->Password;
			if (property_exists($newUser, 'Email') &&
				$newUser->Email != NULL)
				$this->tiUser->Email = $newUser->Email;
			if (property_exists($newUser, 'Account') &&
				$newUser->Account != NULL)
				$this->tiUser->Account = $newUser->Account;
			
			if (property_exists($newUser, 'Pushable') &&
				$newUser->Pushable != NULL)
				$this->tiUser->Pushable = $newUser->Pushable;
			
			//echo var_dump($this->tiUser);
			try
			{
				$this->tiUser->save();
			}
			catch(exception $e)
			{
				new Error(5, NULL, $e->getMessage());
			}
			new Error(1);
		}
		else
		{
			new Error(6);
		}
	}

	/*
	public function actionAccount()
	{
		if (isset($_POST['User']) && isset($_POST['NewUser']))
		{
			$user = json_decode($_POST['User']);
			$newUser = json_decode($_POST['NewUser']);
			//echo var_dump($user);

			//$tiUser = new TiUser;
			if (property_exists($user, 'Password') && $user->Password!=NULL)
			{
				$tiUser = TiUser::model()->findByAttributes(
					array('Email'=>$user->Email,'Password'=>$user->Password) 
				);
			}
			else
			{
				$tiUser = TiUser::model()->findByAttributes(
					array('Email'=>$user->Email) 
				);
			}

			if ($tiUser)
			{
				$tiUser->Password = $newUser->Password;
				$tiUser->Email = $newUser->Email;
				$tiUser->Account = $newUser->Account;

				//echo var_dump($tiUser);
				try
				{
					$tiUser->save();
				}
				catch(exception $e)
				{
					throw new CDbExceptione($e->getMessage()); 
				}
			}
			else
			{
				echo "no this user";
			}
		}
		else
		{
			echo "no user posted";
			return false;
		}
	}
	 */


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
