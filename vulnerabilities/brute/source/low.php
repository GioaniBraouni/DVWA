<?php

if( isset( $_GET[ 'Login' ] ) ) {
	// Get username
	$username = $_GET[ 'username' ];

	// Get password
	$password = $_GET[ 'password' ];
	$encryptedPassword = md5( $password );

	// Create a prepared statement
	$statement = mysqli_prepare($GLOBALS["___mysqli_ston"], "SELECT * FROM `users` WHERE user = ? AND password = ?");

	// Bind parameters to the statement
	mysqli_stmt_bind_param($statement, "ss", $username, $encryptedPassword);

	// Execute the statement
	mysqli_stmt_execute($statement);

	// Get the result
	$result = mysqli_stmt_get_result($statement);

	if( $result && mysqli_num_rows( $result ) == 1 ) {
		// Get users details
		$row    = mysqli_fetch_assoc( $result );
		$avatar = $row["avatar"];

		// Login successful
		$html .= "<p>Welcome to the password protected area {$username}</p>";
		$html .= "<img src=\"{$avatar}\" />";
	}
	else {
		// Login failed
		$html .= "<pre><br />Username and/or password incorrect.</pre>";
	}

	// Close the statement and connection
	mysqli_stmt_close($statement);
	((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>
