<?php
header("Content-Type: application/json; charset=UTF-8");

if (array_key_exists("callback", $_GET)) {
	// Sanitize the callback parameter to prevent XSS attacks
	$callback = filter_var($_GET['callback'], FILTER_SANITIZE_STRING);
} else {
	return "";
}

$outp = array("answer" => "15");

echo $callback . "(" . json_encode($outp) . ")";
?>
