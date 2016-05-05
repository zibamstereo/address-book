<?php
	//include DB
	//require_once ('dbClass.php');
	/*
	* Creating Class for address-book called addBookClass
	*/
	
	class addBookClass
	{
		var $host;						//Database hostname
		var $user;						//Database username
		var $pass;						//Database password
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

			return $this->installDB(); //Installs the db
			
		}

	
		public function proccessSql($query)
		{
			$res = $this->dbcon->query($query);
			return $res ? true : false;
		}

		/**
		 *  @brief Brief		
		 *  
		 *  @return Return_Description: Creating a function to automatically install sql at startup page
		 *  
		 *  @details Details
		 */
		public function installDB()
		{
						
			$result = $this->dbcon->query("SHOW COLUMNS FROM addbook"); 
			
			if(!$result || $result->num_rows<= 0)
			{
				$qry ="CREATE TABLE `addbook` (".
				"`id` int(7) NOT NULL AUTO_INCREMENT,".
				"`name` varchar(35) NOT NULL,".
				"`phone` varchar(35) NOT NULL,".
				"`email` varchar(35) NOT NULL,".
				"PRIMARY KEY  (`id`)".
				") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                
				return $this->dbcon->query($qry); 
				
			}
		}
		
	}	