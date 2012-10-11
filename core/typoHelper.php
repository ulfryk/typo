<?php

class typoHelper {
	
	private $dictionary = array(
		'row' => array('home','top','bottom'),
		'range' => array('left','right','leftex','rightex','both'),
		'type' => array('letters','words')
	);
	
	public function getValid ( $key )
	{
		$isItOk = isset( $_POST[ $key ] ) && in_array( $_POST[ $key ], $this -> dictionary[ $key ] );
		
		if ( $isItOk )
			$value = $_POST[ $key ];
		else
			$value = $arrays[ $key ][ 0 ];
		
		return $value;
	}
	
	public function getValidCount ()
	{
		$type = $this -> getValid( 'type' );
		
		$countMin = $type != 'words' ? 5 : 9;
		$countDef = $type != 'words' ? 100 : 25;
		$countMax = $type != 'words' ? 201 : 51;
		
		$postOk = isset($_POST['signs']) && is_numeric($_POST['signs']);
		$inRange = $_POST['signs'] > $countMin && $_POST['signs'] < $countMax;
		
		if ( $postOk && $inRange ) 
			$count = $_POST['signs'];
		else
			$count = $countDef;
		
		return $count;
	}

}
