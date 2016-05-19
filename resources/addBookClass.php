<?php
	//include DB
	//require_once ('dbClass.php');
	/*
	* Creating Class for address-book called addBookClass
	*/
	
	class addBookClass
	{
		protected static $host;						//Database hostname
		protected static $user;						//Database username
		protected static $pass;						//Database password
		protected static $db;						//Database name
		protected static $dbcon;						//For creating a connection
		
		
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
		function __construct() {
		
		// Try and connect to the database
        if(!isset($this->dbcon)):
			// Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('dbconfig.ini');
			
			$this->host     = $config['host'];
			$this->user     = $config['user'];
			$this->pass     = $config['pass'];
			$this->db    	= $config['dbname'];
			$this->dbcon 	= new mysqli($this->host, $this->user, $this->pass, $this->db);
		endif;
		
		  // If connection was not successful, handle the error
        if($this->dbcon === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }

			return $this->dbcon;
			//Installs the db
			return $this->installDB(); 
			
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
		
		    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function fetch($query) {
        $rows = array();
        $result = $this->proccessSql($query);
        if($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        return $this->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        return "'" . $this->real_escape_string($value) . "'";
    }
		
	}	