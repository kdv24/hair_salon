<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once "src/Client.php";	
	require_once "src/Stylist.php";

	$DB = new PDO('pgsql:host=localhost; dbname=hair_salon_test');

	class ClientTest extends PHPUnit_Framework_TestCase
	{

	protected function tearDown()
	{
		Client::deleteAll();
	}

	function test_getName()
	{
		//Arrange
		$name = "Joe";
		$id = 1;
		$stylist_id = 2;
		$test_client = new Client($name, $id, $stylist_id);

		//Act
		$result=$test_client->getName($name);

		//Assert
		$this->assertEquals($name, $result);
	}

	function test_setName()
	{
		//Arrange
		$name = "Joe";
		$id = 1;
		$stylist_id = 2;
		$test_client = new Client($name, $id, $stylist_id);

		//Act
		$test_client->setName("Joe");
		$result= $test_client->getName();

		//Assert
		$this->assertEquals("Joe", $result);
	}

	function test_save()
	{
		//Arrange
		$name = "Joe";
		$id = 1;
		$stylist_id = 2;
		$test_client = new Client($name, $id, $stylist_id);

		//Act
		$test_client->save();

		//Assert
		$result= Client::getAll();
		var_dump($result);
		$this->assertEquals($test_client, $result[0]);
	}

	function test_update()
	{
		//Arrange
		$name = "Susanna";
		$id = 1;
		$stylist_id = 2;
		$test_name = new Client($name, $id, $stylist_id);
		$test_name->save();
		$new_name= "Linda";

		//Act
		$test_name->update($new_name);

		//Assert
		$this->assertEquals("Linda", $test_name->getName());
	}


	function test_getAll()
	{
		//Arrange
		$name = "Joe";
		$id= 1;
		$stylist_id = 10;
		$test_client = new Client($name, $id, $stylist_id);

		$name2 = "George";
		$id2 = 2;
		$stylist_id2 = 20;
		$test_client2 = new Client($name2, $id2, $stylist_id2);

		//Act
		$test_client->save();
		$test_client2->save();

		//Assert
		$result= Client::getAll();
		$this->assertEquals([$test_client, $test_client2], $result);
	}

	function test_deleteAll()
	{
		//Arrange
		$name = "Susanna";
		$id= 1;
		$stylist_id = 10;
		$test_client = new Client($name, $id,  $stylist_id);

		$name2 = "Staci";
		$id2 = 2;
		$stylist_id2 = 20;
		$test_client2 = new Client($name2, $id2, $stylist_id2);

		//Act
		$test_client->save();
		$test_client2->save();
		Client::deleteAll();

		//Assert
		$result= Stylist::getAll();
		$this->assertEquals([], $result);
	}
}
?>