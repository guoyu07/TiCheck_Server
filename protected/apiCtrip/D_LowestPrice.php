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
			echo $date->format(Datetime::W3C);
			//echo "while";
			if ($date < $today)
			{
				echo "yesterday";
				continue;

			}
			
			$this->DepartCity=$subs->DepartCity;
			$this->ArriveCity=$subs->ArriveCity;
			$this->DepartDate=$date->format('Y-m-d');
			if ($this->EarliestDepartTime != null)
				$this->EarliestDepartTime=$this->DepartDate . "T" . $subs->EarliestDepartTime;
			if ($this->LatestDepartTime != null)
				$this->LatestDepartTime=$this->DepartDate . "T" . $subs->LatestDepartTime;
			$this->AirlineDibitCode=$subs->AirlineDibitCode;
			$this->IsLowestPrice="true";
			$this->OrderBy="Price";
			$this->main();
			$returnXML=$this->ResponseXML;

			if (!$this->checkReturnXML($returnXML))
			{
				//var_dump($this->returnXML);exit;
				
				$date->add(new DateInterval('P1D'));
				continue;
			}
			//var_dump($this->ResponseXML);exit;

			$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList;//->DomesticFlightData;
				$flights = $this->filterLowestPriceFlight($flights);
				$flight = $flights->DomesticFlightData;

			$this->str_responseXML=str_replace("<",@"&lt;",$this->str_responseXML);
			$this->str_responseXML=str_replace(">",@"&gt;",$this->str_responseXML);

			if ($this->price > $flight->Price || $this->price==NULL)
			{
				$this->price = $flight->Price;	
			}

			$date->add(new DateInterval('P1D'));
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

	private function filterLowestPriceFlight($obj_response_xml)
	{

		$lowest_price = $obj_response_xml->DomesticFlightData->Price;	
		$dom_element = dom_import_simplexml($obj_response_xml);
		$dom_list = $dom_element->getElementsByTagName('DomesticFlightData');

		foreach ($dom_list as $node)
		{
			if ((int)$node->getElementsByTagName('Price')->item(0)->nodeValue > $lowest_price)
			{
				$nodes[] = $node;
			}
		}
		echo "\n\n\n";
		var_dump($nodes);

		foreach ($nodes as $node)
			$node->parentNode->removeChild($node);

		$xml = simplexml_import_dom($dom_element);
		echo "\n\n\n";
		var_dump($xml);

		return $xml;
	}
}
?>
