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
		
		$dbh = new PDO($mysql_db, $this->db_conf['username'], $this->db_conf['password']);
		
		$sql = 'SELECT packs FROM letters WHERE row = ' . $row . ' AND range = ' . $range;
		
		return 'hello';
	}
	
}