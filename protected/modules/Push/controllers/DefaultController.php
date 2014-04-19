<?php
include_once ('/Library/WebServer/Documents/TiCheck_Server/SDK.config.php');
include_once (ABSPATH.'sdk/API/Flight/D_FlightSearch.php');

class DefaultController extends Controller
{
	private $_deviceToken;
	private $_message;
	public function actionIndex()
	{
		// push
		// Put your device token here (without spaces):
		$deviceToken = $this->_deviceToken;

		// Put your private key's passphrase here:
		$passphrase = 'TiCheck';

		// Put your alert message here:
		$message = $this->_message;

		////////////////////////////////////////////////////////////////////////////////

		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		$apns_con = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		var_dump($apns_con);

		if (!$apns_con)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

		echo 'Connected to APNS' . PHP_EOL;

		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'sound' => 'default'
			);

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($apns_con, $msg, strlen($msg));

		if (!$result)
			echo 'Message not delivered' . PHP_EOL;
		else
			echo 'Message successfully delivered' . PHP_EOL;
		var_dump($result);

		// Close the connection to the server
		fclose($apns_con);
	}


	public function actionSearch()
	{
		//echo dirname(__FILE__);
		$array_subs = Subscription::model()->findALl();
		foreach ($array_subs as $subs)
		{
			//echo var_dump($subs);
			echo "xxxxxxxxxxxxxxxx<br>";
			$this->searchFlight($subs);
		}
	}
	
	private function searchFlight(Subscription $subs)
	{
		$D_FlightSearch=new get_D_FLightSearch();
		$D_FlightSearch->DepartCity=$subs->DepartCity;
		$D_FlightSearch->ArriveCity=$subs->ArriveCity;
		$D_FlightSearch->DepartDate=$subs->StartDate;
		//$D_FlightSearch->EarliestDepartTime=$subs->EarliestDepartTime;
		//$D_FlightSearch->LatestDepartTime=$subs->LatestDepartTime;
		//$D_FlightSearch->AirlineDibitCode=$subs->AirlineDibitCode;
		$D_FlightSearch->IsLowestPrice="true";
		$D_FlightSearch->OrderBy="Price";
		$D_FlightSearch->main();
		$returnXML=$D_FlightSearch->ResponseXML;//返回的数据是一个XML
		//可以将返回的数据直接用json转换一下，打印出来，方便查看节点名称和数据
		//echo  json_encode($returnXML);
		//echo $returnXML->DomesticFlightData;
		//echo json_encode($returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->RecordCount);
		//var_dump($returnXML);
		$flights = $returnXML->FlightSearchResponse->FlightRoutes->DomesticFlightRoute->FlightsList->DomesticFlightData;
		//echo $flights[0]->Price;

		$price = $flights[0]->Price;
		if ($price != $subs->CurrentPrice)
		{
			$subs->CurrentPrice = $flights[0]->Price;
			$subs->save();
		}
		//echo json_encode($flights);
	}

}
