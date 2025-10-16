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
<body class="bg-orange-100 h-screen flex flex-col md:flex-row">


    <aside class="bg-orange-800 text-white w-64 flex-shrink-0 hidden md:flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-orange-700">Admin Panel</div>
        <nav class="flex-1 flex flex-col mt-6">
            <a href="admin_home.php" class="px-6 py-3 hover:bg-orange-700">Dashboard</a>
            <a href="add_category.php" class="px-6 py-3 hover:bg-orange-700">Add Category</a>
            <a href="add_service.php" class="px-6 py-3 hover:bg-orange-500 bg-orange-600">Add Service</a>
            <a href="report.php" class="block px-6 py-3 hover:bg-orange-700"">Report</a>
            <div class="mt-auto px-6 py-3">
                <a href="Logout_admin.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
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
         <a href="add_category.php" class="block px-6 py-3 hover:bg-orange-700">Add Category</a>
        <a href="add_service.php" class="block px-6 py-3 hover:bg-orange-500 bg-orange-600">Add Service</a>
        <a href="report.php" class="block px-6 py-3 hover:bg-orange-700">Report</a>
        <div class="px-6 py-3">
            <a href="Logout_admin.php" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded">Logout</a>
        </div>
    </div>
    <main class="flex-1 p-6 md:ml-0">

      

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-orange-700 font-semibold mb-4">Update Service</h2>
            <div class="overflow-x-auto">
                <section id="add-category-form">
                    <div  className=" bg-white rounded-lg shadow-lg w-full max-w-2xl p-4 sm:p-6 relative flex flex-col md:flex-row overflow-y-auto max-h-[90vh]">
                     <h2 class="text-2xl font-bold text-center text-orange-700 mt-2 mb-6 w-full">
                         Modify your existing  Service
                     </h2>
        <form  method="POST" class="space-y-4 max-w-xl mx-auto mb-6">
            <?php
            include '../db_connection/conn.php';
            $id = $_GET['id'];         
            $stmt = $conn->query("SELECT s.s_id,c.category_name,s.service_name,s.createdAt,c.company_name FROM `services` s INNER JOIN categories c on c.c_id =s.category_id WHERE s_id = '$id'");
            if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            ?>
             <div class="mt-4 mb-4">
          <label class="  font-medium text-gray-700"
            >Category</label
          >
          <?php
          echo '<input disabled type="text" name="category_name" value="' . htmlspecialchars($row['category_name']) . '" required class="w-full border bg-gray-200 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-4"/>';
          
          ?>
        </div>

                <div class="mt-4 mb-4">
          <label class="  font-medium text-gray-700"
            >Service Name</label
          >
          <?php
          echo '<input type="text" name="service_name" value="' . htmlspecialchars($row['service_name']) . '" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-4"/>';
        }
          ?>
        </div>
         <div class="mt-4 mb-4">
          <label class="  font-medium text-gray-700"
            >Company Name</label
          >
          <select name="company" required class="w-full border border-gray-300 rounded  
        px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-4">
        <?php
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['c_id']) . '">' . htmlspecialchars($row['company_name']) . '</option>';
        }
        ?>
        </select>
        </div>

        
       

        <button
          type="submit"
          name="submit_service"
          class="w-full  bg-orange-600 text-white py-2 rounded-lg font-semibold hover:bg-orange-700 transition"
        >
          + Save changes
        </button>
      </form>
      </div>
    </section>
               
         
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
        $company_id = $_POST['company'];
        $id = $_GET['id']; 
        $service_name = $_POST['service_name'];
            $stmt = $conn->query("UPDATE  services  SET service_name='$service_name' WHERE s_id='$id'");

            if ($stmt) {
                echo "<script>alert('Service updated successfully'); window.location.href='add_service.php';</script>";
            } else {
                echo "<script>alert('Error updating service'); window.location.href='add_service.php';</script>";
            }
            $stmt->close();
 
    }
}
?>