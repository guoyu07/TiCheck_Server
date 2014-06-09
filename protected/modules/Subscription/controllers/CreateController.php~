<?php

class CreateController extends Subscription\controllers\DefaultController
{
	/*
	public function actionIndex()
	{
		$this->render('index');
	}
	 */
	
	public function actionIndex()
	{
		// user
		$this->prepareUser();

		// subscription
		$this->prepareSubscription();
		//print_r($this->_subs);
		//exit;

		// modify database
		$this->createRelation();

		//  异步搜最低价
		//$this->createHistoryPrice($this->_subs);
		//echo (YiiBase::getPathOfAlias('application') . "yiic historyprice index --subs_id=" . $this->_subs->ID . " >/dev/null 2>/dev/null &");
		shell_exec(YiiBase::getPathOfAlias('application') . "/yiic historyprice index --subs_id=" . $this->_subs->ID . " >/dev/null 2>/dev/null &");
		new \Error(1);
	}

	private function createRelation()
	{
		$subs = $this->_subs;
		$user = $this->tiUser;
		//echo var_dump($subs);
		//echo var_dump($user);
		$user_subs = new \UserSubscription;
		$user_subs->ID_user = $user->ID;
		$user_subs->ID_subscription = $subs->ID;
		$user_subs_adp = $user_subs->search();
		//var_dump($subs->ID);
		//exit;
		if ($user_subs_adp->itemCount)
		{
			new Error(5,NULL, "has been subscriped");
		}
		try
		{
			if (!$user_subs->save())
			{
				new \Error(5, null, json_encode($user_subs->getErrors()));
			}
		}
		catch(Exception $e)
		{
			new Error(5, NULL, $e->getMessage());
		}

		//new Error(1);
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
