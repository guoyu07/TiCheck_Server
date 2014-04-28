<?php
namespace Subscription\controllers;
class DefaultController extends \Controller
{

	protected $_subs;
	protected $_user;
	protected $_user_subs;
	public function actionIndex()
	{
		$this->render('index');
	}

	protected function prepareUserSubscription()
	{
		$user_subs = new \UserSubscription;
		$user_subs->ID_user = $this->_user->ID;
		$user_subs->ID_subscription = $this->_subs->ID;
		$user_subs_adp = $user_subs->search();
		if ($user_subs_adp->itemCount)
		{
			$this->_user_subs = $user_subs_adp->getData()[0];
			return;
		}
	}

	protected function prepareSubscription()
	{
		$subs = json_decode($_POST['Subscription'], true);
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
			$this->_subs = $subs_adp->getData()[0];
		}
		else
		{
			$lowestPrice = new \D_LowestPrice;
			$tiSubs->CurrentPrice = (int)$lowestPrice->searchFlight($tiSubs);
			if (!$tiSubs->save())
			{
				throw new CDbException("save subscription failed");
			}
			$this->_subs = $tiSubs;
		}
	}

	protected function prepareUser()
	{
		$user = json_decode($_POST['User'], true);
		if ($user['Email'] == NULL &&
			$user['Account'] == NULL)
		{
			throw new CDException("not enough data");
		}
		$tiUser = new \TiUser;
		$tiUser->attributes = $user;
		$user_adp = $tiUser->search(false);
		if (!$user_adp->itemCount)
		{
			throw new CDException("user info. error");
		}
		$this->_user = $user_adp->getData()[0];
	}
}
