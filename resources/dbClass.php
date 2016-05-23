<?php
	/**
		*  @Description:  Creating Database Class 
	*/	

// Load configuration as an array. Use the actual location of your configuration file
$config = parse_ini_file('dbconfig.ini'); 
define('SERVER', $config['host']);				//Database hostname
define('USERNAME', $config['user']);			//Database username
define('PASSWORD', $config['pass']);			//Database password
define('DATABASE', $config['dbname']); 			//Database name

class DBSingleton
{
    private static $instance;					//An instance of the Mysqli Singleton to initiate 
    private $con;								// Mysqli Connection itself

    //Create a constructor for the DB connection
    private function __construct()
    {
        $this->con = new mysqli(SERVER,USERNAME,PASSWORD,DATABASE);
    }

    //Create a function to initiate the DB instance
    public static function init()
    {
        if(is_null(SELF::$instance))
        {
            SELF::$instance = new DBSingleton();
        }

        return SELF::$instance;
    }

    // Create a magic method __call() to call funtions
    public function __call($name, $args)
    {
        if(method_exists($this->con, $name))
        {
             return call_user_func_array(array($this->con, $name), $args);
        } else {
             trigger_error('Unknown Method ' . $name . '()', E_USER_WARNING);
             return false;
        }
    }
}

?>