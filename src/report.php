<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 h-screen flex flex-col md:flex-row">


    <aside class="bg-blue-800 text-white w-64 flex-shrink-0 hidden md:flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-700">Admin Panel</div>
        <nav class="flex-1 flex flex-col mt-6">
            <a href="admin_home.php" class="px-6 py-3 hover:bg-blue-700">Dashboard</a>
            <a href="add_category.php" class="px-6 py-3 hover:bg-blue-700">Add Category</a>
            <a href="add_service.php" class="px-6 py-3 hover:bg-blue-700">Add Service</a>
            <a href="report.php" class="block px-6 py-3 hover:bg-blue-500 bg-blue-600  ">Report</a>
            <div class="mt-auto px-6 py-3">
                <a href="logout.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
            </div>
        </nav>
    </aside>


    <header class="md:hidden bg-blue-800 text-white flex justify-between items-center p-4">
        <div class="font-bold text-lg">Admin Panel</div>
        <button id="mobileMenuBtn" class="focus:outline-none">☰</button>
    </header>

    <!-- Dropdown sidebar for small screens -->
    <div id="mobileSidebar" class="absolute top-16 left-0 w-full bg-blue-800 text-white flex-col hidden md:hidden z-50">
        <a href="admin_home.php" class="block px-6 py-3 hover:bg-blue-700">Dashboard</a>
         <a href="add_category.php" class="block px-6 py-3 hover:bg-blue-700">Add Category</a>
        <a href="add_service.php" class="block px-6 py-3 hover:bg-blue-700">Add Service</a>
        <a href="report.php" class="block px-6 py-3 hover:bg-blue-500 bg-blue-600 ">Report</a>
        <div class="px-6 py-3">
            <a href="logout.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
        </div>
    </div>
    <main class="flex-1 p-6 md:ml-0">

        

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-blue-700 font-semibold mb-4">All Services</h2>
            <div class="overflow-x-auto">
                <section id="add-category-form" class="hidden ">
                    <div  className=" bg-white rounded-lg shadow-lg w-full max-w-2xl p-4 sm:p-6 relative flex flex-col md:flex-row overflow-y-auto max-h-[90vh]">
    <h2 class="text-2xl font-bold text-center text-blue-700 mt-2 mb-6 w-full">
            Add New Service
        </h2>
        <form  method="POST" class="space-y-4 max-w-xl mx-auto mb-6">
          <label class="block text-gray-700 font-medium mb-1">Category</label>
          <select id="category" name="category" required class="w-full border text-black border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select Category</option>
            <?php
            $selectCategories = "SELECT DISTINCT(category_name) as category_name,c_id as id FROM categories;";
            $result = $conn->query($selectCategories);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['category_name']) . '">' . htmlspecialchars($row['category_name']) . '</option>';
                }
            }
            ?>
          </select>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Company name</label>
          <select id="company" name="company" required class="w-full border text-black border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select category first</option>
          </select>
        <div class="mt-4 mb-4">
          <label class="block  font-medium text-gray-700"
            >Service Name</label
          >
          <input
            type="text"
            name="service_name"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        
       

        <button
          type="submit"
          name="submit_service"
          class="w-full  bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition"
        >
          + Add New Service
        </button>
      </form>
      </div>
                </section>
                <button id="add-category-btn" class="bg-blue-600 mb-2 hover:bg-blue-500 text-white px-4 py-2 rounded">Add New Service</button>
                <table id="category-table" class="min-w-full divide-y divide-blue-200">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">#</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Company name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Service Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-blue-200">
                         <?php
                            include '../db_connection/conn.php';
                            $id=0;
                            $sql = "SELECT s.service_name,s.createdAt,c.company_name FROM `services` s INNER JOIN categories c on c.c_id =s.category_id  ORDER BY s.createdAt DESC LIMIT 8";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $id +=1;
                                echo "<tr>
                                    <td class='px-4 py-2'>{$id}</td>
                                    <td class='px-4 py-2'>{$row['company_name']}</td>
                                    <td class='px-4 py-2'>{$row['service_name']}</td>
                                    <td class='px-4 py-2'>{$row['createdAt']}</td>
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

    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db_connection/conn.php';
    if (isset($_POST['submit_service'])) {
   
        $company_name = $_POST['company'];
        $service_name = $_POST['service_name'];

    


            $stmt = $conn->query("INSERT INTO services (service_name, category_id) VALUES ('$service_name', '$company_name')");

            if ($stmt) {
                echo "<script>alert('Service added successfully'); window.location.href='add_service.php';</script>";
            } else {
                echo "<script>alert('Error adding service'); window.location.href='add_service.php';</script>";
            }
            $stmt->close();
 
    }
}
?>