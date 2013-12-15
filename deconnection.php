<?php
include 'functions.php';

session_start();

if( isntAuth()) 
		header('location:index.php');

$db_users = "./db/users.json";
$login = $_SESSION['login'];

$error = FALSE;
$errorMSG = "";

if( file_exists($db_users) )
{
	/* Loading users in an array	*/
	$content = json_decode(file_get_contents($db_users), true);
	/* Delete the current user	*/
	unset($content[$login]);

	/* Open file to overwrite the new users list	*/
	file_put_contents($db_users, json_encode($content));
}
else
{
	$error = TRUE;
	$errorMSG = $error_users;
}

session_destroy();
header('location:index.php');

?>
