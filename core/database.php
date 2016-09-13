<?php

class Database {
	private $_connection;
	private static $_instance;
	private $_host = "localhost";
	private $_username = "someusername";
	private $_password = "somepassword";
	private $_database = "blogdb";
	
    /*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
	
		if($this->_connection->connect_error) {
			die("Failed to conenct to MySQL: ".$this->_connection->connect_error);
		}

        $this->_connection->set_charset("utf8");
	}

    public function getRows($query) {
        $result =  $this->_connection->query($query);
        $rows = array();

        if(!$result || $this->_connection->error) {            
            $this->logErrors($this->_connection->error);
            return $rows;
        }

        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }

        return $rows;
    }

    public function insertUpdateDeleteQuery($query) {
        $result =  $this->_connection->query($query);

        if($this->_connection->error) {
            $this->logErrors($this->_connection->error);
            return FALSE;
        }

        return TRUE;
    }

    public function getLastId() {
        return  $this->_connection->insert_id;
    }

    public function RealEscapreSting($str) {
        return $this->_connection->real_escape_string($str);
    }

    private function logErrors($msg) {
        $file_date = date( "Y-m-d");
        $filepath = "logs/{$file_date}-db-error.log";
        
        if(!$handler = fopen($filepath, 'a+') ) return 0;
        if( fwrite( $handler, $msg."\n" ) === FALSE ) return 0;
        
        fclose($handler);
        return 1;
    }

	private function __clone() { }

    private function __wakeup() { }
}
?>
