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

		static function find($stylist_search_id)
		{
			$found_stylist = null;
			$all_stylists = Stylist::getAll();
			foreach($all_stylists as $current_stylist)
			{
				$current_id = $current_stylist->getId();
				if ($current_id == $stylist_search_id)
				{
				$found_stylist = $current_stylist;
				}
			}
			return $found_stylist;
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

		function findClients()
		{
			$found_stylist = array();
			$table_matches = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getStylistId()};");
			foreach ($table_matches as $row)
			{
				$name = $row['name'];
				$id = $row ['id'];
				$stylist_id = $row ['stylist_id'];
				$new_client = new Client ($name, $id, $stylist_id);
				array_push ($found_stylist, $new_client);
			}
			return $found_stylist;
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