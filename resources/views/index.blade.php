<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GyaanGhar</title>
    <meta name="description" content="Welcome to GyaanGhar, the ultimate platform for personalized learning and seamless access to educational resources.Join now to gain exclusive access to classes, folders, and lectures that empower your learning journey. With a user-friendly interface, intuitive study tools, and a unique approach to education, we help you learn smarter, not harder.">
    <link rel="canonical" href="{{url()->full()}}" />
    <meta property="og:title" content="GyaanGhar" />
    <meta property="og:description" content="Welcome to GyaanGhar, the ultimate platform for personalized learning and seamless access to educational resources.Join now to gain exclusive access to classes, folders, and lectures that empower your learning journey. With a user-friendly interface, intuitive study tools, and a unique approach to education, we help you learn smarter, not harder." />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg" />
    <link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon" class="favicon">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Custom float animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/'); // Base URL of the site, ensuring no trailing slash
        $pageFullUrl = url()->full();       // Full URL of the current page

        // Page specific information (matches meta tags)
        $currentPageTitle = "Welcome to GyaanGhar";
        $currentPageDescription = "Welcome to GyaanGhar, the ultimate platform for personalized learning and seamless access to educational resources.Join now to gain exclusive access to classes, folders, and lectures that empower your learning journey. With a user-friendly interface, intuitive study tools, and a unique approach to education, we help you learn smarter, not harder.";

        // Organization specific information
        $organizationName = "GyaanGhar";
        $organizationLogo = "https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png"; // Main logo URL
        $organizationDescription = $currentPageDescription; // Often, the main page description can serve for the organization too

        $schemaGraph = [];

        // 1. Organization Schema
        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization', // Unique ID for the organization
            'name' => $organizationName,
            'url' => $siteBaseUrl,
            'logo' => $organizationLogo,
            'description' => $organizationDescription,
            // 'contactPoint' => [ /* ... if you have contact info ... */ ],
            // 'sameAs' => [ /* ... links to social media profiles ... */ ]
        ];

        // 2. WebPage Schema (for the current page)
        $webPageSchema = [
            '@type' => 'WebPage',
            '@id' => $pageFullUrl . '#webpage', // Unique ID for this specific page
            'url' => $pageFullUrl,
            'name' => $currentPageTitle,
            'description' => $currentPageDescription,
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'], // This page is part of the main organization/website
            'primaryImageOfPage' => [
                '@type' => 'ImageObject',
                'url' => 'https://i.ibb.co/Mkr5YDHV/Whats-App-Image-2025-05-14-at-23-46-30_70cce24f.jpg' // Hero image of the page
            ],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'], // The organization is the publisher of this webpage
        ];

        // 3. Service Schema (describing what GyaanGhar offers)
        $serviceSchema = [
            '@type' => 'Service',
            '@id' => $siteBaseUrl . '#service', // Unique ID for the service
            'serviceType' => 'Online Learning Platform', // Or "EducationalServices"
            'provider' => ['@id' => $siteBaseUrl . '#organization'], // GyaanGhar is the provider
            'name' => 'GyaanGhar Personalized Learning Platform',
            'description' => 'GyaanGhar offers a personalized learning experience where teachers can create virtual classes, upload diverse content (PDFs, audio, quizzes), and students can access these resources using a unique code to learn, test their knowledge, and track progress.',
            'areaServed' => [ // Optional: defines where the service is available
                '@type' => 'Place',
                'name' => 'Worldwide' // Or specific regions if applicable
            ],
            'offers' => [ // Optional: if there's pricing information or free access
                '@type' => 'Offer',
                'price' => '0', // Assuming basic student access is free. Adjust if necessary.
                'priceCurrency' => 'USD' // Adjust currency if necessary. Use appropriate ISO 4217 currency code.
            ]
        ];

        // Add initial schemas to the graph
        // Add organization schema first, as we might modify it with aggregateRating
        $schemaGraph[] = $organizationSchema;
        $schemaGraph[] = $webPageSchema;
        $schemaGraph[] = $serviceSchema;

        // 4. Reviews and AggregateRating (if $reviews variable is passed from controller and is not empty)
        // $reviews is assumed to be an array like: [['name' => 'User Name', 'star' => 5, 'message' => 'Great platform!', 'role' => 'student'], ...]
        $reviewCount = (isset($reviews) && is_array($reviews)) ? count($reviews) : 0;

        if ($reviewCount > 0) {
            $totalStars = 0;
            $validReviewsForAverage = 0; // Count reviews that have a valid star rating

            foreach ($reviews as $review) {
                if (isset($review['star']) && is_numeric($review['star'])) {
                    $totalStars += (int)$review['star'];
                    $validReviewsForAverage++;
                }
            }
            
            $averageRating = ($validReviewsForAverage > 0) ? round($totalStars / $validReviewsForAverage, 1) : 0;

            // Update Organization schema with AggregateRating
            // Ensure $schemaGraph[0] is indeed the Organization schema before modifying
            if (isset($schemaGraph[0]) && $schemaGraph[0]['@type'] === 'Organization') {
                 $schemaGraph[0]['aggregateRating'] = [
                    '@type' => 'AggregateRating',
                    'ratingValue' => (string)$averageRating, // Schema.org often expects string for ratingValue
                    'bestRating' => '5',    // Maximum rating score
                    'worstRating' => '1',   // Minimum rating score
                    'reviewCount' => (string)$reviewCount // Total number of reviews displayed
                ];
            }

            // Add individual Review schemas to the graph
            foreach ($reviews as $review) {
                // Ensure essential review fields are present to avoid errors
                if (!isset($review['name']) || !isset($review['star']) || !isset($review['message']) || !is_numeric($review['star'])) {
                    continue; // Skip incomplete or malformed reviews
                }

                $schemaGraph[] = [
                    '@type' => 'Review',
                    'itemReviewed' => ['@id' => $siteBaseUrl . '#organization'], // Reviews are for the GyaanGhar Organization
                    'author' => [
                        '@type' => 'Person',
                        'name' => htmlspecialchars($review['name']) // Sanitize user-provided name
                    ],
                    'reviewRating' => [
                        '@type' => 'Rating',
                        'ratingValue' => (string)$review['star'],
                        'bestRating' => '5',
                        'worstRating' => '1'
                    ],
                    'reviewBody' => htmlspecialchars($review['message']), // Sanitize user-provided message
                    'publisher' => [ // The entity that published this review (e.g., GyaanGhar platform itself for reviews on its site)
                        '@type' => 'Organization',
                        'name' => $organizationName
                    ]
                    // 'datePublished' => 'YYYY-MM-DD', // If you have the date the review was published
                ];
            }
        }

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => $schemaGraph // Use @graph to connect multiple entities
        ];
    @endphp

    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

