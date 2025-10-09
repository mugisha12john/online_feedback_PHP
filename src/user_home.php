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
    <title>FeedUs | User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-50 min-h-screen flex font-sans">
    <!-- Sidebar -->
    <aside class="bg-orange-700 text-white w-64 flex flex-col justify-between p-6">
      <div>
        <h1 class="text-2xl font-bold mb-10 text-center">FeedUs</h1>

        <nav class="space-y-4">
          <a href="user_home.php" class="flex items-center gap-3 text-lg font-medium hover:bg-orange-500 p-2 rounded transition bg-orange-600">🗣️ <span>Share Opinion</span></a>
          <a href="review_user.php" class="flex items-center gap-3 text-lg font-medium hover:bg-orange-600 p-2 rounded transition">📜 <span>Review</span></a>
          <a href="#" class="flex items-center gap-3 text-lg font-medium hover:bg-orange-600 p-2 rounded transition">⚙️ <span>Settings</span></a>
        </nav>
      </div>

      <div>
        <a href="logout.php" class="flex items-center gap-3 text-lg font-medium hover:bg-orange-600 p-2 rounded transition">🚪 <span>Logout</span></a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 md:p-12">
      <h2 class="text-3xl font-bold text-orange-700 mb-6">Share Your Feedback</h2>

      <form method="POST" class="bg-white p-6 rounded-2xl shadow-md max-w-2xl">
        <?php include '../db_connection/conn.php'; ?>

        <!-- Category Dropdown -->
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Category</label>
          <select id="category" name="category" required class="w-full border text-black border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <option value="">Select Category</option>
            <?php
            $selectCategories = "SELECT DISTINCT(category_name) FROM categories";
            $result = $conn->query($selectCategories);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['category_name']) . '">' . htmlspecialchars($row['category_name']) . '</option>';
                }
            }
            ?>
          </select>
        </div>

        <!-- Service Dropdown -->
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Service</label>
          <select id="service" name="service" required class="w-full border text-black border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <option value="">Select category first</option>
          </select>

          <!-- Loading spinner -->
          <div id="loading" class="hidden text-orange-600 text-sm mt-2 flex items-center gap-2">
            <svg class="animate-spin h-5 w-5 text-orange-600" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
            </svg>
            Loading services...
          </div>
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Description</label>
          <textarea
            name="description"
            maxlength="200"
            rows="5"
            required
            placeholder="Write your feedback here (max 200 words)"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
          ></textarea>
          <p class="text-sm text-gray-500 mt-1">Max: 200 words</p>
        </div>

        <!-- Button -->
        <button
          type="submit"
          name="submit_feedback"
          class="w-full bg-orange-600 text-white py-2 rounded-lg font-semibold hover:bg-orange-700 transition"
        >
          Send Feedback
        </button>
      </form>
    </main>

    <!-- JavaScript for AJAX -->
    <script>
      document.getElementById('category').addEventListener('change', function() {
        const category = this.value;
        const serviceDropdown = document.getElementById('service');
        const loadingIndicator = document.getElementById('loading');

        if (!category) {
          serviceDropdown.innerHTML = '<option value="">Select category first</option>';
          return;
        }

        serviceDropdown.innerHTML = '<option value="">Loading...</option>';
        loadingIndicator.classList.remove('hidden');

        fetch('get_services.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'category=' + encodeURIComponent(category)
        })
        .then(response => response.text())
        .then(data => {
          serviceDropdown.innerHTML = data || '<option value="">No services found</option>';
        })
        .catch(error => {
          serviceDropdown.innerHTML = '<option value="">Error loading services</option>';
          console.error('Error:', error);
        })
        .finally(() => {
          loadingIndicator.classList.add('hidden');
        });
      });
    </script>
  </body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    include '../db_connection/conn.php';

    $category = $_POST['category'];
    $service = $_POST['service'];
 
   
    $userResult = $conn->query("SELECT CONCAT(firstname,' ',lastname) as name FROM users WHERE email='$email'");

    $user_Fname = $userResult->fetch_assoc()['name'];
 
    $insertFeedback =$conn->query("INSERT INTO feedback_users(name, email, service_id, description) VALUES('$user_Fname', '$email', '$service', '$description')");
    if ($insertFeedback) {
        echo "<script>alert('Feedback submitted successfully! Thank you for your input.'); window.location.href='user_home.php';</script>";
    } else {
        echo "<script>alert('Error submitting feedback. Please try again later.');</script>";
    }
  
    $conn->close();
}
?>