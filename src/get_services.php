<?php
include '../db_connection/conn.php';

$category = $_POST['category'] ?? '';

if (!empty($category)) {
    // Get category ID based on category_name
    $cat_result = $conn->query("SELECT c_id FROM categories WHERE category_name='$category'");
    if ($cat_result && $cat_row = $cat_result->fetch_assoc()) {
        $category_id = $cat_row['c_id'];

        // Get services linked to that category
        $service_query = $conn->query("SELECT service_name FROM services WHERE category_id=$category_id");

        if ($service_query && $service_query->num_rows > 0) {
            echo '<option value="">Select Service</option>';
            while ($srv = $service_query->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($srv['service_name']) . '">' . htmlspecialchars($srv['service_name']) . '</option>';
            }
        } else {
            echo '<option value="">No services found</option>';
        }
    } else {
        echo '<option value="">Invalid category</option>';
    }
} else {
    echo '<option value="">Select category first</option>';
}

$conn->close();
?>
