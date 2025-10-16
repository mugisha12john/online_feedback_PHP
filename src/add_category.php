<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Please log in to access the admin dashboard.'); window.location.href='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-100 h-screen flex flex-col md:flex-row">


    <aside class="bg-orange-800 text-white w-64 flex-shrink-0 hidden md:flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-orange-700">Admin Panel</div>
        <nav class="flex-1 flex flex-col mt-6">
            <a href="admin_home.php" class="px-6 py-3 hover:bg-orange-700">Dashboard</a>
            <a href="add_category.php" class="px-6 py-3 hover:bg-orange-500 bg-orange-600">Add Category</a>
            <a href="add_service.php" class="px-6 py-3 hover:bg-orange-700">Add Service</a>
            <a href="report.php" class="block px-6 py-3 hover:bg-orange-700"">Report</a>
            <div class="mt-auto px-6 py-3">
                <a href="logout_admin.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
            </div>
        </nav>
    </aside>


    <header class="md:hidden bg-orange-800 text-white flex justify-between items-center p-4">
        <div class="font-bold text-lg">Admin Panel</div>
        <button id="mobileMenuBtn" class="focus:outline-none">☰</button>
    </header>

    <!-- Dropdown sidebar for small screens -->
    <div id="mobileSidebar" class="absolute top-16 left-0 w-full bg-orange-800 text-white flex-col hidden md:hidden z-50">
        <a href="admin_home.php" class="block px-6 py-3 hover:bg-orange-700">Dashboard</a>
         <a href="add_category.php" class="block px-6 py-3 hover:bg-orange-500 bg-orange-600">Add Category</a>
        <a href="add_service.php" class="block px-6 py-3 hover:bg-orange-700">Add Service</a>
        <a href="report.php" class="block px-6 py-3 hover:bg-orange-700">Report</a>
        <div class="px-6 py-3">
            <a href="logout_admin.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
        </div>
    </div>
    <main class="flex-1 p-6 md:ml-0">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-orange-600 font-semibold mb-2">Total Category</h2>
                <p class="text-2xl font-bold text-orange-800">
                     <?php
                        include '../db_connection/conn.php';
                        $result = $conn->query("SELECT COUNT(*) as total FROM categories    ");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                       
                        ?>
                </p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-orange-600 font-semibold mb-2">Total Serives</h2>
                <p class="text-2xl font-bold text-orange-800">
                        <?php
                        include '../db_connection/conn.php';
                        $result = $conn->query("SELECT COUNT(*) as total FROM services");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                      
                        ?>
                </p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-orange-700 font-semibold mb-4">All category</h2>
            <div class="overflow-x-auto">
                <section id="add-category-form" class="hidden ">
                    <div  className=" bg-white rounded-lg shadow-lg w-full max-w-2xl p-4 sm:p-6 relative flex flex-col md:flex-row overflow-y-auto max-h-[90vh]">
    <h2 class="text-2xl font-bold text-center text-orange-700 mt-2 mb-6 w-full">
            Add New Category
        </h2>
        <form  method="POST" class="space-y-4 max-w-xl mx-auto mb-6">
        <div>
          <label class="block text-sm font-medium text-gray-700"
            >Category Name</label
          >
          <input
            type="text"
            name="category_name"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700"
            >Company Name</label
          >
          <input
            type="text"
            name="company_name"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>
        
       

        <button
          type="submit"
          class="w-full  bg-orange-600 text-white py-2 rounded-lg font-semibold hover:bg-orange-700 transition"
        >
          + Add Category
        </button>
      </form>
      </div>
                </section>
                <button id="add-category-btn" class="bg-orange-600 mb-2 hover:bg-orange-500 text-white px-4 py-2 rounded">Add Category</button>
                <table id="category-table" class="min-w-full divide-y divide-orange-200">
                    <thead class="bg-orange-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-orange-500">#</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-orange-500">Company name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-orange-500">Category</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-orange-500">Created At</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-orange-500">Modify</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-orange-200">
                         <?php
                            include '../db_connection/conn.php';
                            $id=0;
                            $sql = "SELECT * FROM categories ORDER BY createdAt DESC LIMIT 8";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $id +=1;
                                echo "<tr>
                                    <td class='px-4 py-2'>{$id}</td>
                                    <td class='px-4 py-2'>{$row['company_name']}</td>
                                    <td class='px-4 py-2'>{$row['category_name']}</td>
                                    <td class='px-4 py-2'>{$row['createdAt']}</td>
                                    <td class='px-4 py-2'>
                                        <a href='edit_category.php?id={$row['c_id']}' class='text-blue-600 hover:underline mr-2'>Edit</a>
                                        <a href='delete_category.php?id={$row['c_id']}' class='text-red-600 hover:underline' onclick=\"return confirm('Are you sure you want to delete this category?');\">Delete</a>
                                    </td>
                                </tr>";
                            }
                            
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Mobile menu script -->
    <script>
        const mobileMenuBtn =  document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        mobileMenuBtn.addEventListener('click', () => {
            mobileSidebar.classList.toggle('hidden');
        });
        const categoryTable = document.getElementById('category-table');
        const addCategoryBtn = document.getElementById('add-category-btn');
        const addCategoryForm = document.getElementById('add-category-form');
        addCategoryBtn.addEventListener('click', () => {
            addCategoryForm.classList.toggle('hidden');
            categoryTable.classList.toggle('hidden');
            addCategoryBtn.classList.toggle('hidden');
        });
    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db_connection/conn.php';
    $category_name = $_POST['category_name'];
    $company_name = $_POST['company_name'];
    $stmt = $conn->prepare("INSERT INTO categories (category_name, company_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $category_name, $company_name);
    if ($stmt->execute()) {
        echo "<script>alert('Category added successfully'); window.location.href='add_category.php';</script>";
    } else {
        echo "<script>alert('Error adding category');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>