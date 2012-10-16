<!DOCTYPE html>
<!--[if lt IE 9 ]> <html class="oldie"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html> <!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<title> typo </title>
		<script src="js/main.js.php"></script>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<img class="rebuild" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" />
		<img class="refresh" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" />
		<div class="settings-panel">
			<section><?php // create keyboard view with selected 'left' range of 'home' row
			$keys =  str_split( 'qwertyuiopasdfghjkl;zxcvbnm,./' );
			$i = 0;
			$k = array(10,11,12,13);
			foreach ($keys as $key): ?>
				<?php if ( $i === 10 ): ?>
				<p class="line ac" data-selected="[0,1,2,3]">
				<?php elseif ( $i % 10 === 0): ?>
				<p class="line">
				<?php endif; ?>
					<span <?php if(in_array($i, $k)) echo ' class="selected"' ?>><?php echo $key; ?></span>
				<?php if ( $i % 10 === 9): ?>
				</p>
				<?php endif; ?>
			<?php $i++;
			endforeach; ?>
				<input type="text" class="signs-count" value="100" />
				<ul class="select-type" data-type="letters">
					<li class="selected">letters</li>
					<li>words</li>
				</ul>
				<ul class="select-typo" data-typo="left">
					<li class="selected">left</li>
					<li>right</li>
					<li>leftex</li>
					<li>rightex</li>
					<li class="both">both</li>
				</ul>
			</section>
			<img class="go" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" />
			<img class="go-back" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" />
		</div><!-- end of settings panel -->
		<section>
			<p class="letters"> </p>
		</section>
	</body>
</html>
