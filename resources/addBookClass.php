<?php
	//include DB
	require_once ('dbClass.php');
	/*
	* Creating Class for address-book called addBookClass
	*/

class addBookClass
{
    protected $db;

    public function __construct()
    {
        $this->db = DBSingleton::init();
        return $this->importDB(); //Installs the db
    }


    public function proccessSql($query)
	{
		$res = $this->db->query($query);
		return $res;
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
		$result = $this->db->query("SHOW COLUMNS FROM addbook"); 
		
		if(!$result || $result->num_rows<= 0)
		{
			$qry ="CREATE TABLE `addbook` (".
			"`id` int(7) NOT NULL AUTO_INCREMENT,".
			"`name` varchar(35) NOT NULL,".
			"`phone` varchar(35) NOT NULL,".
			"`email` varchar(35) NOT NULL,".
			"PRIMARY KEY  (`id`)".
			") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
               
			return $this->db->query($qry); 
			
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
        return $this->db->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        return "'" . $this->db->real_escape_string($value) . "'";
    }
		



}

?>