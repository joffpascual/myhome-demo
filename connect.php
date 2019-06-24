<?php
$server=$username=$password=$db=$conn=$query=$sql=$result="";

$servername = "localhost";
$username = "root";
$password = "root";
$db = "myhome_database";

// Create connectio
$conn=mysqli_connect($server, $username, $password, $db);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}/*else{
    echo "Connection Established!";
}*/
?>