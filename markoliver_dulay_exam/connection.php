<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "youtube_db";

$conn = mysqli_connect($servername, $username, $password, $db);
$conn->set_charset("utf8mb4");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());

}

?>
