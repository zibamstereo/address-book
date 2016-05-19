<?php
	class DB {
    // The database connection
    protected static $connection;
	
	//Use the Construct to import DB
	function __construct() {

			return $this->importDB(); //Installs the db
			
		}
		
	/**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('dbconfig.ini'); 
            self::$connection = new mysqli($config['host'],$config['user'],$config['pass'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }
		
	
			/**
		 *  @brief Brief		
		 *  
		 *  @return Return_Description: Creating a function to automatically install sql at startup page
		 *  
		 *  @details Details
		 */
		public function importDB()
		{
			//check if a table called addbook is made 
			$result = $this->proccessSql("SHOW COLUMNS FROM addbook"); 
			// If the table is not made then create it
			if(!$result || $result->num_rows<= 0)
			{
				$qry ="CREATE TABLE `addbook` (".
				"`id` int(7) NOT NULL AUTO_INCREMENT,".
				"`name` varchar(35) NOT NULL,".
				"`phone` varchar(35) NOT NULL,".
				"`email` varchar(35) NOT NULL,".
				"PRIMARY KEY  (`id`)".
				") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                
				return $this->proccessSql($qry); 
				
			}
		}



    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function proccessSql($query) {
        // Connect to the database
        $connection = $this->connect();

        // Query the database
        $result = $connection->query($query);

        return $result;
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
        $connection = $this->connect();
        return $connection->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }
}
?>