<?php

namespace Subscription\controllers;
class ModifyController extends \Subscription\controllers\DefaultController
{
	private $_newSubs=NULL;
	public function actionIndex()
	{
		$this->prepareUser();
		$this->prepareSubscription();

		/* 准备订阅类的时候会自动count 加1，但是这里并不是准备新的订阅，因此要把count减回去 */
		$this->_subs->Count = $this->_subs->Count - 1;

		if ($this->_subs->Count == 1)
		{
			//echo "yes";

			//exit;
			$this->_subs->attributes = $this->prepareNewSubscriptionArray();
		}
		else
		{
			$this->prepareNewSubscription();
			$old_user_subs = \UserSubscription::model()->findByAttributes(array('ID_subscription'=>$this->_subs->ID, 'ID_user'=>$this->tiUser->ID));
			try
			{
				if ($old_user_subs!=null && !$old_user_subs->delete())
				{
					new \Error(5,null,json_encode($old_user_subs->getErrors()));
				}
			}
			catch(Exception $e)
			{
				new \Error(5,null,$e->getMessage());
			}
			$this->_subs->Count = $this->_subs->Count - 1;

			if ($this->_newSubs != NULL)
			{
				$this->_user_subs = new UserSubscription;
				$this->_user_subs->ID_subscription = $this->_newSubs->ID;
				$this->_user_subs->ID_user = $this->tiUser->ID;
				$this->saveActiveRecord($this->_user_subs);
			}
		}

		$this->saveActiveRecord($this->_subs);
		if ($this->_user_subs == null)
			shell_exec(YiiBase::getPathOfAlias('application') . "/yiic historyprice index --subs_id=" . $this->_subs->ID . " >/dev/null 2>/dev/null &");
		else
			shell_exec(YiiBase::getPathOfAlias('application') . "/yiic historyprice index --subs_id=" . $this->_user_subs->ID_subscription . " >/dev/null 2>/dev/null &");
		new \Error(1);
	}

	protected function prepareNewSubscriptionArray()
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

		return $subs;
	}

	protected function prepareNewSubscription()
	{
		$subs = $this->prepareNewSubscriptionArray();
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
			$this->saveActiveRecord($this->_newSubs);
		}
	}

	public function saveActiveRecord(CActiveRecord $record)
	{
		try
		{
			if (!$record->save())
			{
				new \Error(5,null,json_encode($record->getErrors()));
			}
		}
		catch(Exception $e)
		{
			new \Error(5,null,$e->getMesaage());
		}
	}

	protected function prepareSubscription()
	{
		if (!isset($_POST['Subscription']))
			new \Error(4, 'Subscription');
		$subs = json_decode($_POST['Subscription'], true);
		//var_dump($subs);

		if ($subs['DepartCity'] == NULL ||
			$subs['ArriveCity'] == NULL ||
			$subs['StartDate'] == NULL ||
			$subs['EndDate'] == NULL)
			new \Error(4, array('DepartCity', 'ArriveCity', 'StartDate', 'EndDate'));

		$tiSubs = new \Subscription;
		$tiSubs->attributes = $subs;
		$subs_adp = $tiSubs->search();
		if ($subs_adp->itemCount)
		{
			$this->_subs = $subs_adp->getData()[0];
			$this->_subs->Count = $this->_subs->Count + 1;
		}
		else
		{
			/*
			$lowestPrice = new \D_LowestPrice;
			$tiSubs->CurrentPrice = (int)$lowestPrice->searchFlight($tiSubs);
			 */
			new \Error(5, null, "no such subscription");
		}
		try
		{
			if (!$this->_subs->save())
			{
				new \Error(5, null, json_encode($this->_subs->getErrors()));
			}
		}
		catch(Exception $e)
		{
			new \Error(5, NULL, $e->getMessage());
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
