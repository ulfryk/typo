<?php

class contentMaker {

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
		
		// open connection //try{ ... }catch(PDOException $e){die('Error: '.$e->getMessage());}
		$dbh = new PDO($mysql_db, $user, $pass);
		
		return $dbh -> query( $sql );
	}
	
	public function getLetters ( $row, $range )
	{
		// sql query
		$sql = 'SELECT pack FROM letters WHERE letters.row = "' . $row . '" AND letters.range = "' . $range .'"';
		
		// get letters pack
		$output = $this -> dbQuery($sql) -> fetch(PDO::FETCH_OBJ) -> pack;
		$dbh = null;
		
		//return array of signs to be used
		return str_split( $output . ' ' );
	}
	
	public function getWords ( $row, $range )
	{
		// sql query
		$sql = 'SELECT word FROM words WHERE words.row = "' . $row . '" AND words.range = "' . $range .'"';
		
		// get words array from db
		$stmt = $this -> dbQuery( $sql );
		
		$output = array();
		$i = 0;
		while ( $word = $stmt->fetch(PDO::FETCH_OBJ)->word ) {
		    $output[$i] = $word;
			$i++;
		}
		$dbh = null;
	
		//return array of words to be used
		return $output;
	}
	
	public function getContent ( $type, $row, $range, $count )
	{
		$content = array();
		
		if ( $type === 'letters' ) {
			
			$letters = $this -> getLetters($row,$range);
			$randMax = count( $letters ) - 1;
			for( $i = 0; $i < $count; $i++) {
				$content[$i] = $letters[ mt_rand( 0, $randMax ) ];
			}
			
		} elseif ( $type === 'words' ) {
			
			$words = $this -> getWords('home', $range);
			$randMax = count( $words ) - 1;
			for( $i = 0; $i < $count; $i++) {
				$content[$i] = str_split( $words[ mt_rand( 0, $randMax ) ] . ' ' );
			}
			
		}
		
		return $content;
	}
	
	public function setWords ( $table, $insert = false )
	{
		
		if ( $insert ) {
			// db connection strings
			$mysql_db = 'mysql:host=' . $this->db_conf['hostname'] . ';dbname=' . $this->db_conf['dbname'];
			$user = $this->db_conf['username'];
			$pass = $this->db_conf['password'];
			$dbh = new PDO($mysql_db, $user, $pass);
		}
		
		foreach ( $table as $row => $cnt ) {
			echo '<div style="padding:50px">';
			foreach ( $cnt as $range => $words ) {
				foreach ( $words as $word ) {
					
					echo $row . ' : ' . $range . ' : ' . $word . '<br/>';
					
					if ( $insert ) {
						$sql = 'INSERT INTO  `typo`.`words` (`word` , `row` , `range`  ) VALUES ( \'' . $word . '\',  \'' . $row . '\',  \'' . $range . '\' )';
						$dbh->exec( $sql );
					}
					
				}
			}
			echo '</div>';
		}
		
		if ( $insert ) $dbh = null;
	}
	
}
