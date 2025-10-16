<?php
include '../db_connection/conn.php';
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM services WHERE s_id='$id'");
if ($delete) {
    echo "<script>alert('Service deleted successfully.'); window.location.href='add_service.php';</script>";
} else {
    echo "<script>alert('Error deleting Service: " . $conn->error . "'); window.location.href='add_service.php';</script>";
}
?>