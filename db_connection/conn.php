<?php
$conn = mysqli_connect("localhost", "root", "", "feedback_online");
if (!$conn) {   
    die("Connection failed: " . mysqli_connect_error());
}   
?>