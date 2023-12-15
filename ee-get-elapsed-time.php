<?php // Mitchell Bennis (mitch@elementengage.com)
// Version 1.1 -- Rev 12.15.23
// PHP 8.3 Approved

// Get Elapsed Time it takes for a Script to Run
global $eeStartTime, $eeMemoryUsedStart;
$eeStartTime = microtime(true);
$eeMemoryUsedStart = memory_get_usage();

function eeRunTimeTimer() {
	
	global $eeStartTime, $eeMemoryUsedStart;

	// Validate global variables
	if (!is_numeric($eeStartTime) || !is_numeric($eeMemoryUsedStart)) {
		return FALSE; // Error: Start time or memory usage not properly initialized.
	}

	// Calculate elapsed time
	$eeElapsedTime = microtime(true) - $eeStartTime;

	// Calculate memory usage
	$eeMemoryUsage = memory_get_usage() - $eeMemoryUsedStart;

	// Format time to 0.000 seconds
	$eeFormattedTime = number_format($eeElapsedTime, 3) . ' S';
	
	// Format memory used (Placeholder, implement according to your needs)
	$eeFormattedMemory = number_format($eeMemoryUsage / 1024, 2) . ' KB';

	return $eeFormattedTime . ' | ' . $eeFormattedMemory;
}

// Usage
echo eeRunTimeTimer();

?>