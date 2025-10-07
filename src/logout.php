<?php
session_Start();
session_destroy();
echo "<script>alert('You have been logged out successfully.');</script>";
echo "<script>window.location.href='login.php';</script>";

?>