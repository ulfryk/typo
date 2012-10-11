<?php
function __autoload($name) {
	$fileName = 'core/' . $name . '.php';
	include_once( $fileName );
}

function isAjax () {
	return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


if ( isAjax() ) {

	$helper = new typoHelper(); // some useful functions
	$getter = new contentMaker(); //model
	
	// values from request
	$row	=	$helper -> getValid( 'row' );
	$range	=	$helper -> getValid( 'range' );
	$type	=	$helper -> getValid( 'type' );
	$count	=	$helper -> getValidCount();
	
	// get output from db
	if ( $type === 'letters' ) 		$content = $getter -> getLetters($row,$range);
	elseif ( $type === 'words' )	$content = $getter -> getWords('home', $range);
	
	$length = count( $content ) - 1;
	$view = $type;

} else {
	
	$view = 'main';
	
}

// show output
require_once 'views/_' . $view . '.php';
