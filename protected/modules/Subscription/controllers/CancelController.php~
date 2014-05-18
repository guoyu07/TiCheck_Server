<?php

class CancelController extends Subscription\controllers\DefaultController
{
	public function actionIndex()
	{
		// user
		$this->prepareUser();

		// subscription
		$this->prepareSubscription();

		// modify database
		$this->deleteRelation();

		// check if subscription could be deleted
		$this->deleteSubscription();
	}

	private function deleteRelation()
	{
		$subs = $this->_subs;
		$user = $this->tiUser;
		//echo var_dump($subs);
		//echo var_dump($user);
		$user_subs = new \UserSubscription;
		$user_subs->ID_user = $user->ID;
		$user_subs->ID_subscription = $subs->ID;
		$user_subs_adp = $user_subs->search();
		if ($user_subs_adp->itemCount)
		{
			$user_subs = $user_subs_adp->getData()[0];
			try
			{
				$user_subs->delete();
			}
			catch(Exception $e)
			{
				new Error(5, NULL, $e->getMessage());
			}
		}
	}

	private function deleteSubscription()
	{
		$subs = $this->_subs;
		try
		{
			$subs->delete();
		}
		catch (Exception $e)
		{
			new Error(5, NULL, $e->getMessage());
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
