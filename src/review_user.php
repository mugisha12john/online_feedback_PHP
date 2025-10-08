<?php
session_start();
if (!isset($_SESSION['email'])) {
  echo "<script>alert('Please log in to access your dashboard.'); window.location.href='login.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FeedUs | User History</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-50 min-h-screen flex font-sans">
    <!-- Sidebar -->
    <aside class="bg-blue-700 text-white w-64 flex flex-col justify-between p-6">
      <div>
        <h1 class="text-2xl font-bold mb-10 text-center">FeedUs</h1>

        <nav class="space-y-4">
          <a href="user_home.php" class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition">🗣️ <span>Share Opinion</span></a>
          <a href="review_user.php" class="flex items-center gap-3 text-lg font-medium hover:bg-blue-500 p-2 rounded transition bg-blue-600">📜 <span>Review</span></a>
          <a href="#" class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition">⚙️ <span>Settings</span></a>
        </nav>
      </div>

      <div>
        <a href="logout.php" class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition">🚪 <span>Logout</span></a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 md:p-12 ">
      <h2 class="text-3xl font-bold text-blue-700 mb-6">All Feedback You Shared</h2>
        <div class="bg-white p-6 rounded-2xl shadow-md max-w-6xl">
           <table class="min-w-full border border-gray-300">
            <thead>
              <tr class="bg-blue-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Feedback ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Company name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Service</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Feedback</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Done At</th>
              </tr>
            </thead>
            <tbody>
           <?php
            include '../db_connection/conn.php';
            $email = $_SESSION['email'];
            $id = 1;
            $query = $conn->query("SELECT f.f_id AS feedback_id, f.description, f.createdAt, s.s_id AS service_id, s.service_name, c.category_name,c.company_name FROM feedback_users f INNER JOIN users u ON f.email = u.email INNER JOIN services s ON f.service_id = s.s_id INNER JOIN categories c ON s.category_id = c.c_id WHERE u.email = '$email' ORDER BY f.createdAt DESC");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
                    echo "<tr>
                            <td class='border border-gray-300 px-4 py-2'>{$id +=1}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['company_name']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['category_name']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['service_name']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['description']}</td>
                            <td class='border border-gray-300 px-4 py-2'>" . date('Y-m-d H:i', strtotime($row['createdAt'])) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='border border-gray-300 px-4 py-2 text-center'>No feedback found.</td></tr>";
            }
            ?>
            </tbody>
        </div>
    </main>
    </body>
</html>