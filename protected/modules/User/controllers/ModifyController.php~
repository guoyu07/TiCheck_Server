<?php

class ModifyController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

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

				/*
				foreach (get_object_vars($tiUser) as $name=>$value)
				{
					$tiUser->$name = $newUser->$name;
					$value;
				}
				 */
				
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
