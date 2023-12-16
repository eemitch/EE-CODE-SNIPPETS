<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.15.23
// PHP 8.3 Approved

// Unslug a slug
// Example: my-super_thing --> My Super Thing
function eeUnSlug($eeSlug) {
	   
	$eeSlug = strtolower($eeSlug);
	$eeSlug = str_replace('-', ' ', $eeSlug);
	$eeSlug = str_replace('_', ' ', $eeSlug);
	$eeString = ucwords($eeSlug);
	return $eeString;	
}

echo eeUnSlug('my-super_thing');

?>