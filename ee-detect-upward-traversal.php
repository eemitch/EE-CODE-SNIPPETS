<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.15.23
// PHP 8 Approved

$eeLog = array( 'notice' -> array(), 'errors' -> array() ); // Messaging

function eeDetectUpwardTraversal($eeFilePath) { // Relative to ABSPATH
	
	global $eeLog;
	
	// Decode URL-encoded characters
	$eeFilePath = urldecode($eeFilePath);

	// Convert all directory separators to '/'
	$eeFilePath = str_replace('\\', '/', $eeFilePath);

	// Normalize the path: replace double or multiple slashes with a single slash
	$eeFilePath = preg_replace('~/+~', '/', $eeFilePath);

	// Check for '..' after decoding and normalization
	if (strpos($eeFilePath, '..') !== FALSE) {
		$eeLog['errors'][] = 'Potential directory traversal detected.';
	}

	// Construct the full path and resolve to a real path
	$eeUserPath = str_replace('\\', '/', ABSPATH . dirname($eeFilePath));
	$eeRealPath = realpath($eeUserPath);

	// Ensure paths are valid
	if ($eeRealPath === FALSE || $eeUserPath === FALSE) {
		$eeLog['errors'][] = 'Invalid path detected.';
	}

	// Convert real path directory separator for consistency
	$eeRealPath = str_replace('\\', '/', $eeRealPath);

	// Check if the real path starts with the intended base directory (ABSPATH)
	if (strpos($eeRealPath, str_replace('\\', '/', ABSPATH)) !== 0) {
		$eeLog['errors'][] = 'Potential directory traversal detected.';
	}

	if (!empty($this->eeLog['errors'])) {
		echo '<pre>'; print_r($eeLog); echo '</pre>';
		exit('ERROR');
	}

	// If all checks passed, no traversal detected
	$this->eeLog['notice'][] = 'Traversal check passed.';
	
	// echo '<pre>'; print_r($eeLog); echo '</pre>';
	return TRUE;
}

?>