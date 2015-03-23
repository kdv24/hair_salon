<?php
	class Client
	{
		private $name;
		private $id;
		private $stylist_id;

		function __construct($name, $id=null, $stylist_id=null)
		{
			$this->name = $name;
			$this->id = $id;
			$this->stylist_id = $stylist_id;
		}

		function getName()
		{
			return $this->name;
		}

		function setName($new_name)
		{
			$this->name = (string)$new_name;
		}

		function getId()
		{
			return $this->id;
		}

		function setId($new_id)
		{
			$this->id = (int)$new_id;
		}

		function getCategoryId()
		{
			return $this->stylist_id;
		}

		function setCategoryId($new_stylist_id)
		{
			$this->stylist_id = $new_stylist_id;
		}

		function save()
		{
			$statement= $GLOBALS['DB']->exec("INSERT INTO clients (client_name) VALUES ('{$this->getName()}') RETURNING id;");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$this->setId($result['id']);
		}
	}
?>	