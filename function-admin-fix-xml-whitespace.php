<?php 
/*
Author: Wejn {wejn at box dot cz}
License: GPL v2.0, no latter version(s)
Version: 2.0
Changelog:
- Added better mime-type detection
- Now works even when C-T header not set
- Changed intro text to better target keywords
Requirements
------------
Works with PHP5 only, as the headers_list() function is missing
in PHP4 which makes output Content-Type detection impossible.

Installation
------------
Either use this as auto_prepend in your .htaccess:

php_value "auto_prepend_file" /path/to/wejnswpwhitespacefix.php

or include it as first thing in Wordpress' index.php file even
before that "short and sweet" line:

<?php
include("wejnswpwhitespacefix.php");
// Short and sweet
define('WP_USE_THEMES', true);
require('./wp-blog-header.php');
?>

Note: For the .htaccess way your AllowOverride must include
"Options" (or better yet, be set to "All"); otherwise all you'll
be getting is "Internal Server Error".
*/
#### [WHITESPACE FIX XML]
function ___wejns_wp_whitespace_fix($input) {
	$allowed = false;
	$found = false;
	foreach (headers_list() as $header) { 
		if (preg_match("/^content-type:\\s+(text\\/|application\\/((xhtml|atom|rss)\\+xml|xml))/i", $header)) { $allowed = true; }
		if (preg_match("/^content-type:\\s+/i", $header)) {	$found = true; }
	}
	if ($allowed || !$found) { return preg_replace("/\\A\\s*/m", "", $input); } else { return $input; }
}
ob_start("___wejns_wp_whitespace_fix");
?>
