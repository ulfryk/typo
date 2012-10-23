<?php
function __autoload($name) {
	$fileName = 'core/' . $name . '.php';
	include_once( $fileName );
}

$helper = new typoHelper(); // some useful functions, 'core/typoHelper.php'

if ( $helper -> requestIsAjax() ) {

	
	$getter = new contentMaker(); //model , 'core/contentMaker.php'
	
	// values from request
	$row	=	$helper -> getValid( 'row' );
	$range	=	$helper -> getValid( 'range' );
	$type	=	$helper -> getValid( 'type' );
	$count	=	$helper -> getValidCount();
	
	// get output from db
	$content = $getter -> getContent( $type, $row, $range, $count );
	
	// show output
	$helper -> render( $type, $content, $count ); // will include 'views/_letters.php' or 'views/_words.php' ( depends on $type value ) passing specific data

} else {

	// show output
	$helper -> render(); // will include 'views/_main.php'
	
	// count ++ users
	$counter = new userCounter();
	$counter -> addUser( $_SERVER['REMOTE_ADDR'] );
	
}


