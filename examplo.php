<?php

require 'alphanumeric-generator.php';

$current_number = "aZ5sTp53x";

// Get Next Number
$next_number = anderson_makiyama_get_next_alphanumeric($current_number);
	
echo "Current = " . $current_number;
echo "Next    = " . $next_number;



//------------Generate a lot of sequential alphanumeric strings --------

echo "<hr>A lot of sequential alphanumeric strings<br>";

$code = $current_number;

for($i=0;$i<5000;$i++){

	$code = anderson_makiyama_get_next_alphanumeric($code);
	
	echo $code; echo "<br>";

}


?>