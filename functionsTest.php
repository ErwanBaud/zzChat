<?php
//require_once 'PHPUnit/Framework.php';
require_once 'functions.php';

class testFunctions extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		
	}
	
	public function testCorrectLogin()
	{
		echo "Running testCorrectLogin()\n";
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
		echo "Running testUniqLogin()\n";
		$db_users = "./db/users.json";
		$login1 = "julien";
		$login2 = "max";
		
		$this->assertTrue(uniqLogin($login1, $db_users));
		$this->assertFalse(uniqLogin($login2, $db_users));
	}
	
	public function tearDown()
	{

	}
}

?>