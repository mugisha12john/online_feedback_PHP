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
            <a href="report.php" class="block px-6 py-3 hover:bg-blue-500 bg-blue-600 ">Report</a>
            <div class="mt-auto px-6 py-3">
                <a href="logout_admin.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
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
            <a href="logout_admin.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
        </div>
    </div>
    <main class="flex-1 p-6 md:ml-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-blue-600 font-semibold mb-2">Total Category</h2>
                <p class="text-2xl font-bold text-blue-800">
                     <?php
                        include '../db_connection/conn.php';
                        $result = $conn->query("SELECT COUNT(*) as total FROM categories    ");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                       
                        ?>
                </p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-blue-600 font-semibold mb-2">Total Serives</h2>
                <p class="text-2xl font-bold text-blue-800">
                        <?php
                        include '../db_connection/conn.php';
                        $result = $conn->query("SELECT COUNT(*) as total FROM services");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                      
                        ?>
                </p>
            </div>
             <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-blue-600 font-semibold mb-2">Total Feedback</h2>
                <p class="text-2xl font-bold text-blue-800">
                        <?php
                        include '../db_connection/conn.php';
                        $result = $conn->query("SELECT COUNT(*) as total FROM feedback_users");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                      
                        ?>
                </p>
            </div>

             <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-blue-600 font-semibold mb-2">Total Users</h2>
                <p class="text-2xl font-bold text-blue-800">
                        <?php
                        include '../db_connection/conn.php';
                        $result = $conn->query("SELECT COUNT(*) as total FROM users");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                      
                        ?>
                </p>
            </div>

        </div>
                    <table id="category-table" class="min-w-full divide-y divide-blue-200">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">#</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Username</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Company name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Service Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Feedback</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-blue-500">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-blue-200">
                         <?php
                            include '../db_connection/conn.php';
                            $id=0;
                            $sql = "SELECT f.f_id AS feedback_id, f.description, f.createdAt, s.s_id AS service_id, s.service_name, c.category_name,c.company_name,CONCAT(u.firstname, '  ',u.lastname) AS fullname,u.email FROM feedback_users f INNER JOIN users u ON f.email = u.email INNER JOIN services s ON f.service_id = s.s_id INNER JOIN categories c ON s.category_id = c.c_id  ORDER BY f.createdAt DESC LIMIT 8";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $id +=1;
                                echo "<tr>
                                    <td class='px-4 py-2'>{$id}</td>
                                    <td class='px-4 py-2'>{$row['fullname']}</td>
                                    <td class='px-4 py-2'>{$row['email']}</td>
                                    <td class='px-4 py-2'>{$row['company_name']}</td>
                                    <td class='px-4 py-2'>{$row['service_name']}</td>
                                    <td class='px-4 py-2'>{$row['description']}</td>
                                    
                                    <td class='px-4 py-2'>{$row['createdAt']}</td>
                                </tr>";
                            }
                            
                            ?>
                    </tbody>
                </table>
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
