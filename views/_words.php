<?php 
	for ($i = 0; $i < $count; $i++):
	$word = str_split( $content[ mt_rand( 0, $length ) ] );
?>
<strong style="float:left;display:block">
	<?php for ($j = 0; $j < count( $word ); $j++): ?>
	<span>
		<?php echo $word[$j] ?>
	</span>
	<?php endfor; ?>
	<span> </span>
</strong>
<?php endfor; ?>