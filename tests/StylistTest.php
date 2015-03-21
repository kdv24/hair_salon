<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

require_once "src/Stylist.php";	

$DB = new PDO('pgsql:host=localhost; dbname=hair_salon_test');

class SylistTest extends PHPUnit_Framework_TestCase
{

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


	// function test_getAll()
	// {
	// 	//Arrange
	// 	$name = "Susanna";
	// 	$id= 1;
	// 	$test_Stylist = new Stylist($name, $id);

	// 	$name2 = "Staci";
	// 	$id = 2;
	// 	$test_Stylist2 = new Stylist($name2, $id2);


	// 	//Act

	// 	//Assert
	// }
}
?>