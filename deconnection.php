<?php

session_start();

/* If login isn't set, then  return on the home page */
if(!isset($_SESSION["login"]) || empty($_SESSION["login"]))
	header('location:index.php');

$db_users = "./db/users.json";
$login = $_SESSION['login'];

$error = FALSE;
$errorMSG = "";

if( file_exists($db_users) )
{
	/* Loading users in an array	*/
	$content = json_decode(file_get_contents($db_users), true);
	unset($content[$login]);

	/* Open file to overwrite the new users list	*/
	file_put_contents($db_users, json_encode($content));
}
else
{
	$error = TRUE;
	$errorMSG = "Erreur recuperation des users !";
}

session_destroy();
header('location:index.php');

?>
