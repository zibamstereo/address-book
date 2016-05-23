<?php
    /**
        *  @Description:  Creating Database Class 
    */  

// Load configuration as an array. Use the actual location of your configuration file
$config = parse_ini_file('dbconfig.ini'); 
define('SERVER', $config['host']);              //Database hostname
define('USERNAME', $config['user']);            //Database username
define('PASSWORD', $config['pass']);            //Database password
define('DATABASE', $config['dbname']);          //Database name

	class DB {
    // The database connection
    protected static $con;
	
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
        if(!isset(SELF::$con)) {
            SELF::$con = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
        }

        // If connection was not successful, handle the error
        if(SELF::$con === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return SELF::$con;
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
        $con = $this->connect();

        // Query the database
        $res = $con->query($query);

        return $res;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function fetch($query) {
        $rows = array();
        $res = $this->proccessSql($query);
        if($res === false) {
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
        $con = $this->connect();
        return $con->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $con = $this->connect();
        return "'" . $con->real_escape_string($value) . "'";
    }
}
?>