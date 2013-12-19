<?php
require_once 'functions.php';

class testFunctions extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{

	}
	
	public function testIsntAuth()
	{
		echo " Running testIsntAuth()\n";
		
		$this->assertTrue(isntAuth());
		
		$_SESSION["login"] = "";		
		$this->assertTrue(isntAuth());
		
		$_SESSION["login"] = "erwan";	
		$this->assertFalse(isntAuth());
	}
	
	public function testCorrectLogin()
	{
		echo " Running testCorrectLogin()\n";
		$regex = '/^[a-zA-Z][a-zA-Z0-9]{1,14}$/';
		
		$login1 = "erwan";
		$login2 = "12dgh5";
		$login3 = "azertyuiopazertyuiopâzertyuioazert";
		
		$this->assertEquals(1, correctLogin($login1, $regex));
		$this->assertEquals(0, correctLogin($login2, $regex));
		$this->assertEquals(0, correctLogin($login3, $regex));
	}
	
	public function testUniqLogin()
	{
		echo " Running testUniqLogin()\n";

		$db_users = "./db/usersTest.json";
		$file = fopen($db_users, 'w+');
		fclose($file);
		file_put_contents($db_users, '{"eb":"Chartreuse","erwan":"MistyRose","max":"PaleTurquoise"}');
		
		$login1 = "julien";
		$login2 = "max";
		
		$this->assertTrue(uniqLogin($login1, $db_users));
		$this->assertFalse(uniqLogin($login2, $db_users));
		
		unlink($db_users);
	}

	public function testConnect()
	{
		echo " Running testConnect()\n";

		$db_users = "./db/usersTest.json";
		$file = fopen($db_users, 'w+');
		fclose($file);
		
		$login1 = "julien";
		$login2 = "max";
		$login3 = "loic";
		
		connect($login1, $db_users);
        $this->assertRegExp('/^{"'. $login1 .'":"[a-zA-Z]*"}$/', file_get_contents($db_users));
		
		connect($login2, $db_users);
        $this->assertRegExp('/^{"'. $login1 .'":"[a-zA-Z]*","' . $login2 .'":"[a-zA-Z]*"}$/', file_get_contents($db_users));
		
		connect($login3, $db_users);
        $this->assertRegExp('/^{"'. $login1 .'":"[a-zA-Z]*","' . $login3 .'":"[a-zA-Z]*","' . $login2 .'":"[a-zA-Z]*"}$/', file_get_contents($db_users));
		
		unlink($db_users);
	}
	
	
	public function testWelcome()
	{
		echo " Running testWelcome()\n";
		include './lang/language.php';

		$db_users = "./db/usersTest.json";
		$file = fopen($db_users, 'w+');
		fclose($file);
		
		$login1 = "julien";		
		connect($login1, $db_users);
		
		$users = json_decode(file_get_contents($db_users), true);
		$color = $users[$login1];

		$this->assertEquals('<div id="head1">
			<p id="head">' . $welcome . '
			</p>
		</div>
		<div id="head2">
			<form  action="deconnection.php" method="post">
				<a href="?lang=fr"><img src="./img/fr.jpg" width="16" height="11" alt="Français"></a>
				<a href="?lang=en"><img src="./img/en.jpg" width="16" height="11" alt="English"></a>
				<a href="?lang=sp"><img src="./img/sp.jpg" width="16" height="11" alt="Español"></a>
				<span style="color:' . $color . '">' . $login1 . '</span>
				<input id="buttonOff" type="submit" value="X" onclick="disconnect()"/>
			</form>
			
		</div>', welcome($login1, $db_users));
		
		
		$login2 = "max";		
		connect($login2, $db_users);
		
		$users = json_decode(file_get_contents($db_users), true);
		$color = $users[$login2];

		$this->assertEquals('<div id="head1">
			<p id="head">' . $welcome . '
			</p>
		</div>
		<div id="head2">
			<form  action="deconnection.php" method="post">
				<a href="?lang=fr"><img src="./img/fr.jpg" width="16" height="11" alt="Français"></a>
				<a href="?lang=en"><img src="./img/en.jpg" width="16" height="11" alt="English"></a>
				<a href="?lang=sp"><img src="./img/sp.jpg" width="16" height="11" alt="Español"></a>
				<span style="color:' . $color . '">' . $login2 . '</span>
				<input id="buttonOff" type="submit" value="X" onclick="disconnect()"/>
			</form>
			
		</div>', welcome($login2, $db_users));
		
		unlink($db_users);
	}


	public function tearDown()
	{

	}
}

?>