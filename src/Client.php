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
	}
?>	