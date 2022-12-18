<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	/*
	  Get Ip address from user.Also validate and sanitize to prevent command injection
	  using function filter_input() with FILTER_VALIDATE_IP flag.
	  Only correct formatted IP addresses are used for the ping command.
	*/
	$target = filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP);

	//IP address is incorrect
	if ($target === false) {
		echo "Error: Invalid IP address.";
		exit;
	}
	/*
	  Determine OS and execute the ping command.
	  Use escapeshellarg() function to escape the user-supplied IP
	  address before passing it as an argument to the ping command to prevent command injection attack.
	  The user input is treated as a string and not as part of the command itself.
	*/
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		$cmd = shell_exec( 'ping ' . escapeshellarg($target) );
	}
	else {
		// *nix
		$cmd = shell_exec( 'ping -c 4 ' . escapeshellarg($target) );
	}

	// Feedback for the end user
	echo "<pre>{$cmd}</pre>";
}

?>