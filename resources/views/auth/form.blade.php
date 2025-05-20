<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Registration - GyaanGhar</title>
    <meta name="description" content="Create your GyaanGhar account to access exclusive educational resources, classes, and lectures. Join our learning community today!" />
    <link rel="canonical" href="{{ url('/register') }}" /> {{-- Assuming this page is at /register --}}
    <meta property="og:title" content="User Registration - GyaanGhar" />
    <meta property="og:description" content="Create your GyaanGhar account to access exclusive educational resources, classes, and lectures. Join our learning community today!" />
    <meta property="og:url" content="{{ url('/register') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" />
    <link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* Custom focus style for inputs for better visibility */
        .form-input:focus {
            border-color: #4f46e5; /* Indigo-600 */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.3);
        }
        .form-checkbox:checked {
            background-color: #4f46e5; /* Indigo-600 */
            border-color: #4f46e5;
        }
        .form-checkbox:focus {
            ring-color: #4f46e5; /* Indigo-600 */
            ring-offset-color: white;
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/register'); // Specific URL for the registration page

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
        ];

        $webPageSchema = [
            '@type' => 'WebPage',
            'url' => $pageFullUrl,
            'name' => 'User Registration - GyaanGhar',
            'description' => 'Create your GyaanGhar account to access exclusive educational resources, classes, and lectures. Join our learning community today!',
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            // If this page is part of a larger website structure
            // 'breadcrumb' => [
            //     '@type' => 'BreadcrumbList',
            //     'itemListElement' => [
            //         ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
            //         ['@type' => 'ListItem', 'position' => 2, 'name' => 'Register']
            //     ]
            // ]
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $webPageSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Minimal Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-10 mr-2">
                <span class="text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
            </a>
            <!-- Optional: Link to Home if needed -->
            <a href="/" class="text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150">
                Back to Home
            </a>
        </div>
    </header>

    <main class="flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        @if(session('message'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 w-full max-w-md rounded-md shadow-md animate__animated animate__fadeInDown" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="bg-white p-8 sm:p-10 rounded-xl shadow-2xl w-full max-w-md animate__animated animate__fadeInUp">
            <!-- Back Button (using js:history.back) -->
            <div class="mb-6 text-left">
              <a href="javascript:history.back()" class="text-sm text-gray-600 hover:text-blue-700 inline-flex items-center transition duration-150 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 transform group-hover:-translate-x-1 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
              </a>
            </div>

            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Create your Account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    And start your journey with <span class="font-semibold text-indigo-600">GyaanGhar</span>!
                </p>
            </div>

            <form class="mt-8 space-y-6" action="/user-register" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" autocomplete="name" required
                               value="{{ old('name') }}"
                               class="form-input appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="e.g., Ada Lovelace">
                    </div>
                    @error('name')
                        <p class="mt-2 text-xs text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email') }}"
                               class="form-input appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="form-input appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                     @error('password')
                        <p class="mt-2 text-xs text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms-conditions" name="Check-Box" type="checkbox" required
                               class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms-conditions" class="font-medium text-gray-700">I agree to the
                            <a href="/terms-and-conditions" class="text-indigo-600 hover:text-indigo-500 underline" target="_blank" rel="noopener noreferrer">Terms and Conditions</a>
                        </label>
                    </div>
                </div>
                @error('Check-Box')
                    <p class="mt-1 text-xs text-red-600 flex items-center">
                         <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror


                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500 underline">
                        Sign in
                    </a>
                </p>
            </div>
        </div>

        <p class="text-center text-gray-500 mt-10 text-xs">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </p>
    </main>

    <!-- Animate.css is fine to keep, but Bootstrap JS is not needed if not using Bootstrap components -->
</body>
</html>