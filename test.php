<?php
    $msgs = array(
			array(
				"date" => 0,
				"autor" => 'toto',
				"text" => 'kikoo'
			),
			array(
				"date" => 1,
				"autor" => 'eb',
				"text" => 'salut toi !'
			)
		);
		
    $msgs_users = './db/zzChat.json';
	
	
	
	
	
	
	$content = json_decode(file_get_contents($msgs_users), true);
	
	print_r(sizeof($content));
			while(sizeof($content) > 9) array_shift($content);
	        /* Push in the array the user in the process of logon  */      
 	  array_push($content, array("date" => time(), "autor" => 'eb', "text" => 'hey'));
	  
	  
	print_r(sizeof($content));
	 
	file_put_contents($msgs_users, json_encode($content));
        
        /* Sorting alphabetically to display in the future  */      
/* 	   ksort($content);
	
		 var_dump($content);
		 print('<br>');
		$content = json_encode($content);
	
		 var_dump($content);
		 print('<br>');
*/

?>
