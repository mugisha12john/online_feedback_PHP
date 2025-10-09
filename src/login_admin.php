<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FeedUs |Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body
    class="bg-orange-50 flex items-center justify-center min-h-screen font-sans"
  >
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8 relative">
      <!-- Legend-style icon -->
      <div
        class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-orange-600 text-white rounded-full p-4 shadow-lg"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-8 w-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"
          />
        </svg>
      </div>

      <!-- Form -->
      <h2 class="text-2xl font-bold text-center text-orange-700 mt-8 mb-6">
        Welcome Admin! Please Login to share the services
      </h2>

      <form  method="POST" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input
            type="email"
            name="email"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700"
            >Password</label
          >
          <input
            type="password"
            name="password"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-orange-600 text-white py-2 rounded-lg font-semibold hover:bg-orange-700 transition"
        >
         Admin Login
        </button>
          <p class="text-center text-gray-600 text-sm mt-4">
        Don't have an admin account?
        <a href="signup_admin.php" class="text-orange-600 font-medium hover:underline">
            Create Account
        </a>
      </p>
      </form>

  

    </div>
  </body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db_connection/conn.php';
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM admins WHERE email='$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = 'admin';
            echo "<script>alert('Login successful!'); window.location.href='admin_home.php';</script>";
        } else {
            echo "<script>alert('Invalid password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No admin found with this email.');</script>";
    }

    $conn->close();
}
?>