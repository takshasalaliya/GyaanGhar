<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Login - GyaanGhar</title>
    <meta name="description" content="Log in to your GyaanGhar account to access your personalized learning dashboard, classes, folders, and lectures. Continue your learning journey!" />
    <link rel="canonical" href="{{ url('/login') }}" /> {{-- Assuming this page is at /login --}}
    <meta property="og:title" content="User Login - GyaanGhar" />
    <meta property="og:description" content="Log in to your GyaanGhar account to access your personalized learning dashboard, classes, folders, and lectures. Continue your learning journey!" />
    <meta property="og:url" content="{{ url('/login') }}" />
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
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/login'); // Specific URL for the login page

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
            'name' => 'User Login - GyaanGhar',
            'description' => 'Log in to your GyaanGhar account to access your personalized learning dashboard, classes, folders, and lectures. Continue your learning journey!',
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            // 'breadcrumb' => [
            //     '@type' => 'BreadcrumbList',
            //     'itemListElement' => [
            //         ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
            //         ['@type' => 'ListItem', 'position' => 2, 'name' => 'Login']
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
            <!-- Optional: Link to Home -->
            <a href="javascript:history.back()" class="text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 transform group-hover:-translate-x-1 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </header>

    <main class="flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 min-h-screen">
        @if(session('message'))
            <div class="bg-{{ session('message_type', 'green') === 'success' ? 'green' : 'red' }}-50 border-l-4 border-{{ session('message_type', 'green') === 'success' ? 'green' : 'red' }}-400 text-{{ session('message_type', 'green') === 'success' ? 'green' : 'red' }}-700 p-4 mb-6 w-full max-w-md rounded-md shadow-md animate__animated animate__fadeInDown" role="alert">
                <p class="font-bold">{{ session('message_type', 'green') === 'success' ? 'Success' : 'Error' }}</p>
                <p>{{ session('message') }}</p>
            </div>
        @endif

        {{-- Display general validation errors from session if any (e.g., credentials mismatch) --}}
        @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 w-full max-w-md rounded-md shadow-md animate__animated animate__fadeInDown" role="alert">
                <p class="font-bold">Error</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif


        <div class="bg-white p-8 sm:p-10 rounded-xl shadow-2xl w-full max-w-md animate__animated animate__fadeInUp">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Welcome Back!
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Sign in to continue with <span class="font-semibold text-indigo-600">GyaanGhar</span>.
                </p>
            </div>

            <form class="mt-8 space-y-6" action="/user-login" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email') }}"
                               class="form-input appearance-none block w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
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
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="form-input appearance-none block w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                     @error('password')
                        <p class="mt-2 text-xs text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <!--<a href="{{-- url('/forgot-password') --}}" class="font-medium text-indigo-600 hover:text-indigo-500 underline">-->
                        <!--    Forgot your password?-->
                        <!--</a>-->
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500 underline">
                        Create one
                    </a>
                </p>
            </div>
        </div>

        <p class="text-center text-gray-500 mt-10 text-xs">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </p>
    </main>

</body>
</html>