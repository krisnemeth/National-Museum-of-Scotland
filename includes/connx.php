<?php 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$db = "nms"; 

// Create connection 
$conn = new mysqli($servername, $username, $password, $db);

// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} else{
    //throughout development display message of successful connection
    // echo "Connected to database successfully."; 
} 
?>