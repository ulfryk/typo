<?php

$typo = 'adghke';
$text = array();

if ( isset( $_GET['typo'] ) ) {
	
	switch ( $_GET['typo'] ) {
		case 'left':
			$typo = 'asdf';
			break;
		case 'leftex':
			$typo = 'asdfg';
			break;
		case 'right':
			$typo = 'jkl;';
			break;
		case 'rightex':
			$typo = 'hjkl;';
			break;
		case 'both':
			$typo = 'asdfghjkl;';
			break;
	}
}

$typo .= ' ';

$l = strlen($typo) - 1;

for ( $i = 0; $i < 10; $i ++ ) {
	$int = rand( 0, $l );
	$text[$i] = $typo[$int];
}




?><!DOCTYPE html>
<!--[if IE 7 ]> <html class="oldie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="oldie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="modern ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="modern noie"> <!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<title> typo </title>
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
		<![endif]-->
		<script src="js/main.js.php"></script>
		<link rel="stylesheet" href="css/main.css" />
		<style>
			.panel {
				
				background-color: #aaa;
				margin: 0;
				padding: 0;
				position: fixed;
				top:0;left:0;bottom:0;right:0;
				z-index: 11;
				
			}
			.panel .line {
				width: 100%;
				float: left;
			}
			.panel .line + .line {
				position: relative;
					left: 20px;
			}
			.panel .line + .line + .line {
				position: relative;
					left: 40px;
			}
		</style>
	</head>
	<body>

		
		<section>
			<p>
				<?php 
					foreach ($text as $letter) {
						echo '<span>' . $letter . '</span>';
					}
				?>
			</p>
		</section>
		
		<div class="panel">
			<section>
				<p class="line"><span>q</span><span>w</span><span>e</span><span>r</span><span>t</span><span>y</span><span>u</span><span>i</span><span>o</span><span>p</span></p>
				<p class="line"><span>a</span><span>s</span><span>d</span><span>f</span><span>g</span><span>h</span><span>j</span><span>k</span><span>l</span><span>;</span></p>
				<p class="line"><span>z</span><span>x</span><span>c</span><span>v</span><span>b</span><span>n</span><span>m</span><span>,</span><span>.</span><span>/</span></p>
			</section>
		</div>
		
	</body>
</html>