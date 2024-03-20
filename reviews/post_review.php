<?php

// dependecies
require_once('../path.inc');
require_once('../get_host_info.inc');
require_once('../rabbitMQLib.inc');

// get local service data
session_start();
$auth_key = $_SESSION['key'];
$auth_key = $_SESSION['user_id'];

$review_rating = $_POST['review_rating'];
$review_body = $_POST['review_body'];

// pack data for request
$request = array(
    'type' => "post_review",
    'auth_key' => $auth_key,
    'user_id' => $user_id,
    'service_id' => $service_id,
    'review_rating' => $review_rating,
    'review_body' => $review_body
);

// connect to rabbitMQ
$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
$response = $client->send_request($request);

// log response
echo "Server response: \n";
print_r($response);

// validate response
if ($response['status'] !== "ok") {
	die("Could not connect to server.");
}

// parse as json
$json_response = json_encode($response);
header('Content-Type: application/json');

// return data
echo $json_data;

?>
