<?php

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "aothun";

$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);
$conn = new PDO("mysql:host=$server_name;dbname=$db_name;", $db_username, $db_password);

?>