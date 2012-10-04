<?php
// required header info and character set
header("Content-type: application/x-javascript");
// cache control to process
header("Cache-Control: must-revalidate"); // In production may be set to "Cache-Control: public"
// duration of cached content (1 hour)
$offset = 60 * 60 ;// In production may be deleted
// expiration header format
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s",time() + $offset) . " GMT";// In production may be deleted
// send cache expiration header to broswer
header($ExpStr);// In production may be deleted

require('jquery.min.js');
require('main.js');
?>
