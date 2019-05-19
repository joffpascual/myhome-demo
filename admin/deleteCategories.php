<?php
session_start();
require_once('../connect.php');

$users_id = $_GET['id'];
$query = "DELETE from categories WHERE id='$users_id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));


if ($result){
    header("Location: manage-categories.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($conn);
}


// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 


?>