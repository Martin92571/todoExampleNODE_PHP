<?php
session_start();
/*
session_start:
1) checks if a session is already going
2) starts a new session if none is going
3) creates and populates the $_SESSION superglobal
*/

unset($_SESSION['userID']);
session_destroy();
session_commit();

$output = [
	'success' => true,
];
print(json_encode($output));
?>