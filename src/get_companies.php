<?php
include '../db_connection/conn.php';

$category = $_POST['category'] ?? '';

if (!empty($category)) {
    // Get category ID based on category_name
    $cat_result = $conn->query("SELECT c_id FROM categories WHERE category_name='$category'");
    if ($cat_result && $cat_row = $cat_result->fetch_assoc()) {
        $category_id = $cat_row['c_id'];

        // Get services linked to that category
        $service_query = $conn->query("SELECT s.service_name,s.createdAt,c.company_name,c.c_id FROM `services` s INNER JOIN categories c on c.c_id =s.category_id WHERE c.c_id=$category_id");

        if ($service_query && $service_query->num_rows > 0) {
            echo '<option value="">Select Service</option>';
            while ($srv = $service_query->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($srv['c_id']) . '">' . htmlspecialchars($srv['company_name']) . '</option>';
            }
        } else {
            echo '<option value="">No companies found</option>';
        }
    } else {
        echo '<option value="">Invalid category</option>';
    }
} else {
    echo '<option value="">Select category first</option>';
}

$conn->close();
?>
