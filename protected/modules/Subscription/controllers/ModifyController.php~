<?php

class ModifyController extends Subscription\controllers\DefaultController
{
	private $_newSubs=NULL;
	public function actionIndex()
	{
		if (isset($_POST['Subscription']) && isset($_POST['User']))
		{
			$this->prepareUser();
			$this->prepareSubscription();
			$this->prepareNewSubscription();
			$this->prepareUserSubscription();

			if ($this->_newSubs != NULL)
			{
				$this->_user_subs->ID_subscription = $this->_subs->ID;
				$this->_user_subs->save();
			}
		}
		else
		{
			echo "not enough data";
		}
	}

	protected function prepareNewSubscription()
	{
		$subs = json_decode($_POST['NewSubscription'], true);
		//echo var_dump($subs);

		if ($subs['DepartCity'] == NULL ||
			$subs['ArriveCity'] == NULL ||
			$subs['StartDate'] == NULL ||
			$subs['EndDate'] == NULL
			)
		{
			throw new CDException("not enough data");
		}
		
		$tiSubs = new \Subscription;
		$tiSubs->attributes = $subs;
		$subs_adp = $tiSubs->search();
		if ($subs_adp->itemCount)
		{
			$this->_newSubs = $subs_adp->getData()[0];
		}
		else
		{
			$this->_subs->attributes = $subs;
			if ($this->_subs->save())
			{
				echo "save new subscription";	
			}
			else
			{
				echo "save new subscription fail";
			}

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
