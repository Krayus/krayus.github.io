<?php 
$url = "http://localhost/osticket/api/tickets.json";
$key = "9E525C72026945F51EE8C2B6C482505C";
$ch = curl_init($url);
$array = array(
	'alert' => 'true',
	'autorespond' => 'false',
	'source' => 'API',
	'key' => $key,
	'email' => $_POST["email"], 
	'name' => $_POST["name"], 
	'phone' => $_POST["phone"], 
	'subject' => $_POST["title"], 
	'message' => $_POST["message"],
	'ip' => '127.0.0.1',
	'priority' => 2
);

$payload = json_encode($array);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
?>
