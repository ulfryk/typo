<?php
function __autoload($name) {
	$fileName = 'core/' . $name . '.php';
	include_once( $fileName );
}

// default values
$range = 'both';
$row = 'home';
$count = 100;
$type = 'letters';

// values from request
if (isset($_POST['row']))
	$row = $_POST['row'];

if (isset($_POST['typo'])) 
	$range = $_POST['typo'];

if ( isset($_POST['type']) && $_POST['type'] === 'words' )
	$type = 'words';

if ( isset($_POST['signs']) && is_numeric($_POST['signs']) ) {
	$countMin = $type != 'words' ? 5 : 9;
	$countDef = $type != 'words' ? 100 : 25;
	$countMax = $type != 'words' ? 201 : 51;
	$count = ( $_POST['signs'] > $countMin && $_POST['signs'] < $countMax ) ? $_POST['signs'] : $countDef;
}


// get output from db
$getter = new contentMaker();
if ( $type === 'letters' ) 		$content = $getter->getLetters($row,$range);
elseif ( $type === 'words' )	$content = $getter->getWords('home', $range);
$length = count( $content ) - 1;

// show output
require_once 'views/_' . $type . '.php';


/* */