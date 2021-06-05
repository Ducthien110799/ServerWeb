<?php
session_start();
include('dbconfig.php');

if($connection)
{ 

}
else
{
    header("Location: database/dbconfig.php");
}

// if (!$_SESSION['username']) {
// 	header('Location: login.php');
// }