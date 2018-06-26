<?php
session_start();
require_once('mysqlconnect.php');

$output = [
	'success' => false,
	'data' => [],
	'error' => []
];
if(!isset($_SESSION['userID'])){
	$output['error'][] = 'must be logged in to use this endpoint';
	exit(json_encode($output));
}

$userQuery = "SELECT username, email FROM users WHERE ID = {$_SESSION['userID']}";

$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

$query = "SELECT `ID`, `title`, `dueDate` FROM `todoItems` WHERE userID = {$_SESSION['userID']}";

//print("query = $query");

$result = mysqli_query($conn, $query);



if($result){
	//the query successfully ran
	if(mysqli_num_rows($result) > 0){

		//there was data
		while( $row = mysqli_fetch_assoc($result)){
			//get all the data
			$output['data'][] = $row;
		}
		$output['user'] = $userData;
		$output['success'] = true;

	} else {
		//there was not data
		$output['error'][] = 'no data available';
	}
} else {
	//the query failed
	$output['error'][] = mysqli_error($conn);
}

$output_json = json_encode($output);

print($output_json);

?>




















