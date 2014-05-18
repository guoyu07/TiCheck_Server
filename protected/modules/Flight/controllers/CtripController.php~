<?php

class CtripController extends Controller
{

	public function actionIndex()
	{
		$flight_asker = new D_FlightSearch;
		$flight_asker->DepartCity = "SHA";
		$flight_asker->ArriveCity = "BJS";
		$flight_asker->DepartDate = "2014-06-30";
		$flight_asker->main();
		$returnXML = $flight_asker->ResponseXML;
		if ($returnXML->FlightSearchResponse== NULL)
		{
			new Error(5, "check search option");
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes== NULL)
		{
			new Error(5, "check search option");
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute== NULL)
		{
			new Error(5, "check search option");
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList== NULL)
		{
			new Error(5, "check search option");
		}

		$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData;
		$this->store($flights);
		
	}

	private function store($flights)
	{
		foreach($flights as $flight)
		{
			$ctrip_flight = new \CtripFlight;
			$arr_flight = json_decode(json_encode($flight),TRUE);
			foreach ($arr_flight as $key=>$value)
			{
				if (is_array($value))
				{
					if (empty($value))
					{
						$arr_flight[$key] = null;
						continue;
					}
					$arr_flight[$key] = json_encode($value);
				}
			}
			$ctrip_flight->attributes = $arr_flight;
			try{
				if(!$ctrip_flight->save(false))
					var_dump($ctrip_flight->getErrors());
			}
			catch(Exception $e)
			{
				var_dump($ctrip_flight->getErrors());
				var_dump($ctrip_flight);
				var_dump($e->getMessage());
				exit;
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
