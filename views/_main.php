<!DOCTYPE html>
<!--[if IE 7 ]> <html class="oldie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="oldie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="modern ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="modern noie"> <!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<title> typo </title>
		<script src="js/main.js.php"></script>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<img class="rebuild" src="images/wht_conf.png" />
		<img class="refresh" src="images/wht_re.png" />
		<div class="settings-panel">
			<section><?php
				$keys =  str_split( 'qwertyuiopasdfghjkl;zxcvbnm,./' );
				$i = 0;
				foreach ($keys as $key) {
					if ( $i === 10 ) echo '<p class="line ac" data-selected="[]">';
					elseif ( $i % 10 === 0) echo '<p class="line">';
					echo '<span>' . $key . '</span>';
					if ( $i % 10 === 9) echo '</p>';
					$i++;
				}?>
				<input type="text" class="signs-count" value="100" />
				<ul class="select-type" data-type="letters">
					<li class="selected">letters</li>
					<li>words</li>
				</ul>
				<ul class="select-typo">
					<li>left</li>
					<li>right</li>
					<li>leftex</li>
					<li>rightex</li>
					<li class="both">both</li>
				</ul>
			</section>
			<img class="go" src="images/blck_go.png" />
			<img class="go-back" src="images/blck_back.png" />
		</div><!-- end of settings panel -->
		<section>
			<p class="letters"> </p>
		</section>
	</body>
</html>
