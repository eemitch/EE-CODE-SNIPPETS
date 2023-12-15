<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.15.23
// PHP 8.3 Approved

// Return the size of a file in a nice format.

/**
 * Formats the size of a file into a human-readable format.
 * 
 * @param int $eeFileSizeBytes The size of the file in bytes.
 * @param int $eePrecision The number of decimal places for rounding.
 * @return string The formatted file size with appropriate unit (B, KB, MB, GB, TB).
 */
 
function eeFormatFileSize($eeFileSizeBytes, $eePrecision = 2) {
	// Define the units of measurement for file sizes.
	$eeUnits = ['B', 'KB', 'MB', 'GB', 'TB'];

	// Ensure the file size is not negative.
	$eeBytes = max($eeFileSizeBytes, 0);

	// Determine the factor to use for the unit. This calculation is based on the length
	// of the file size number. Every 3 digits in the length represents a jump in unit (KB, MB, etc.).
	$eeFactor = floor((strlen($eeBytes) - 1) / 3);

	// Calculate the file size in the appropriate unit. The pow function is used to
	// scale the bytes to the corresponding unit (1024^0 for B, 1024^1 for KB, etc.).
	// The round function is used to limit the number of decimal places.
	$eeValue = round($eeBytes / pow(1024, $eeFactor), $eePrecision, PHP_ROUND_HALF_UP);

	// Construct and return the formatted file size string with the unit.
	return $eeValue . ' ' . $eeUnits[$eeFactor];
}


?>