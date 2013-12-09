<?php

header("Cache-Control: no-cache"); //vider le cache
$default_lang = 'fr'; //langue par défaut
$dir_lang = './lang/'; //répertoire des fichiers langues
$extension = '.php'; //extension des fichiers langue
 
/*
 * liste des fichiers langue disponibles
 * s'assurer que chacun de ces fichiers existe bien dans
 * le répertoire
*/
$languages = array('en', 'sp', 'fr');
$lang = '';
 
/*
 * si le paramètre "lang" est défini dans l'url et s'il existe dans la liste
 * $lang prend la valeur de $_GET['lang']
 */
if (isset($_GET['lang']) && in_array($_GET['lang'], $languages)) {
    $lang = $_GET['lang'];
	$_SESSION['lang'] = $lang;
}
 
/*
 * sinon vérifier prendre la valeur du cookie $_COOKIE['lang']
 * (s'il est défini)
 */
 
else if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $languages)) {
    $lang = $_SESSION['lang'];
}
 
/*
 * sauver la valeur de $lang dans le cookie $_COOKIE['lang']
 */
 
if (!empty($lang)) {
	$_SESSION['lang'] = $lang;
}
 
/*
 * quelque soit la langue d'affichage sélectionnée
 * inclure le fichier langue par défaut pour ne manquer
 * aucune variable
 */
include($dir_lang . $default_lang . $extension);
 
/*
 * seulement après, vérifier que le fichier langue
 * défini dans $lang existe et l'inclure
 */
if (!empty($lang) && $lang != $default_lang && 
 
is_file($dir_lang. $lang . $extension)) {
    include($dir_lang . $lang . $extension);
}
?>