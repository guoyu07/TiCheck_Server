<?php

class CancelController extends Subscription\controllers\DefaultController
{
	public function actionIndex()
	{
		if (isset($_POST['Subscription']) && isset($_POST['User']))
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
		else
		{
			throw new CException("post variable not enough");
		}
	}

	private function deleteRelation()
	{
		$subs = $this->_subs;
		$user = $this->_user;
		echo var_dump($subs);
		echo var_dump($user);
		$user_subs = new \UserSubscription;
		$user_subs->ID_user = $user->ID;
		$user_subs->ID_subscription = $subs->ID;
		$user_subs_adp = $user_subs->search();
		if ($user_subs_adp->itemCount)
		{
			$user_subs = $user_subs_adp->getData()[0];
			if ($user_subs->delete())
		    {
				echo "delete user_subs<br>";
			}
			else
			{
				throw new CDbException("failed delete user_subs");
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
			echo "delete subs fail" . $e->getMessage();
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
