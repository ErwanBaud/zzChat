<?php

/*
 * Function isntAuth() : return TRUE if the user is connected, FALSE else
 */
function isntAuth()
{
	/* If login isn't set, then  return on the home page */
	return (!isset($_SESSION["login"]) || empty($_SESSION["login"]));
}

/*
 * Function correctLogin() : return TRUE if the login is correct, FALSE else
 */
function correctLogin($login, $regex)
{
	return preg_match($regex, $login);
}

/*
 * Function uniqLogin() : return TRUE if the login is not used, FALSE else
 */
function uniqLogin($login, $db_users)
{
	$single = FALSE;

	if( file_exists($db_users) )
	{
		/* Loading users in an array        */
		$single = !array_key_exists($login, json_decode(file_get_contents($db_users), true));
	}
	return $single;
}

/*
 * Function cookie() : set or unset the cookie, return TRUE if success
 */
function cookie($login, $remember)
{
	$return = FALSE;
	$expire = 3600*24*3;
	
	/* If the option remember is set the cookie is sent to remember the login	*/
	if($remember) $return = setcookie('login', $login, time() + $expire, '/', 'fc.isima.fr', FALSE, TRUE);
					
	/* Else	delete the cookie	*/
	else $return = setcookie('login', '', time() - $expire, '/', 'fc.isima.fr', FALSE, TRUE);
	
	return $return;
}

/*
 * Function connect() : choose a color and add the user in users.json file, return TRUE if success, FALSE else
 */
function connect($login, $db_users)
{
	$return = FALSE;

	if( file_exists($db_users) )
	{
		/* Loading users in an array       */
		$content = json_decode(file_get_contents($db_users), true);
		
		/* Push in the array the user in the process of logon        */
		$content[$login] = randomColor();
        
		/* Sorting alphabetically to display in the future        */
		ksort($content);

        /* Write the new users list        */
		$return = file_put_contents($db_users, json_encode($content));
	}
	
	return $return;
}

/*
 * Function randomColor() : return a random color choosen in the array, good luck ^^
 */
function randomColor()
{
	$colors = array("Ali ceBlue", "AntiqueWhite", "Aqua", "AquaMarine", "Azure" ,
   "Beige" , "Bisque" , "Black" , "BlanchedAlmond" , "Blue" , "BlueViolet" , "Brown" , "BurlyWood" ,
   "CadetBlue" , "Chartreuse" , "Chocolate" , "Coral" , "CornflowerBlue" , "Cornsilk" , "Crimson" ,
   "DarkBlue" ,"DarkCyan" ,"DarkGoldenRod" ,"DarkGreen" ,"DarkKhaki" ,"DarkMagenta" ,
   "DarkOliveGreen" ,"DarkOrange" ,"DarkOrchid" ,"DarkRed" ,"DarkSalmon" ,"DarkSeaGreen" ,"DarkSlateBlue" ,
   "DarkSlateGray" ,"DarkTurquoise" ,"DarkViolet" ,"DeepPink" ,"DeepSkyBLue" ,"DimGray" ,"DodgerBlue" ,
   "Feldspar" ,"FireBrick" ,"FloralWhite" ,"ForestGreen" ,"Fuchsia" ,"Gainsboro" ,"GhostWhite" ,"Gold" ,
   "GoldenRod" ,"Green" ,"GreenYellow" ,"HoneyDew" ,"HotPink" ,"IndianRed" ,"Indigo" ,
   "Ivory" ,"Khaki" ,"Lavender" ,"LavenderBlush" ,"LawnGreen" ,"LemonChiffon" ,"LightBlue" ,
   "LightCoral" ,"LightCyan" ,"LightGoldenRodYellow" ,"LightGreen" ,"LightGrey" ,"LightPink" ,
   "LightSalmon" ,"LightSeaGreen" ,"LightSkyBlue" ,"LightSlateBlue" ,"LightSlateGray" ,"LightSteelBlue" ,
   "LightYellow" ,"Lime" ,"LimeGreen" ,"Linen" ,"Maroon" ,"MediumAquaMarine" ,"MediumBlue" ,"MediumOrchid" ,
   "MediumPurple" ,"MediumSeaGreen" ,"MediumSlateBlue" ,"MediumSpringGreen" ,"MediumTurquoise" ,"MediumVioletRed" ,
   "MidnightBlue" ,"MintCream" ,"MistyRose" ,"Moccasin" ,"NavajoWhite" ,"Navy" ,"OldLace" ,"Olive",
   "OliveDrab" ,"Orange" ,"OrangeRed" ,"Orchid" ,"PaleGoldenRod" ,"PaleGreen" ,"PaleTurquoise" ,
   "PaleVioletRed" ,"PapayaWhip" ,"PeachPuff" ,"Peru" ,"Pink" ,"Plum" ,"PowderBlue" ,"Purple" ,
   "Red" ,"RosyBrown" ,"RoyalBlue" ,"SaddleBrown" ,"Salmon" ,"SandyBrown" ,"SeaGreen" ,"SeaShell" ,
   "Sienna" ,"Silver" ,"SkyBlue" ,"SlateBlue" ,"SlateGray" ,"Snow" ,"SpringGreen" ,"SteelBlue" ,
   "Tan" ,"Teal" ,"Thistle" ,"Tomato" ,"Turquoise" ,"VioletRed" ,"Wheat" ,"White" ,"WhiteSmoke" ,
   "Yellow" , "YellowGreen");
   
   return $colors[array_rand($colors)];
}

/*
 * Function welcome() : return the HTML code of the header
 */
function welcome($login, $db_users)
{
	include 'language.php';

	/* Loading users in an array       */
	$users = json_decode(file_get_contents($db_users), true);
	$color = $users[$login];
	
	
	/* Generate header HTML code	*/
	return	'<div id="head1">
			<p id="head">' . $welcome . '
			</p>
		</div>
		<div id="head2">
			<form  action="deconnection.php" method="post">
				<a href="?lang=fr"><img src="./img/fr.jpg" width="16" height="11" alt="Français"></a>
				<a href="?lang=en"><img src="./img/en.jpg" width="16" height="11" alt="English"></a>
				<a href="?lang=sp"><img src="./img/sp.jpg" width="16" height="11" alt="Español"></a>
				<span style="color:' . $color . '">' . $login . '</span>
				<input id="buttonOff" type="submit" value="X" onclick="disconnect()"/>
			</form>
			
		</div>';
}


?>