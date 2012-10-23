<?php

class userCounter {

    private $db_conf = array(
        'hostname' => 'localhost',
        'dbname' => 'typo',
        'username' => 'root',
        'password' => ''
    );
    
    private function dbQuery ( $sql )
    {
        // db connection strings
        $mysql_db = 'mysql:host=' . $this->db_conf['hostname'] . ';dbname=' . $this->db_conf['dbname'];
        $user = $this->db_conf['username'];
        $pass = $this->db_conf['password'];
        
        // open connection
        $dbh = new PDO($mysql_db, $user, $pass);
        
        $dbh -> exec( $sql );
        
        $dbh = null;
        
    }
    
    public function addUser ( $ip ) {
        $sql = 'INSERT INTO users ( ip ) VALUES ( "' . $ip . '" )';
        $this -> dbQuery( $sql );
    }
    
    
}
