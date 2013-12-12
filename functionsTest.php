<?php
//require_once 'PHPUnit/Framework.php';
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


	public function tearDown()
	{

	}
}

?>