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
		// TODO 异步搜最低价

		//$this->createHistoryPrice($this->_subs);
		//echo (YiiBase::getPathOfAlias('application') . "yiic historyprice index --subs_id=" . $this->_subs->ID . " >/dev/null 2>/dev/null &");
		shell_exec(YiiBase::getPathOfAlias('application') . "/yiic historyprice index --subs_id=" . $this->_subs->ID . " >/dev/null 2>/dev/null &");
	}

	/*
	private function createHistoryPrice(Subscription $subs)
	{
		$date = new \DateGenerater;
		$date = $date->getDateYMD("-");
		$price = $subs->CurrentPrice;
		$history_price = HistoryPrice::model()->findByAttributes(array(
			'ID_subscription'=>$subs->ID,
			'Date'=>$date
		));
		if ($history_price==NULL || $history_price->count()==0)
		{
			$history_price = new HistoryPrice;
			$history_price->ID_subscription = $subs->ID;
			$history_price->Price = $price;
			$history_price->Date = $date;
			try
			{
				$history_price->save();
			}
			catch(Exception $e)
			{
				new Error(5, NULL, $e->getMessage());
			}
		}
		else
		{
			if ($history_price->Price == $price)
				return;
			$history_price->Price = ($price < $history_price->Price)?$price:$history_price;
			try
			{
				$history_price->save();
			}
			catch(Exception $e)
			{
				new Error(5, NULL, $e->getMessage());
			}
		}
	}
	 */
	
	/*
	private function currentPrice(Subscription $subs)
	{
		$date = new DateTime($subs->StartDate);
		$endDate = $subs->EndDate;
		$price = NULL;

		while ($date->format('Y-m-d') != $endDate)
		{
			$D_FlightSearch=new get_D_FLightSearch();
			$D_FlightSearch->DepartCity=$subs->DepartCity;
			$D_FlightSearch->ArriveCity=$subs->ArriveCity;
			$D_FlightSearch->DepartDate=$date->format('Y-m-d');
			$D_FlightSearch->EarliestDepartTime=$subs->EarliestDepartTime;
			$D_FlightSearch->LatestDepartTime=$subs->LatestDepartTime;
			$D_FlightSearch->AirlineDibitCode=$subs->AirlineDibitCode;
			$D_FlightSearch->IsLowestPrice="true";
			$D_FlightSearch->OrderBy="Price";
			$D_FlightSearch->main();
			$returnXML=$D_FlightSearch->ResponseXML;
			var_dump($returnXML);
			if ($returnXML->FlightSearchResponse== NULL)
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}
			if ($returnXML->FlightSearchResponse->FlightRoutes== NULL)
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}
			if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute== NULL)
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}
			if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList== NULL)
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}

			try
			{
				$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData;
			}
			catch(Exception $e)
			{
				throw new CException($e->getMessage());
			}
			
			//var_dump($flights);
			if (is_array($flights))
				$flight = $flights[0];
			else
				$flight = $flights;

			if ($price > $flight->Price || $price==NULL)
			{
				$price = $flight->Price;	
			}
			$date->add(new DateInterval('P1D'));
		}
	}
	 */
	

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
			new Error(5,NULL, "已订阅");
			return;
		}
		try
		{
			$user_subs->save();
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
