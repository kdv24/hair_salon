<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

require_once "src/Client.php";	

$DB = new PDO('pgsql:host=localhost; dbname=hair_salon_test');

class ClientTest extends PHPUnit_Framework_TestCase
{
	// protected function tearDown()
	// {
	// 	Client::deleteAll();
	// }

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
		$test_stylist = new Stylist($name, $id, $stylist_id);

		//Act
		$test_stylist->save();

		//Assert
		$result= Stylist::getAll();
		$this->assertEquals($test_stylist, $result[0]);
	}

	// function test_update()
	// {
	// 	//Arrange
	// 	$name = "Susanna";
	// 	$id = 1;
	// 	$test_name = new Stylist($name, $id);
	// 	$test_name->save();
	// 	$new_name= "Linda";

	// 	//Act
	// 	$test_name->update($new_name);

	// 	//Assert
	// 	$this->assertEquals("Linda", $test_name->getName());
	// }


	// function test_getAll()
	// {
	// 	//Arrange
	// 	$name = "Susanna";
	// 	$id= 1;
	// 	$test_Stylist = new Stylist($name, $id);

	// 	$name2 = "Staci";
	// 	$id2 = 2;
	// 	$test_Stylist2 = new Stylist($name2, $id2);

	// 	//Act
	// 	$test_Stylist->save();
	// 	$test_Stylist2->save();

	// 	//Assert
	// 	$result= Stylist::getAll();
	// 	$this->assertEquals([$test_Stylist, $test_Stylist2], $result);
	// }

	// function test_deleteAll()
	// {
	// 	//Arrange
	// 	$name = "Susanna";
	// 	$id= 1;
	// 	$test_Stylist = new Stylist($name, $id);

	// 	$name2 = "Staci";
	// 	$id2 = 2;
	// 	$test_Stylist2 = new Stylist($name2, $id2);

	// 	//Act
	// 	$test_Stylist->save();
	// 	$test_Stylist2->save();
	// 	Stylist::deleteAll();

	// 	//Assert
	// 	$result= Stylist::getAll();
	// 	$this->assertEquals([], $result);
	// }
}
?>