<!-- Header -->
<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/" class="flex items-center">
            <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-10 mr-2"> 
            <span class="text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
        </a>
        <nav class="hidden md:flex space-x-6">
            <a href="/" class="text-base font-medium text-gray-700 hover:text-blue-700 transition duration-300">Home</a>
            <a href="/login" class="text-base font-medium text-gray-700 hover:text-blue-700 transition duration-300">Teacher Login</a>
            <a href="/register" class="text-base font-medium text-gray-700 hover:text-blue-700 transition duration-300">Teacher Register</a>
        </nav>
        <button class="md:hidden text-gray-700 focus:outline-none text-2xl" onclick="toggleMenu()">
            ☰ <!-- Hamburger icon -->
        </button>
    </div>
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 bg-white border-t border-gray-200">
        <a href="/" class="block py-2 text-base text-gray-700 hover:bg-gray-100 rounded-md transition duration-300">Home</a>
        <a href="/login" class="block py-2 text-base text-gray-700 hover:bg-gray-100 rounded-md transition duration-300">Teacher Login</a>
        <a href="/register" class="block py-2 text-base text-gray-700 hover:bg-gray-100 rounded-md transition duration-300">Teacher Register</a>
    </div>
</header>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-100 to-indigo-200 py-20 sm:py-24">
    <div class="max-w-6xl mx-auto px-4 text-center grid grid-cols-1 md:grid-cols-2 items-center gap-10">
        <div class="md:order-1 order-2">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-blue-800 leading-tight mb-4">
                Shiksha ka Ghar – <span class="text-indigo-600">GyaanGhar</span>
            </h2>
            <p class="text-gray-600 text-lg sm:text-xl mb-8 max-w-lg mx-auto">
                Your ultimate platform for personalized learning and seamless access to educational resources. <br><span class="font-semibold text-indigo-700">Learn smarter, not harder.</span>
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="/student" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:from-blue-700 hover:to-blue-800 transition duration-300 transform hover:scale-105">
                    🚀 Student Access
                </a>
                <a href="/login" class="inline-block bg-gradient-to-r from-purple-600 to-indigo-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:from-purple-700 hover:to-indigo-800 transition duration-300 transform hover:scale-105">
                    🧑‍🏫 Teacher Login
                </a>
            </div>
        </div>
        <div class="md:order-2 order-1 flex justify-center items-center">
            <img src="https://i.ibb.co/Mkr5YDHV/Whats-App-Image-2025-05-14-at-23-46-30_70cce24f.jpg" alt="GyaanGhar Learning Platform" class="w-full max-w-md rounded-lg shadow-2xl animate-float">
        </div>
    </div>
