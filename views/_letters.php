<?php for ($i = 0; $i < $count; $i++): ?>
<span<?php if ($i === 0) echo ' class="current"'; ?>><?php echo $content[ mt_rand( 0, $length ) ] ?></span>
<?php endfor; ?>