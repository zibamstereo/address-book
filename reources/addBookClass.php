<?php
	//include DB
	require_once ('dbClass.php');
	/*
		* Creating Class for address-book called addBookClass
	*/
	class addBookClass 
	{
		private $host;						//Database hostname
		private $user;						//Database username
		private $password;					//Database password
		private $db;						//Database name
		
		function __construct($host,$user,$pass,$data) {
			
			$this->host     = $host;
			$this->user     = $user;
			$this->pass     = $pass;
			$this->data     = $data;
			$dbcon 	= new DB($this->host, $this->user, $this->pass, $this->data);
		}
	
		public function query($query)
		{
			return $dbcon->query($query);
		}
		
	}	