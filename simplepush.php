<?php

// Put your device token here (without spaces):
//$deviceToken = '439c258d38b086471e8f84a5f41b38b38a57acbe77a23361bca03cd9a97f2d68';
$deviceToken = '70a10324b2a2e4e6daaa8eee74a30c8bb196db31be43043cc94cb149d117aeb7';

// Put your private key's passphrase here:
$passphrase = 'TiCheck';

// Put your alert message here:
$message = 'TiCheck is lauching!';

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
var_dump($fp);

if (!$fp)
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
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;
var_dump($result);

// Close the connection to the server
fclose($fp);
