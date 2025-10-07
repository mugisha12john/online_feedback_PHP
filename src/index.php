<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FeedUs | Rwanda Feedback Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
      <!-- Left: Logo -->
      <div class="text-2xl font-bold text-blue-600">FeedUs</div>

      <!-- Center: Links -->
      <div class="hidden md:flex space-x-6 text-gray-600 font-medium">
        <a href="#about" class="hover:text-blue-600">About Us</a>
        <a href="#contact" class="hover:text-blue-600">Contact Us</a>
        <a href="#contributors" class="hover:text-blue-600">Contributors</a>
      </div>

      <!-- Right: Buttons -->
      <div class="space-x-4">
        <a
          href="login.php"
          class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition"
        >
          Login
        </a>
        <a
          href="signup.php"
          class="border border-blue-600 text-blue-600 px-4 py-2 rounded-full hover:bg-blue-600 hover:text-white transition"
        >
          Sign Up
        </a>
      </div>
    </nav>

    <!-- Hero Section -->
    <section
      class="flex flex-col md:flex-row items-center justify-between px-6 md:px-16 py-16"
    >
      <div class="max-w-lg">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-blue-700">
          Your Voice, Our Progress!
        </h1>
        <p class="text-gray-600 mb-6">
          FeedUs helps Rwandan companies understand your experiences. Share
          feedback on services — good or bad — and help improve the nation’s
          service quality.
        </p>
        <button
          class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition"
        >
          Get Started
        </button>
      </div>

      <div class="mt-10 md:mt-0">
        <img
          src="https://images.unsplash.com/photo-1605902711622-cfb43c4437b5?auto=format&fit=crop&w=600&q=80"
          alt="Feedback"
          class="rounded-2xl shadow-lg w-full h-[50vh] md:w-[450px]"
        />
      </div>
    </section>

    <!-- About Us -->
    <section id="about" class="px-6 md:px-16 py-16 bg-blue-50">
      <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">
        About Us
      </h2>
      <p class="max-w-3xl mx-auto text-center text-gray-700">
        FeedUs is an online system built to help Rwandans easily share their
        opinions and experiences with different companies. We connect voices
        from all districts to organizations that value customer satisfaction.
      </p>
    </section>

    <!-- Contributors / Testimonies -->
    <section id="contributors" class="px-6 md:px-16 py-16">
      <h2 class="text-3xl font-bold text-center text-blue-700 mb-10">
        Contributors
      </h2>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <p class="italic text-gray-600">
            "FeedUs helped us receive real feedback from our customers faster
            than ever."
          </p>
          <h3 class="mt-4 font-semibold text-blue-600">MTN Rwanda</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <p class="italic text-gray-600">
            "As a user, I love how easy it is to report good and bad services."
          </p>
          <h3 class="mt-4 font-semibold text-blue-600">Aline U.</h3>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <p class="italic text-gray-600">
            "FeedUs creates a bridge between companies and the people they
            serve."
          </p>
          <h3 class="mt-4 font-semibold text-blue-600">Bank of Kigali</h3>
        </div>
      </div>
    </section>

    <!-- Contact Us -->
    <section id="contact" class="px-6 md:px-16 py-16 bg-blue-50">
      <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">
        Contact Us
      </h2>
      <div class="text-center text-gray-700">
        <p><strong>Tel:</strong> +250 788 000 000</p>
        <p><strong>Location:</strong> Kigali, Rwanda</p>
        <p><strong>Working Days:</strong> Mon - Sat (8:00 AM - 6:00 PM)</p>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="px-6 md:px-16 py-16 text-center bg-blue-600 text-white">
      <h2 class="text-3xl font-bold mb-4">FeedUs Now!</h2>
      <p class="mb-6">
        Whether you faced an issue or received amazing service, let us know and
        make Rwanda better.
      </p>
      <button
        class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-100 transition"
      >
        Give Feedback
      </button>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10 px-6 md:px-16">
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div>
          <h3 class="text-white font-bold mb-4">FeedUs</h3>
          <p>Empowering Rwandans through feedback for better services.</p>
        </div>

        <div>
          <h3 class="text-white font-bold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li><a href="#about" class="hover:text-blue-400">About Us</a></li>
            <li>
              <a href="#contact" class="hover:text-blue-400">Contact Us</a>
            </li>
            <li>
              <a href="#contributors" class="hover:text-blue-400"
                >Contributors</a
              >
            </li>
          </ul>
        </div>

        <div>
          <h3 class="text-white font-bold mb-4">Contact</h3>
          <p>📍 Kigali, Rwanda</p>
          <p>📞 +250 788 000 000</p>
          <p>✉️ support@feedus.rw</p>
        </div>

        <div>
          <h3 class="text-white font-bold mb-4">Follow Us</h3>
          <div class="flex space-x-4">
            <a href="#" class="hover:text-blue-400">Facebook</a>
            <a href="#" class="hover:text-blue-400">Twitter</a>
            <a href="#" class="hover:text-blue-400">Instagram</a>
          </div>
        </div>
      </div>

      <div class="text-center mt-10 border-t border-gray-700 pt-6">
        <p>© 2025 FeedUs Rwanda. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>
