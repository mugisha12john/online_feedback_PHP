<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FeedUs | Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body
    class="bg-blue-50 flex items-center justify-center min-h-screen font-sans"
  >
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8 relative">
      <!-- Legend-style icon -->
      <div
        class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white rounded-full p-4 shadow-lg"
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
      <h2 class="text-2xl font-bold text-center text-blue-700 mt-8 mb-6">
        Create Account
      </h2>

      <form  method="POST" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700"
            >First Name</label
          >
          <input
            type="text"
            name="firstname"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700"
            >Last Name</label
          >
          <input
            type="text"
            name="lastname"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input
            type="email"
            name="email"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
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
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700"
            >Confirm Password</label
          >
          <input
            type="password"
            name="confirm_password"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition"
        >
          Sign Up
        </button>
      </form>

      <p class="text-center text-gray-600 text-sm mt-4">
        Already have an account?
        <a href="login.php" class="text-blue-600 font-medium hover:underline">
          Login
        </a>
      </p>
    </div>
  </body>
</html>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include '../db_connection/conn.php';
    // Get form data and sanitize inputs
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
        // Check if email already exists
        $checkQuery = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already registered. Please use a different email.');</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $insertQuery = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashedPassword')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
    mysqli_close($conn);
}
?>