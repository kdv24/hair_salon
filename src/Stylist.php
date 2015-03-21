<?php
	class Stylist
	{
		//properties of the class Stylist
		private $name;
		private $id;

		//sets order of properties for construction of object
		function __construct ($name, $id=null)
		{
		$this->name = $name;
		$this->id = $id;
		}

		function getName ()
		{	
			return $this->name;
		}

		function setName ($new_name)
		{
			$this->name=(string)$new_name;
		}

		function getId ()
		{
			return $this->id;
		}

		function setId ($new_id)
		{
			$this->id=(int)$new_id;
		}

		function save()//saves to the database
		{
			$statement = $GLOBALS['DB']->query("INSERT INTO stylists (stylist_name) VALUES ('{$this->getName()}') RETURNING id;");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$this->setId($result['id']);
		}

		function update($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE stylists SET stylist_name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name);
		}

		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
		}

		static function getAll() 
		{
			$all_stylists= $GLOBALS['DB']->query("SELECT * FROM stylists;");
			$stylists_array = array();
			foreach($all_stylists as $current_stylist)
			{
				$name = $current_stylist['stylist_name'];
				$id = $current_stylist['id'];
				$new_stylist = new Stylist($name, $id);
				array_push($stylists_array, $new_stylist);
			}
			return $stylists_array;
		}
		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM stylists *;");
		}
	}		
?>	