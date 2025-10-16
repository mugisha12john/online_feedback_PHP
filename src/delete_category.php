<?php
include '../db_connection/conn.php';
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM categories WHERE c_id='$id'");
if ($delete) {
    echo "<script>alert('Category deleted successfully.'); window.location.href='add_category.php';</script>";
} else {
    echo "<script>alert('Error deleting category: " . $conn->error . "'); window.location.href='add_category.php';</script>";
}
?>