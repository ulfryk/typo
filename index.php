<!DOCTYPE html>
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
	</head>
	<body>
		
		<img style="position:fixed;top:26px;left:26px;" class="rebuild" src="images/wht_conf.png">
		
		<img style="position:fixed;top:170px;left:26px;" class="refresh" src="images/wht_re.png">
		
		<div class="settings-panel">
			
			<section>
				
				<?php
				$keyBoard = 'qwertyuiopasdfghjkl;zxcvbnm,./';
				$keys =  str_split( $keyBoard );
				
				$i = 0;
				
				foreach ($keys as $key) {
				
					if ( $i === 10 ) 
						echo '<p class="line ac" data-selected="[]">';
					elseif ( $i % 10 === 0) 
						echo '<p class="line">';
					echo '<span>' . $key . '</span>';
					if ( $i % 10 === 9) echo '</p>';
					$i++;
					
				} ?>
				
				<input type="text" class="signs-count" value="100" />
				
				<ul class="select-typo">
					<li>left</li>
					<li>right</li>
					<li>leftex</li>
					<li>rightex</li>
					<li class="both">both</li>
				</ul>
				
			</section>
			
			<img class="go" src="images/blck_go.png" />
			
		</div>
		
		<section>
			
			<p class="letters">&nbsp;</p>
			
		</section>
		
		
	</body>
</html>