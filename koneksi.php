<?php

	// Membuat koneksi database
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'db_beasiswa';

	$conn = mysqli_connect($host, $user, $pass, $db);

	if (!$conn) {
		echo 'Error : '.mysqli_connect_error($conn);
	}
?>
