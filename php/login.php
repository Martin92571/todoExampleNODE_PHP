<?php
session_start();
$_POST['password'] = sha1($_POST['password']);
require_once('mysqlconnect.php');

$query = "SELECT ID, username, email FROM `users` WHERE `email`='{$_POST['email']}' AND `password`='{$_POST['password']}' ";

$result = mysqli_query($conn, $query);
$output = [
	'success' => false
];

if($result){
	if(mysqli_num_rows($result)>0){
		$userData = mysqli_fetch_assoc($result);
		$output['user'] = $userData;
		$output['success'] = true;
		$_SESSION['userID'] = $userData['ID'];
		
		// $query = "INSERT INTO userSessions SET userID = {$userData['ID']}, started=NOW(), token = '".session_id()."', IP_Address = '{$_SERVER['REMOTE_ADDR']}'";
		// print("query = $query");
		// mysqli_query($conn, $query);
	} else {
		$output['error'] = 'invalid user name or password';
	}
} else {
	$output['error'] = 'cannot attempt login';
}

print( json_encode($output));
?>