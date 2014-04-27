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
		$date = new DateTime($subs->StartDate);
		$endDate = new DateTime($subs->EndDate);
		$endDate->add(new DateInterval('P1D'));
		$this->EndDate = $endDate->format('Y-m-d');
		while (strcmp($date->format('Y-m-d') , $this->EndDate)!=0) 
		{
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

			var_dump($returnXML);
			//exit;
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

				$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData;
			
			//var_dump($flights);
			if (is_array($flights))
				$flight = $flights[0];
			else
				$flight = $flights;

			if ($this->price > $flight->Price || $this->price==NULL)
			{
				$this->price = $flight->Price;	
			}
			$date->add(new DateInterval('P1D'));
			var_dump($date);
		}
		return $this->price;
	}
}
?>
