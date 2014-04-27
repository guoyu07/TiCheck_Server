<?php


class CreateController extends Controller
{
	private $_subs;
	private $_user;
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
			// user
			$this->prepareUser();

			// subscription
			$this->prepareSubscription();


			// modify database
			$this->createRelation();
		}
		else
		{
			throw new CDException("post variable not enough");
		}
	}

	private function prepareSubscription()
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
		
		$tiSubs = new Subscription;
		$tiSubs->attributes = $subs;
		$subs_adp = $tiSubs->search(false);
		if ($subs_adp->itemCount)
		{
			$this->_subs = $subs_adp->getData()[0];
		}
		else
		{
			$lowestPrice = new D_LowestPrice;
			$tiSubs->CurrentPrice = (int)$lowestPrice->searchFlight($tiSubs);
			if (!$tiSubs->save())
			{
				throw new CDbException("save subscription failed");
			}
			$this->_subs = $tiSubs;
		}
	}

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
				throw new CDException($e->getMessage());
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
	
	private function prepareUser()
	{
		$user = json_decode($_POST['User'], true);
		if ($user['Email'] == NULL &&
			$user['Account'] == NULL)
		{
			throw new CDException("not enough data");
		}
		$tiUser = new TiUser;
		$tiUser->attributes = $user;
		$user_adp = $tiUser->search(false);
		if (!$user_adp->itemCount)
		{
			throw new CDException("user info. error");
		}
		$this->_user = $user_adp->getData()[0];
	}

	private function createRelation()
	{
		$subs = $this->_subs;
		$user = $this->_user;
		echo var_dump($subs);
		echo var_dump($user);
		$user_subs = new UserSubscription;
		$user_subs->ID_user = $user->ID;
		$user_subs->ID_subscription = $subs->ID;
		if ($user_subs->save())
		{
			echo "saved user_subs<br>";
		}
		else
		{
			throw new CDbException("failed save");
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
