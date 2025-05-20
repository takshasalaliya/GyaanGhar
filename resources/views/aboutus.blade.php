<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About GyaanGhar | Our Mission and Vision</title>
    <meta name="description" content="Learn about GyaanGhar's mission to make quality education accessible. Discover our vision for empowering learners and educators in the digital space.">

    <link rel="canonical" href="{{ url('/about-us') }}" />
    <meta property="og:title" content="About GyaanGhar | Our Mission and Vision" />
    <meta property="og:description" content="Learn about GyaanGhar's mission to make quality education accessible. Discover our vision for empowering learners and educators in the digital space." />
    <meta property="og:url" content="{{ url('/about-us') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/Mkr5YDHV/Whats-App-Image-2025-05-14-at-23-46-30_70cce24f.jpg" /> {{-- Using the hero image as a relevant OG image --}}
    <link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .content-section p {
            line-height: 1.75; /* Increased line height for readability */
        }
         /* Ensure Phosphor icons inherit text color if not set explicitly */
        [class^="ph-"] {
            vertical-align: middle; /* Better alignment with text */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/about-us'); // Specific URL for the About Us page

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
            'description' => 'GyaanGhar is the ultimate platform for personalized learning and seamless access to educational resources, empowering learners and educators in the digital space.',
            // 'foundingDate' => 'YYYY-MM-DD', // If you have a founding date
            // 'founder' => [ '@type' => 'Person', 'name' => 'Founder Name' ], // If applicable
        ];

        $aboutPageSchema = [
            '@type' => ['WebPage', 'AboutPage'], // Multiple types
            'url' => $pageFullUrl,
            'name' => 'About GyaanGhar | Our Mission and Vision',
            'description' => "Learn about GyaanGhar's mission to make quality education accessible. Discover our vision for empowering learners and educators in the digital space.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'mainEntity' => ['@id' => $siteBaseUrl . '#organization'], // The main entity this page is about is the Organization
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'About Us']
                ]
            ]
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $aboutPageSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-9 sm:h-10 mr-2">
                <span class="text-xl sm:text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
            </a>
            <nav class="flex items-center space-x-2 sm:space-x-4">
                <a href="javascript:history.back()" class="text-xs sm:text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group px-2 py-1.5 rounded-md hover:bg-gray-100">
                    <ph-arrow-left size="16" weight="bold" class="sm:mr-1 transform group-hover:-translate-x-0.5 transition-transform"></ph-arrow-left>
                    <span class="hidden sm:inline">Back</span>
                </a>
                <a href="/" class="text-xs sm:text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group px-2 py-1.5 rounded-md hover:bg-gray-100">
                     <ph-house size="16" weight="bold" class="sm:mr-1"></ph-house>
                    <span class="hidden sm:inline">Home</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="py-12 sm:py-16">
        <!-- Hero Section for About Us -->
        <div class="bg-gradient-to-br from-indigo-50 via-blue-50 to-purple-50 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <ph-info size="64" weight="duotone" class="text-indigo-600 mx-auto mb-4"></ph-info>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
                    About <span class="text-indigo-600">GyaanGhar</span>
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover our story, mission, and commitment to transforming education through technology.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16 content-section">
            <div class="bg-white shadow-xl rounded-xl p-8 sm:p-10">
                <section class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-4 flex items-center">
                        <ph-books size="32" weight="duotone" class="text-blue-600 mr-3"></ph-books>
                        Our Story
                    </h2>
                    <p class="mb-4 text-gray-700">
                        Welcome to <strong>GyaanGhar</strong> – your digital house of knowledge. Founded with the vision of making quality educational content accessible and engaging for all, GyaanGhar is built by passionate educators and technologists who believe in the power of learning.
                    </p>
                    <p class="mb-4 text-gray-700">
                        We understand the challenges faced by both teachers and students in today's dynamic educational landscape. Our platform is designed to bridge gaps, simplify processes, and foster a collaborative learning environment.
                    </p>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-4 flex items-center">
                        <ph-target size="32" weight="duotone" class="text-green-600 mr-3"></ph-target>
                        Our Mission
                    </h2>
                    <p class="mb-4 text-gray-700">
                        Our mission is to empower educators to create and share high-quality learning materials effortlessly, and to provide students with seamless access to personalized educational resources. We strive to make learning smarter, not harder, by leveraging intuitive study tools and a unique, user-friendly approach to education.
                    </p>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-4 flex items-center">
                        <ph-lightbulb size="32" weight="duotone" class="text-yellow-500 mr-3"></ph-lightbulb>
                        Our Vision
                    </h2>
                    <p class="mb-4 text-gray-700">
                        We envision GyaanGhar as a leading global platform where knowledge sharing knows no bounds. We aim to cultivate a community where learning is interactive, personalized, and inspiring, helping individuals unlock their full potential and achieve their academic goals.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-4 flex items-center">
                        <ph-users-three size="32" weight="duotone" class="text-purple-600 mr-3"></ph-users-three>
                        How We Help
                    </h2>
                    <p class="mb-4 text-gray-700">
                        GyaanGhar enables teachers to effortlessly register, create virtual classes, and upload diverse content—from detailed PDFs and engaging audio lectures to interactive quizzes. Students simply use a unique access code to join a class, instantly gaining entry to all shared resources and embarking on personalized learning paths.
                    </p>
                    <p class="text-gray-700">
                        Whether you're a student seeking deeper understanding or a teacher dedicated to sharing your expertise, GyaanGhar is the platform to connect, collaborate, and grow in knowledge. Join us in reshaping the future of education.
                    </p>
                </section>

                 <div class="mt-10 text-center">
                    <a href="/"
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <ph-rocket-launch size="20" weight="bold" class="mr-2"></ph-rocket-launch>
                        Explore GyaanGhar
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 w-full">
        <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <a href="/" class="flex items-center mb-4">
                    <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Footer Logo" class="h-10 sm:h-12 mr-2">
                    <span class="text-xl sm:text-2xl font-bold text-white">GyaanGhar</span>
                </a>
                <p class="text-sm text-gray-400">Empowering education through accessible technology. Your digital house of knowledge.</p>
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