<?php

require_once('mysqlconnect.php');

$query = "SELECT * FROM `todoItems` WHERE `ID`='{$_GET['itemID']}'";

//print("query = $query");

$result = mysqli_query($conn, $query);

$output = [
	'success' => false,
	'data' => [],
	'error' => []
];

if($result){
	//the query successfully ran
	if(mysqli_num_rows($result) > 0){
		//there was data
		while( $row = mysqli_fetch_assoc($result)){
			//get all the data
			$output['data'][] = $row;
		}
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




















