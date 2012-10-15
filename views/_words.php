<?php foreach ( $content as $word ): ?>
<strong>
	<?php foreach ($word as $letter): ?>
	<span><?php echo $letter; ?></span>
	<?php endforeach; ?>
</strong>
<?php endforeach; ?>