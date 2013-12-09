<?php

include 'language.php';

$login = "";
$single = TRUE;
$error = FALSE;
$errorMSG = '';
$db_users = "./db/users.json";
$expire = 3600*24*3;
$regex = '/^[a-zA-Z][a-zA-Z0-9]{1,14}$/';


/* If the cookie is set Load the login to display it in the form	*/
if(isset($_COOKIE["login"])){ $login = $_COOKIE["login"]; }

	/* If the user is passed by the form	*/
	if(!empty($_POST) && isset($_POST["connect"]))
	{
		$error = FALSE;

		/* If the login is correct	*/
		if( preg_match($regex, $_POST["login"]) )
		{
			$login = $_POST["login"];
			
			/* Test of unicity */
			if( file_exists($db_users) )
			{
				/* Loading users in an array        */
				$single = !array_key_exists($login, json_decode(file_get_contents($db_users), true));
			}
			else
			{
				$error = TRUE;
				$errorMSG = $error_users;
			}
			
			/* If the login is not used, then send or not the cookie and connection	*/
			if ($single)
			{
				/* If the option remember is set the cookie is sent to remember the login	*/
				if(isset($_POST["remember"])) setcookie('login', $login, time() + $expire, '/', 'fc.isima.fr', FALSE, TRUE);
					
				/* Else	delete the cookie	*/
				else setcookie('login', '', time() - $expire, '/', 'fc.isima.fr', FALSE, TRUE);

				session_start();
				$_SESSION["login"] = $login;
				header('location:connection.php');
			}
			/* If the login is already used	*/
			else
			{
				$error = TRUE;
				$errorMSG = $init_login_used;
			}
		}
		/* If the login is incorrect	*/
		else
		{
			$error = TRUE;
			$errorMSG = $init_bad_login . $regex . ' !';
		}
	}
?>