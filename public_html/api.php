<?php
include ("functions/array_generator.php");
include ("functions/send_data.php");
include ("functions/sql_connection.php");
include ("functions/send_mails.php");
#header( "refresh:10;url=index.php" );

#Setting debug True
#ini_set('error_reporting', E_ALL);

#Production
#ini_set('error_reporting', 0);

#Build Array
/*Setting Variables*/
$credentials = parse_ini_file("credentials/access.ini");
$servername =$credentials["servername"];
$username = $credentials["username"];
$password = $credentials["password"];
$database = $credentials["database"];

/*Setting Variables*/
$array_built = new ArrayBuilder($_POST);
$data = $array_built->run();
$data["key"] = $credentials["key"];
$data["url"] = $credentials["url"];

#Send request through curl

$curl_requests = new SendCurl($data);
$ticket_result = (int) $curl_requests->send();

#$team_name = $data["campus"]."_".$data["area"]."_".$data["topic"];
#THE SELECTOR WOULD BE HERE!
$team_name = $data["campus"]."_".$data["topic"];

$sql = new SQL_CONNECT(
	$servername = $servername,
	$username = $username,
	$password = $password,
	$database = $database,
	$ticket_id = $ticket_result,
	$team_name = $team_name,
	$ticket_area = $data["area"]
);

#var_dump($sql->get_connection());
$agent_info = $sql->set_ticket_to_agent();


$email_array = array(
    "username" => $_POST["name"],
    "email" => $_POST["email"],
    "ticket_number" => $ticket_result ,
    "agent_username" => $agent_info["agent_name"],
    "agent_mail_username" => $agent_info["email_agent"],
    "mail_username" => $credentials["mail_user"],
    "mail_password" => $credentials["mail_password"],
    "mail_server" => $credentials["mail_server"],
    "mail_port" => $credentials["mail_port"],
    'title' => $_POST["title"]." RUT: ".$_POST["rut"],
    'message' => $_POST["message"],
    'campus' => $_POST["campus"],
);

send_mail($email_array);
header("location:thanks.php?ticket_number=".$ticket_result);
?>