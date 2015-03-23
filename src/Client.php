<?php
	class Client
	{
		private $name;
		private $id;
		private $stylist_id;

		function __construct($name, $id=null, $stylist_id)
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

		function getStylistId()
		{
			return $this->stylist_id;
		}

		function setStylistId($stylist_id)
		{
			$this->stylist_id = (int) $stylist_id;
		}

		function save()
		{
			$statement= $GLOBALS['DB']->query("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()}) RETURNING id;");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$this->setId($result['id']);
		}

		function update($new_client_name)
		{
			$GLOBALS['DB']->exec("UPDATE clients SET client_name = '{$new_client_name}' WHERE id = {$this->getId()};");
			$this->setName($new_client_name);
		}

		static function getAll()
		{
			$all_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
			$clients_to_return = array();
			foreach($all_clients as $current_client) {
				$name = $current_client['client_name'];
				$id = $current_client['id'];
				$stylist_id = $current_client['stylist_id'];
				$new_client = new Client($name, $id, $stylist_id);
				array_push($clients_to_return, $new_client);
			}	
			return $clients_to_return;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM clients *;");
		}
	}
?>	