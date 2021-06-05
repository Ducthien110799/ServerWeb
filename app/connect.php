<?php

	$server_name = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "aothun";
	#connect 
	$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

	if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
	}

	#set kiểu tên là Tiếng Việt
	mysqli_query($conn, "SET NAMES 'utf8' ");

	
?>