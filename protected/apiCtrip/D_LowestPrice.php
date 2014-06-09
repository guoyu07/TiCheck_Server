<?php
include_once('SDK.config.php');
include_once('Common/getDate.php');
class D_LowestPrice extends D_FlightSearch
{
	//public $StartDate;
	//public $EndDate;
	//public $date;
	public $price;
	public $str_xml;
	public $obj_xml;

	public function searchFlight(Subscription $subs)
	{
		//echo "search";
		$today = new DateTime('now');
		$date = new DateTime($subs->StartDate);
		$endDate = new DateTime($subs->EndDate);
		if ($endDate < $today)
			return;
		while ($date <= $endDate)
		{
			sleep(3);
			if ($date < $today)
			{
				echo "yesterday";
				$date->add(new DateInterval('P1D'));
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

			/*
				查看返回代码是否为成功
			 */
			$resultCode = $returnXML->Header->attributes()->ResultCode;
			echo "result code: ". $resultCode . "\n";

			if ($resultCode != 'Success')
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}

			/*
				查看返回航班数量是否为0
			 */
			$recordCount = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->RecordCount;

			if ($recordCount == 0)
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}


			$this->obj_xml[] = $returnXML;

			if (!$this->checkReturnXML($returnXML))
			{
				$date->add(new DateInterval('P1D'));
				continue;
			}
			//print_r($returnXML);

			$flight = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData;

			if ($this->price > $flight->Price || $this->price==NULL)
			{
				//echo "\n";
				//print_r($flight->Price);
				//echo "\n";
				$this->price = $flight->Price;	
				echo "price updated to ". $this->price . "\n";
			}

			$date->add(new DateInterval('P1D'));
		}

		$this->deleteNoneLowestPriceFlights();
		return $this->price;
	}

	private function deleteNoneLowestPriceFlights()
	{
		foreach ($this->obj_xml as $returnXML)
		{
			$str_responseXML = $this->filterLowestPriceFlight($returnXML, $this->price);
			if ($str_responseXML == null)
				continue;
			else
				$str_responseXML = $str_responseXML->asXML();
			$str_responseXML= str_replace(">",@"&gt;",$str_responseXML);
			$str_responseXML = str_replace("<",@"&lt;",$str_responseXML);
			$this->str_xml[] = $str_responseXML;
		}
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

	private function filterLowestPriceFlight($obj_response_xml, $lowest_price)
	{

		$dom_element = dom_import_simplexml($obj_response_xml);
		$dom_list = $dom_element->getElementsByTagName('DomesticFlightData');

		$nodes = null;
		foreach ($dom_list as $node)
		{
			if ((int)$node->getElementsByTagName('Price')->item(0)->nodeValue > $lowest_price)
			{
				$nodes[] = $node;
			}
		}

		if (!($nodes == null))
		{
			foreach ($nodes as $node)
				$node->parentNode->removeChild($node);
		}

		$dom_list = $dom_element->getElementsByTagName('DomesticFlightData');
		if ($dom_list->length == 0)
		{
			return null;
		}

		$xml = simplexml_import_dom($dom_element);
		return $xml;
	}
}
?>
