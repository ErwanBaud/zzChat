<?php

include 'language.php';
include 'functions.php';

$login = "";
$error = FALSE;
$errorMSG = '';
$db_users = "./db/users.json";
$regex = '/^[a-zA-Z][a-zA-Z0-9]{1,14}$/'; /* Regex for login syntax control	*/


/* If the cookie is set Load the login to display it in the form	*/
if(isset($_COOKIE["login"])){ $login = $_COOKIE["login"]; }

/* If the user is passed by the form	*/
if(!empty($_POST) && isset($_POST["connect"]))
{
	$error = FALSE;

	/* If the login is correct	*/
	if( correctLogin($_POST["login"], $regex))
	{
		$login = $_POST["login"];
			
		/* If the login is not used, then send or not the cookie and connection	*/
		if( uniqLogin($login, $db_users))
		{
			if( cookie($login, isset($_POST["remember"])) )
			{
				session_start();
				$_SESSION["login"] = $login;

				if(connect($login, $db_users))
					header('location:zzChat.php');
				else
				{
					$error = TRUE;
					$errorMSG = $error_users;
				}
			}
			/* If cookie() failed	*/
			else
			{
				$error = TRUE;
				$errorMSG = $init_cookie_failed;
			}
		}
		/* If uniqLogin() failed	*/
		else
		{
			$error = TRUE;
			$errorMSG = $init_login_used;
		}
	}
	/* If correctLogin() failed	*/
	else
	{
		$error = TRUE;
		$errorMSG = $init_bad_login . $regex . ' !';
	}
}

?>