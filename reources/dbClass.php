<?php
	/**
		*  @Description:  Creating Database Class 
	*/	
	class DB
	{
		private $host;						//Database hostname
		private $user;						//Database username
		private $password;					//Database password
		private $db;						//Database name
		private $dbcon;						//For creating a connection
		
		
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
		function __construct($host,$user,$pass,$data) {
			
			$this->host     = $host;
			$this->user     = $user;
			$this->pass     = $pass;
			$this->data     = $data;
			$this->dbcon 	= new mysqli($this->host, $this->user, $this->pass, $this->data);
			
			return $this->installDB(); //Installs the db
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
			$dbcon = $this->dbcon;
			if ($dbcon->connect_errno) {echo "Failed to connect to MySQL: " . $dbcon->connect_error;}
			
			$result = $dbcon->query("SHOW COLUMNS FROM addbook"); 
			
			if(!$result || $result->num_rows<= 0)
			{
				$qry ="CREATE TABLE `addbook` (".
				"`id` int(7) NOT NULL AUTO_INCREMENT,".
				"`name` varchar(35) NOT NULL,".
				"`phone` varchar(35) NOT NULL,".
				"`email` varchar(35) NOT NULL,".
				"PRIMARY KEY  (`id`)".
				") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                
				return $dbcon->query($qry); 
				
			}
			$dbcon->close();
		}
	}

?>