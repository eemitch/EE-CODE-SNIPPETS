<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.2 -- Rev 12.26.23
// PHP 8.3 Approved


// Create a slug
// Example: My Super Thing --> my-super-thing
function eeMakeSlug($eeString){
   $eeSlug = preg_replace('/[^A-Za-z0-9-]+/', '-', $eeString);
   $eeSlug = strtolower($eeSlug);
   return $eeSlug;
}

echo eeMakeSlug('My Super Thing');

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