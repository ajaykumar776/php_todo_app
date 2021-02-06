<?php
session_start();
$hostname="localhost";
$username="root";
$password="";
$database="To_do";
$con = mysqli_connect($hostname,$username,$password,$database);	
    if(!$con)
    {
        die("database is not connected");
    }

?>