<?php 
/*
Author: Wejn {wejn at box dot cz}
License: GPL v2.0, no latter version(s)
Version: 2.0
Changelog:
- Added better mime-type detection
- Now works even when C-T header not set
- Changed intro text to better target keywords
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
