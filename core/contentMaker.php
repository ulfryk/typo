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
	
	public function getWords( $row, $range )
	{
		
	}
	
	public function setWords( $table )
	{
		foreach ( $table as $row => $cnt ) {
			echo '<div style="padding:50px">'
			foreach ( $cnt as $range => $words ) {
				foreach ( $words as $word ) {
					echo $row . ' : ' . $row . ' : ' . $word;
				}
			}
			echo '</div>';
		}
		
	}//setWords();
	
}