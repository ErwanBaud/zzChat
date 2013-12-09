<?php

include 'language.php';

session_start();

/* If login isn't set, then  return on the home page */
if(!isset($_SESSION["login"]) || empty($_SESSION["login"]))
	header('location:index.php');

$login = $_SESSION['login'];

/* Generate header HTML code	*/
echo	'<div id="head1">
			<p id="head">' . $welcome . '
			</p>
		</div>
		<div id="head2">
			<form action="deconnection.php" method="post">
				<a href="?lang=fr"><img src="./img/fr.jpg" width="16" height="11" alt="Français"></a>
				<a href="?lang=en"><img src="./img/en.jpg" width="16" height="11" alt="English"></a>
				<a href="?lang=sp"><img src="./img/sp.jpg" width="16" height="11" alt="Español"></a>
				' . $login . ' <input id="buttonOff" type="submit" value="X" />
			</form>
		</div>'
?>