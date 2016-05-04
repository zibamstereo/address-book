<?php
	/**
		*  @Description:  Creating Database Class 
	*/	
	class DB
	{
		var $host;						//Database hostname
		var $user;						//Database username
		var $pass;					//Database password
		var $db;						//Database name
		var $dbcon;						//For creating a connection
		
		
		/**
			*  @brief Brief	Creating a construct for class DB
			*  
			*  @param [in] $host Database Hostname
			*  @param [in] $user Database Username
			*  @param [in] $pass Database Password
			*  @param [in] $data Database Name
			*  @param [in] $dbcon Database Connection
			*  @return Return_Description
			*  
			*  @details Details
		*/
		function __construct($host,$user,$pass,$db) {
			
			$this->host     = $host;
			$this->user     = $user;
			$this->pass     = $pass;
			$this->db    	= $db;
			$this->dbcon 	= new mysqli($this->host, $this->user, $this->pass, $this->db);
			
		}
		
	}

?>