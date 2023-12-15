<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.15.23
// PHP 8.3 Approved

// Return ONLY the Domain Name
function eeGetOnlyTheDomain($eeURL) {
	
	// Convert the URL to lowercase
	$eeLowercaseURL = strtolower($eeURL);

	// Use regex to extract the domain
	// The regex pattern matches the following:
	// 1. ^(https?:\/\/)?: Optional http:// or https:// at the beginning of the string
	// 2. (?:www\.)?: Optional www. after the protocol
	// 3. ([^:\/\n]+): Capture the domain name, stopping at a colon, slash, or newline
	preg_match("/^(?:https?:\/\/)?(?:www\.)?([^:\/\n]+)/", $eeLowercaseURL, $eeMatches);

	// Check if the domain is found and its length is 1 or more
	$eeDomainFoundAndValid = isset($eeMatches[1]) && strlen($eeMatches[1]) >= 1;

	// Return the domain if found and valid, or FALSE if not
	return $eeDomainFoundAndValid ? $eeMatches[1] : FALSE;
}

?>