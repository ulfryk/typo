<?php

class contentMaker {

	private $db_conf = array(
		'hostname' => 'localhost',
		'dbname' => 'typo',
		'username' => 'root',
		'password' => ''
	);
	
	public function getLetters ( $row, $range )
	{
		$mysql_db = 'mysql:host=' . $this->db_conf['hostname'] . ';dbname=' . $this->db_conf['dbname'];
		
		try
		{
		
		$dbh = new PDO($mysql_db, $this->db_conf['username'], $this->db_conf['password']);
		
		}
		catch(PDOException $pe)
		{
			
			die('Connection error, because: ' . $pe->getMessage());
			
		}
				
		
		
		$sql = 'SELECT packs FROM letters WHERE letters.row = "' . $row . '" AND letters.range = "' . $range .'"';
		
		$packs = $dbh->query( $sql );
		
		if(!$packs)
		{
			echo '<pre>';
			print_r( $dbh->errorInfo() );
			echo '</pre><br/><br/>';
			die("Execute query error!");
		}
		
		return str_split( $packs->fetch(PDO::FETCH_OBJ)->packs . ' ' );
	}
	
}