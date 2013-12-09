<?php

session_start();

/* If login isn't set, then  return on the home page */
if(!isset($_SESSION["login"]) || empty($_SESSION["login"]))
        header('location:index.php');

$login = $_SESSION["login"];
$error = FALSE;
$errorMSG = "";
$db_users = "./db/users.json";

if( file_exists($db_users) )
{
        /* Loading users in an array        */
		$content = json_decode(file_get_contents($db_users), true);
		
        /* Push in the array the user in the process of logon        */
		$content[$login] = 0;
        
        /* Sorting alphabetically to display in the future        */
		ksort($content);

        /* Write the new users list        */
		file_put_contents($db_users, json_encode($content));
		header('location:zzChat.php');

}
else
{
        $error = TRUE;
        $errorMSG = "Echec récupération des users !";
}
?>