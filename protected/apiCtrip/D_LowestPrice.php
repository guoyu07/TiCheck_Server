<?php
include_once('SDK.config.php');
include_once('Common/getDate.php');
class D_LowestPrice extends D_FlightSearch
{
	//public $StartDate;
	//public $EndDate;
	public $date;
	public $price;

	public function searchFlight(Subscription $subs)
	{
		//echo "search";
		$today = new DateTime('now');
		$date = new DateTime($subs->StartDate);
		$endDate = new DateTime($subs->EndDate);
		if ($endDate < $today)
			return;
		//$endDate->add(new DateInterval('P1D'));
		//$this->EndDate = $endDate->format('Y-m-d');
		while ($date <= $endDate)
		{
			sleep(3);
			//echo "while";
			if ($date < $today)
			{
				echo "yesterday";
				return;

			}
			
			$this->DepartCity=$subs->DepartCity;
			$this->ArriveCity=$subs->ArriveCity;
			$this->DepartDate=$date->format('Y-m-d');
			$this->EarliestDepartTime=$subs->EarliestDepartTime;
			$this->LatestDepartTime=$subs->LatestDepartTime;
			$this->AirlineDibitCode=$subs->AirlineDibitCode;
			$this->IsLowestPrice="true";
			$this->OrderBy="Price";
			$this->main();
			$returnXML=$this->ResponseXML;

			//exit;
			if (!$this->checkReturnXML($returnXML))
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}

			$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData;
			
			//var_dump($flights);
			if (is_array($flights))
				$flight = $flights[0];
			else
				$flight = $flights;

			//if ($flight->Price == 0)

			if ($this->price > $flight->Price || $this->price==NULL)
			{
				$this->price = $flight->Price;	
				if ($this->price == 0)
				{
					var_dump($returnXML);
					exit;
				}
			}
			$date->add(new DateInterval('P1D'));
			//var_dump($date);
		}
		return $this->price;
	}

	private function checkReturnXML($returnXML)
	{

		if ($returnXML->FlightSearchResponse== NULL)
		{
			return false;
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes== NULL)
		{
			return false;
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute== NULL)
		{
			return false;
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList== NULL)
		{
			return false;
		}
		if ($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData== NULL)
		{
			return false;
		}
		return true;
	}
}
?>
