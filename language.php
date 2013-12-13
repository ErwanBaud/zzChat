<?php

$default_lang = 'fr';	/* Default language	*/
$dir_lang = './lang/';	/* Language directory	*/
$extension = '.php';	/* Extension	*/
 
/* List of availables languages */
$languages = array('en', 'sp', 'fr');
$lang = '';
 
/* If there is $_GET['lang'] in the list of availables languages */
if (isset($_GET['lang']) && in_array($_GET['lang'], $languages))
    $lang = $_GET['lang'];

/* Else if $_SESSION["lang"] is already set we use its value	*/
else if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $languages))
    $lang = $_SESSION['lang'];
 
/* Set $_SESSION["lang"] variable */
if (!empty($lang))
	$_SESSION['lang'] = $lang;
 

/* Always include the default language file */
include($dir_lang . $default_lang . $extension);
 
/* After, include the language file choosen if it exist*/
if (!empty($lang) && $lang != $default_lang && is_file($dir_lang. $lang . $extension))
    include($dir_lang . $lang . $extension);
?>