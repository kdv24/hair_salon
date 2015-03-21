<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

require_once "src/Stylist.php";	

$DB = new PDO('pgsql:host=localhost; dbname=hair_salon_test');

class SylistTest extends PHPUnit_Framework_TestCase
{
	protected function tearDown()
	{
		Stylist::deleteAll();
	}

	function test_getName()
	{
		//Arrange
		$name = "Susanna";
		$id = 1;
		$test_Stylist = new Stylist($name, $id);

		//Act
		$result=$test_Stylist->getName($name);

		//Assert
		$this->assertEquals($name, $result);
	}

	function test_setName()
	{
		//Arrange
		$name = "Susanna";
		$id = 1;
		$test_stylist = new Stylist($name, $id);

		//Act
		$test_stylist->setName("Susanna");
		$result= $test_stylist->getName();

		//Assert
		$this->assertEquals("Susanna", $result);
	}

	function test_save()
	{
		//Arrange
		$name = "Susanna";
		$id = 1;
		$test_stylist = new Stylist($name, $id);

		//Act
		$test_stylist->save();

		//Assert
		$result= Stylist::getAll();
		$this->assertEquals($test_stylist, $result[0]);
	}

	function test_update()
	{
		//Arrange
		$name = "Susanna";
		$id = 1;
		$test_name = new Stylist($name, $id);
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
		$name = "Susanna";
		$id= 1;
		$test_Stylist = new Stylist($name, $id);

		$name2 = "Staci";
		$id2 = 2;
		$test_Stylist2 = new Stylist($name2, $id2);

		//Act
		$test_Stylist->save();
		$test_Stylist2->save();

		//Assert
		$result= Stylist::getAll();
		$this->assertEquals([$test_Stylist, $test_Stylist2], $result);
	}

	function test_deleteAll()
	{
		//Arrange
		$name = "Susanna";
		$id= 1;
		$test_Stylist = new Stylist($name, $id);

		$name2 = "Staci";
		$id2 = 2;
		$test_Stylist2 = new Stylist($name2, $id2);

		//Act
		$test_Stylist->save();
		$test_Stylist2->save();
		Stylist::deleteAll();

		//Assert
		$result= Stylist::getAll();
		$this->assertEquals([], $result);
	}
}
?>