<?php

class ModifyController extends Subscription\controllers\DefaultController
{
	private $_newSubs=NULL;
	public function actionIndex()
	{
		$this->prepareUser();
		$this->prepareSubscription();
		$this->prepareNewSubscription();
		$this->_subs = null;
		$this->_subs = $this->_newSubs;
		$this->prepareUserSubscription();

		if ($this->_newSubs != NULL)
		{
			$this->_user_subs->ID_subscription = $this->_subs->ID;
			$this->_user_subs->save();
		}
	}

	protected function prepareNewSubscription()
	{
		if (!isset($_POST['NewSubscription']))
			new Error(4, 'NewSubscription');
		$subs = json_decode($_POST['NewSubscription'], true);
		//echo var_dump($subs);

		if ($subs['DepartCity'] == NULL ||
			$subs['ArriveCity'] == NULL ||
			$subs['StartDate'] == NULL ||
			$subs['EndDate'] == NULL
			)
		{
			new \Error(4, array('DepartCity', 'ArriveCity', 'StartDate', 'EndDate'));
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
			$this->_newSubs->attributes = $subs;
			try
			{
				if(!$this->_newSubs->save())
				{
					new \Error(5, null, $this->_newSubs->getErrors());
				}
			}
			catch(Exception $e)
			{
				new Error(5, NULL, $e->getMessage());
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
