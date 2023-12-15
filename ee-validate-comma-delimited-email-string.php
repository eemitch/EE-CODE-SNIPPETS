<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.15.23
// PHP 8.3 Approved

// Validate a comma delimited string of one or more addresses
// Example input me@hotmail.com,you@yahoo.com,them@there.net
function eeValidateEmailString($eeAddresses) { 
		
	$eeLog = array();
	$eeAddressSanitized = '';
	
	if(strpos($eeAddresses, ',')) { // Multiple Addresses
	
		$eeAddresses = explode(',', $eeAddresses);
		
		$eeAddressesString = '';
		
		foreach($eeAddresses as $add){
			
			$add = trim($add);
			
			if(filter_var($add, FILTER_VALIDATE_EMAIL)) {
		
				$eeAddressesString .= $add . ',';
				
			} else {
				$eeLog['Errors'][] = $add . ' - This is not a valid email address.';
			}
		}
		
		$eeAddressSanitized = rtrim($eeAddressesString, ','); // Remove last comma
		
	
	} elseif(filter_var($eeAddresses, FILTER_VALIDATE_EMAIL)) { // Only one address
		
		$add = $eeAddresses;
		
		if($add) {
			
			$eeAddressSanitized = $add;
			
		} else {
			
			$eeLog['Errors'][] = $add . ' - This is not a valid email address.';
		}
		
	} else {
		
		$eeAddressSanitized = ''; // Anything but a good email gets null.
	}
	
	return $eeAddressSanitized;
}


?>