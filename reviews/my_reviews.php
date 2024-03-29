<?php

// dependecies
require_once('../path.inc');
require_once('../get_host_info.inc');
require_once('../rabbitMQLib.inc');

// get local auth key
session_start();
$auth_key = $_SESSION['key'];


// eventually we should change this to use ENVIORNMENT variables instead
$request = array(
    'type' => "get_user_reviews",
    'auth_key' => $auth_key
    
);

// connect to rabbitMQ
$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
$response = $client->send_request($request);

// log response
echo "Server response: \n";
print_r($response);

// validate response
if ($response['status'] !== "ok"){
	die("Could not connect to server.");
}

// parse as json
$json_response = json_encode($response);
header('Content-Type: application/json');

// return data
echo $json_data

?>
