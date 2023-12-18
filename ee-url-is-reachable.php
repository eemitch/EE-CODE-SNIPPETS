<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.17.23
// PHP 8 Approved

// Get the current URL including arguments
public function eeGetThisURL($eeIncludeQuery = TRUE) { // Strip Args or not
	
	// Find what is contained in the address bar	
	$eeProtocol = ''; $eeHost = ''; $eeSubFolder = ''; $eeArguments = '';
	
	// WordPress?
	if( empty($_SERVER['HTTP_HOST']) AND function_exists('site_url') ) {
		
		$eeHost = site_url(); // This will contain the path to the WP core files, plus slash
		
		if( strpos($_SERVER['REQUEST_URI'], '?') !== FALSE ) { 
			$eeArray = explode('?', $_SERVER['REQUEST_URI']);
			if(!empty($eeArray[1])) { $eeArguments = $eeArray[1]; }
		}
	
	} else {
		
		$eeProtocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://"; // Protocol
		$eeHost = $_SERVER['HTTP_HOST']; // Host
		
		// Get folder path
		if( strpos($_SERVER['REQUEST_URI'], '?') !== false ) {
			
			$eeArray = explode('?', $_SERVER['REQUEST_URI']);
			if(!empty($eeArray[0])) { $eeSubFolder = $eeArray[0]; }
			if(!empty($eeArray[1])) { $eeArguments = $eeArray[1]; }
		
		} else {
			$eeSubFolder = $_SERVER['REQUEST_URI']; // Just a folder path or a single slash
		}
	}
	
	// Reassemble the URL
	$eeURL = $eeProtocol . $eeHost . $eeSubFolder;
	
	// Re-Add the Query if Needed
	if($eeIncludeQuery === TRUE) { 
		$eeURL .= '?' . $eeArguments;
		$eeURL = remove_query_arg('eeReScan', $eeURL); // Don't want this
	}

	return $eeURL;
}

?>