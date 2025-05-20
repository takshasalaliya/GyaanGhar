<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact GyaanGhar | Get In Touch</title>
    <meta name="description" content="Contact GyaanGhar for any queries, suggestions, or support regarding our personalized learning platform. We're here to help you on your educational journey.">

    <link rel="canonical" href="{{ url('/contact-us') }}" />
    <meta property="og:title" content="Contact GyaanGhar | Get In Touch" />
    <meta property="og:description" content="Contact GyaanGhar for any queries, suggestions, or support regarding our personalized learning platform. We're here to help you on your educational journey." />
    <meta property="og:url" content="{{ url('/contact-us') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/Mkr5YDHV/Whats-App-Image-2025-05-14-at-23-46-30_70cce24f.jpg" /> {{-- Using a relevant general image --}}
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
        /* Custom focus styles for inputs */
        .form-input:focus,
        .form-textarea:focus {
            border-color: #4f46e5; /* Tailwind indigo-600 */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.3); /* Tailwind indigo-600 with opacity */
        }
         /* Ensure Phosphor icons inherit text color if not set explicitly */
        [class^="ph-"] {
            vertical-align: middle; /* Better alignment with text */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/contact-us'); // Specific URL for the Contact Us page

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
            'description' => 'GyaanGhar is the ultimate platform for personalized learning and seamless access to educational resources.',
            'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'email' => 'gyaanghar@comperify.com',
                    'contactType' => 'Customer Support', // Or 'Technical Support', 'General Queries'
                    'areaServed' => 'IN', // India
                    'availableLanguage' => ['English', 'Hindi', 'Gujarati'] // Example languages
                ]
                // You can add more contact points (e.g., for sales, specific departments)
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Anand',
                'addressRegion' => 'Gujarat',
                'addressCountry' => 'IN'
            ]
        ];

        $contactPageSchema = [
            '@type' => ['WebPage', 'ContactPage'], // Multiple types
            'url' => $pageFullUrl,
            'name' => 'Contact GyaanGhar | Get In Touch',
            'description' => "Contact GyaanGhar for any queries, suggestions, or support regarding our personalized learning platform. We're here to help you on your educational journey.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'mainEntity' => ['@id' => $siteBaseUrl . '#organization'], // The main entity this page is about is the Organization
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Contact Us']
                ]
            ]
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $contactPageSchema
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
        <!-- Hero Section for Contact Us -->
        <div class="bg-gradient-to-br from-indigo-50 via-blue-50 to-purple-50 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <ph-chat-centered-dots size="64" weight="duotone" class="text-indigo-600 mx-auto mb-4"></ph-chat-centered-dots>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Get in Touch
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                    We're here to help! Whether you have a question, suggestion, or need support, feel free to reach out.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16">
            @if (session('success'))
                <div class="mb-8 p-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><ph-check-circle size="24" weight="fill" class="text-green-500 mr-3"></ph-check-circle></div>
                        <div>
                            <p class="font-bold">Message Sent!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                 <div class="mb-8 p-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><ph-x-circle size="24" weight="fill" class="text-red-500 mr-3"></ph-x-circle></div>
                        <div>
                            <p class="font-bold">Oops! Something went wrong.</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif


            <div class="bg-white shadow-xl rounded-xl overflow-hidden md:grid md:grid-cols-2 md:gap-0">
                <!-- Contact Information -->
                <div class="p-8 sm:p-10 bg-indigo-600 text-white">
                    <h2 class="text-2xl sm:text-3xl font-semibold mb-6">Contact Information</h2>
                    <p class="mb-6 text-indigo-100">
                        You can reach us through the following channels. We typically respond within 24-48 hours.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <ph-envelope-simple size="28" weight="fill" class="text-indigo-300 mr-4 mt-1 flex-shrink-0"></ph-envelope-simple>
                            <div>
                                <h3 class="font-medium">Email Us</h3>
                                <a href="mailto:gyaanghar@comperify.com" class="text-indigo-200 hover:text-white hover:underline break-all">gyaanghar@comperify.com</a>
                            </div>
                        </div>
                        {{-- Add Phone Number if available
                        <div class="flex items-start">
                            <ph-phone size="28" weight="fill" class="text-indigo-300 mr-4 mt-1 flex-shrink-0"></ph-phone>
                            <div>
                                <h3 class="font-medium">Call Us</h3>
                                <a href="tel:+910000000000" class="text-indigo-200 hover:text-white hover:underline">+91 (000) 000-0000</a>
                            </div>
                        </div>
                        --}}
                    </div>
                    <p class="mt-8 text-sm text-indigo-200">
                        For immediate assistance, please check our FAQ section or community forums (if available).
                    </p>
                </div>

                <!-- Contact Form -->
                <div class="p-8 sm:p-10">
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-6">Send Us a Message</h2>
                    <form class="space-y-5" action="/contact" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Your Full Name" required value="{{ old('name') }}"
                                   class="form-input w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required value="{{ old('email') }}"
                                   class="form-input w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                            <textarea id="message" name="message" placeholder="How can we help you today?" rows="5" required
                                      class="form-textarea w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">{{ old('message') }}</textarea>
                            @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <ph-paper-plane-tilt size="20" weight="bold" class="mr-2"></ph-paper-plane-tilt>
                                Send Message
                            </button>
                        </div>
                    </form>
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