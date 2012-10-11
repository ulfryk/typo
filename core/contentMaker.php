<?php

class contentMaker {

	private $db_conf = array(
		'hostname' => 'localhost',
		'dbname' => 'typo',
		'username' => 'root',
		'password' => ''
	);
	
	private function dbConnect ()
	{
		// db connection strings
		$mysql_db = 'mysql:host=' . $this->db_conf['hostname'] . ';dbname=' . $this->db_conf['dbname'];
		$user = $this->db_conf['username'];
		$pass = $this->db_conf['password'];
		
		// open connection //try{ ... }catch(PDOException $e){die('Error: '.$e->getMessage());}
		return new PDO($mysql_db, $user, $pass);
	}
	
	public function getLetters ( $row, $range )
	{
		// sql query
		$sql = 'SELECT pack FROM letters WHERE letters.row = "' . $row . '" AND letters.range = "' . $range .'"';
		
		// get letters pack
		$dbh = $this -> dbConnect();
		$output = $dbh -> query( $sql ) -> fetch(PDO::FETCH_OBJ) -> pack;
		$dbh = null;
		
		//return array of signs to be used
		return str_split( $output . ' ' );
	}
	
	public function getWords ( $row, $range )
	{
		// sql query
		$sql = 'SELECT word FROM words WHERE words.row = "' . $row . '" AND words.range = "' . $range .'"';
		
		// get words array from db
		$dbh = $this -> dbConnect();
		$stmt = $dbh -> query( $sql );
		
		$output = array('aa','bb','cc');
		$i = 0;
		
		while ( $word = $stmt->fetch(PDO::FETCH_OBJ)->word ) {
		    $output[$i] = $word;
			$i++;
		}
		
		$dbh = null;
	
		//return array of words to be used
		return $output;
	}
	
	public function setWords ( $table )
	{
		// db connection strings
		//$mysql_db = 'mysql:host=' . $this->db_conf['hostname'] . ';dbname=' . $this->db_conf['dbname'];
		//$user = $this->db_conf['username'];
		//$pass = $this->db_conf['password'];
		//$dbh = new PDO($mysql_db, $user, $pass);
		foreach ( $table as $row => $cnt ) {
			echo '<div style="padding:50px">';
			foreach ( $cnt as $range => $words ) {
				foreach ( $words as $word ) {
					echo $row . ' : ' . $range . ' : ' . $word . '<br/>';
					//$sql = 'INSERT INTO  `typo`.`words` (`word` , `row` , `range`  ) VALUES ( \'' . $word . '\',  \'' . $row . '\',  \'' . $range . '\' )';
					//$dbh->exec( $sql );
				}
			}
			echo '</div>';
		}
		//$dbh = null;
	}
	
}
