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
    <aside
      class="bg-blue-700 text-white w-64 flex flex-col justify-between p-6"
    >
      <div>
        <h1 class="text-2xl font-bold mb-10 text-center">FeedUs</h1>

        <nav class="space-y-4">
          <a
            href="#"
            class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition"
          >
            🗣️ <span>Share Opinion</span>
          </a>
          <a
            href="#"
            class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition"
          >
            📜 <span>Review</span>
          </a>
          <a
            href="#"
            class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition"
          >
            ⚙️ <span>Settings</span>
          </a>
        </nav>
      </div>

      <div>
        <a
          href="logout.php"
          class="flex items-center gap-3 text-lg font-medium hover:bg-blue-600 p-2 rounded transition"
        >
          🚪 <span>Logout</span>
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 md:p-12 ">
      <h2 class="text-3xl font-bold text-blue-700 mb-6">Share Your Feedback</h2>

      <form
        action="submit_feedback.php"
        method="POST"
        class="bg-white p-6 rounded-2xl shadow-md max-w-2xl"
      >
        <!-- Category -->
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Category</label>
          <select
            name="category"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="">Select Category</option>
            <option value="Telecom">Telecom</option>
            <option value="Banking">Banking</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Government">Government</option>
            <option value="Food & Beverage">Food & Beverage</option>
          </select>
        </div>

        <!-- Service -->
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Service</label>
          <select
            name="service"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="">Select Service</option>
            <option value="MTN Mobile Money">MTN Mobile Money</option>
            <option value="BK Online Banking">BK Online Banking</option>
            <option value="King Faisal Appointment">
              King Faisal Appointment
            </option>
            <option value="IremboGov Services">IremboGov Services</option>
            <option value="Inyange Delivery">Inyange Delivery</option>
          </select>
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1"
            >Description</label
          >
          <textarea
            name="description"
            maxlength="200"
            rows="5"
            required
            placeholder="Write your feedback here (max 200 words)"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
          <p class="text-sm text-gray-500 mt-1">Max: 200 words</p>
        </div>

        <!-- Button -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition"
        >
          Send Feedback
        </button>
      </form>
    </main>
  </body>
</html>
