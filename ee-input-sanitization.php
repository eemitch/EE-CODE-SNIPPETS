<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.2 -- Rev 12.15.23
// PHP 8.3 Approved
	
	// Sanitize Form and $_REQUEST Inputs
	// Returns FALSE if sanitization occurred.
	function eeSanitizeInput($eeInput, $eeType = 'text', $eeAllowTags = FALSE) {
		
		// $eeType = text, email, url, num, float, ip
		
		if(empty($eeInput)) { return FALSE; }
		
		$eeOutput = $eeInput; // Any changes will return FALSE
		
		switch ($eeType) {
			case 'email':
				// Sanitize email
				$eeInput = strtolower(filter_var($eeInput, FILTER_SANITIZE_EMAIL));
				break;
			case 'url':
				// Sanitize URL
				$eeProtocol = preg_match('/^https?:\/\//', $eeInput); // Check if protocol is already included
				$eeURL = $eeProtocol ? $eeInput : 'http://' . $eeInput; // Prepend 'http://' for validation if no protocol is present
				if (filter_var($eeURL, FILTER_VALIDATE_URL) !== FALSE) { // Validate the URL
					$eeInput = preg_replace('/^https?:\/\//', '', $eeURL);
				} else {
					$eeInput = FALSE;
				}
				break;
			case 'num':
				// Sanitize number
				$eeInput = filter_var($eeInput, FILTER_SANITIZE_NUMBER_INT);
				break;
			case 'float':
				// Sanitize float number
				$eeInput = filter_var($eeInput, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$eeInput = floatval($eeInput);
				break;
			case 'ip':
				// Validate IP address
				$eeInput = filter_var($eeInput, FILTER_VALIDATE_IP);
				if(empty($eeInput)) { $eeInput = FALSE; }
				break;
			default:
				// Sanitize text
				if(strlen($eeInput)) {
					if($eeAllowTags === FALSE) { $eeInput = strip_tags($eeInput); }
					$eeInput = htmlspecialchars($eeInput, ENT_QUOTES, 'UTF-8');
				}
				break;
		}
		
		if($eeInput == $eeOutput) {
			$eeInput = preg_replace('/\s\s+/', ' ', $eeInput); // Remove Multiple Spaces
			return trim($eeOutput);
		}
		
		return FALSE;
	}
?>
						