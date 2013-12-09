<?php

session_start();

include 'language.php';

$login = $_SESSION['login'];
$db_users = "./db/users.json";
$db_msgs = "./db/zzChat.json";
$msg_limit = 100;

$d = array();

/* If login isn't set, then  return on the home page */
if(!isset($_SESSION["login"]) || empty($_SESSION["login"]) || !isset($_POST["action"]))
        header('location:index.php');

else
{
        extract($_POST);
        
        
        /**
         * Action : addmsg
         */
        if($_POST["action"] == "addmsg" && $_POST["message"] != "")
        {
			$login = htmlentities(utf8_decode($login));
			$message = htmlentities(utf8_decode($message));
			
			$content = json_decode(file_get_contents($db_msgs), true);
			
			while(sizeof($content) >= $msg_limit) array_shift($content);
			
			$tab = end($content);
			$id = $tab["id"];
			
			array_push($content, array( "id" => $id+1, "date" => date("H:i:s"), "autor" => $login, "text" => $message));
			
			file_put_contents($db_msgs, json_encode($content));
			
			$d["error"] = "ok";
		}
        
        
        /**
         * Action : getMessages
         */
        if($_POST["action"] == "getMessages")
        {
        	$currentId = 0;
			$content = json_decode(file_get_contents($db_msgs), true);
			
			$t = end($content);
			$id = $t["id"];
			
			foreach($content as $tab)
				$d["messages"] .= "<p>[" . $tab["date"] . "] <strong>" . $tab["autor"] . "</strong> : " . $tab["text"] . "</p>\n";

			if( $currentId < $id )
			{
				$d["scroll"] = "yes";
				$currentId = $id;
			}
			else $d["scroll"] = "no";
			
			$d["error"] = "ok";
		}
        
        
        /**
         * Action : getConnected
         */
		if($_POST["action"] == "getConnected")
		{
			if ( file_exists($db_users) )
			{
				/* Loading users in an array        */
				$content = json_decode(file_get_contents($db_users), true);
                
				/* Display the time, the number and the others users online        */
				$nb = count($content) - 1;
				$d["online"] = date("H:i:s") . '<br><br>';
				$d["online"] .= $nb . $online . '<br><br>';

				foreach ($content as $user => $n)
					if($user != $login) $d["online"] .= $user . "<br>";
				unset($user);
			}
			$d["error"] = "ok";
		} 
}

echo json_encode($d);
?>