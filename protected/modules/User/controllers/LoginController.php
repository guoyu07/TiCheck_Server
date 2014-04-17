<?php

class LoginController extends Controller
{
/*	
	public function actionIndex()
	{
		$this->render('index');
	}
 */

	public function actionIndex()
	{
		if (isset($_POST['User']))
		{
			$user = json_decode($_POST['User']);
			//echo var_dump($user);

			$tiUser = TiUser::model()->findByAttributes(
				array('Email'=>$user->Email,'Password'=>$user->Password) 
			);

			if ($tiUser)
			{
				echo "Yes login";
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