</section>

<!-- How it Works -->
<section class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-12">📚 How GyaanGhar Empowers Learning</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="text-5xl mb-4 text-blue-500">✨</div>
                <h4 class="text-xl font-semibold text-gray-800 mb-3">1. Teacher Creates & Uploads</h4>
                <p class="text-gray-600 text-base">Educators effortlessly register, create virtual classes, and upload diverse content: from detailed PDFs and engaging audio lectures to interactive quizzes.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="text-5xl mb-4 text-green-500">🔗</div>
                <h4 class="text-xl font-semibold text-gray-800 mb-3">2. Students Access with Code</h4>
                <p class="text-gray-600 text-base">Students simply use a unique access code to join a class, instantly gaining entry to all shared resources and personalized learning paths.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="text-5xl mb-4 text-purple-500">📈</div>
                <h4 class="text-xl font-semibold text-gray-800 mb-3">3. Learn, Test & Track Progress</h4>
                <p class="text-gray-600 text-base">Students engage with content, attempt quizzes to solidify knowledge, while teachers monitor progress and identify areas for improvement.</p>
            </div>
        </div>
    </div>
</section>

<!-- Reviews -->
<section class="py-16 bg-white">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-10">🌟 What Our Users Say</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($reviews as $r)
        <div class="bg-gray-50 p-6 rounded-lg shadow-md flex flex-col justify-between transform hover:scale-102 transition duration-300">
          <div>
            <p class="text-gray-700 italic mb-4">"{{ $r['message'] }}"</p>
          </div>
          <div class="mt-4">
            <!-- stars -->
            <div class="flex justify-center mb-2">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $r['star'])
                  <span class="text-amber-400 text-xl">★</span>
                @else
                  <span class="text-gray-300 text-xl">★</span>
                @endif
              @endfor
            </div>
            <!-- reviewer name & role -->
            <div class="font-semibold text-sm text-gray-800">
              – {{ $r['name'] }}
              <span class="text-gray-500">({{ ucfirst($r['role']) }})</span>
            </div>
          </div>
        </div>
      @empty
        <p class="col-span-full text-center text-gray-500 text-lg">No reviews available at the moment. Be the first to share your experience!</p>
      @endforelse
    </div>

    <div class="mt-12">
      <a href="/review"
         class="inline-block bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-medium py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105">
        ⭐ Leave a Review
      </a>
    </div>
  </div>
</section>


<!-- Footer -->
<footer class="bg-gray-800 text-white mt-16 w-full">
    <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1">
            <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Footer Logo" class="h-12 mb-4">
            <p class="text-sm text-gray-400">Empowering education through accessible technology. GyaanGhar - Your house of knowledge.</p>
        </div>
        <div class="md:col-span-2">
            <h3 class="text-lg font-semibold mb-3 border-b border-gray-700 pb-2">Quick Links</h3>
            <ul class="space-y-2 text-sm grid grid-cols-2 sm:grid-cols-3 gap-2">
                <li><a href="/privacy-policy" class="hover:text-blue-400 transition duration-200">Privacy Policy</a></li>
                <li><a href="/about-us" class="hover:text-blue-400 transition duration-200">About Us</a></li>
                <li><a href="/contact-us" class="hover:text-blue-400 transition duration-200">Contact Us</a></li>
                <li><a href="/disclaimer" class="hover:text-blue-400 transition duration-200">Disclaimer</a></li>
                <li><a href="/terms-and-conditions" class="hover:text-blue-400 transition duration-200">Terms & Conditions</a></li>
                <li><a href="/review" class="hover:text-blue-400 transition duration-200">Leave a Review</a></li>
            </ul>
        </div>
    </div>
    <div class="text-center py-6 border-t border-gray-700 text-sm text-gray-400">
        © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
    </div>
</footer>

</body>
</html>