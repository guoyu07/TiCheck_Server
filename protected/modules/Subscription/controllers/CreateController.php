<?php

class CreateController extends Controller
{
	/*
	public function actionIndex()
	{
		$this->render('index');
	}
	 */
	
	public function actionIndex()
	{
		if (isset($_POST['Subscription']) && isset($_POST['User']))
		{
			$subs = json_decode($_POST['Subscription']);
			$user = json_decode($_POST['User']);
			//echo var_dump($subs);

			if ($subs->DepartCity == NULL ||
				$subs->ArriveCity == NULL ||
				$subs->StartDate == NULL ||
				$subs->EndDate == NULL)
			{
				echo "not enough data";
				return false;
			}

			$tiSubs = new Subscription;
//			$tiSubs->attributes = array($subs);
			foreach ($subs as $name=>$value)
			{
				$tiSubs->$name = $value;
			}
 

			echo $tiSubs->DepartCity;
			try
			{
				$tiSubs->save();
			}
			catch(Exception $e)
			{
				echo "save to database wrong". $e->getMessage();
				return false;
			}

			echo "create tiSubs record<br>";
			return true;
		}
		else
		{
			echo "no subs posted";
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
