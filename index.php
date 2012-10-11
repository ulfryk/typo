<?php
function __autoload($name) {
	$fileName = 'core/' . $name . '.php';
	include_once( $fileName );
}

$helper = new typoHelper(); // some useful functions

if ( $helper -> requestIsAjax() ) {

	
	$getter = new contentMaker(); //model
	
	// values from request
	$row	=	$helper -> getValid( 'row' );
	$range	=	$helper -> getValid( 'range' );
	$type	=	$helper -> getValid( 'type' );
	$count	=	$helper -> getValidCount();
	
	// get output from db
	$content = $getter -> getContent( $type, $row, $range );
	
	// show output
	$helper -> render( $type, $content, $count );

} else {

	// show output
	$helper -> render();
	
}


