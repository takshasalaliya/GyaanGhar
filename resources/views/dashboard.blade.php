<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - GyaanGhar</title>
    <meta name="description" content="Manage your classes, create new educational content, and oversee your student interactions on the GyaanGhar Teacher Dashboard.">
    {{-- Dashboards are usually not meant for public indexing, so noindex might be appropriate --}}
    <meta name="robots" content="noindex, nofollow">

    {{-- Canonical might not be strictly necessary for an authenticated dashboard page unless there are variations --}}
    <link rel="canonical" href="{{ url('/dashboard') }}" /> {{-- Assuming '/dashboard' is the route --}}
    <meta property="og:title" content="Teacher Dashboard - GyaanGhar" />
    <meta property="og:description" content="Manage your classes and educational content on GyaanGhar." />
    <meta property="og:url" content="{{ url('/dashboard') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg.png" />
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
        .form-input:focus {
            border-color: #4f46e5; /* Tailwind indigo-600 */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.3);
        }
        /* Ensure Phosphor icons align well */
        [class^="ph-"] {
            vertical-align: middle;
        }
        /* Custom scrollbar for class list if it overflows */
        .classes-list-container::-webkit-scrollbar {
            width: 8px;
        }
        .classes-list-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .classes-list-container::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* gray-300 */
            border-radius: 10px;
        }
        .classes-list-container::-webkit-scrollbar-thumb:hover {
            background: #9ca3af; /* gray-400 */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/dashboard'); // Assuming this is the dashboard URL

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
        ];

        // Schema for a dashboard is typically just WebPage as its content is user-specific
        $dashboardPageSchema = [
            '@type' => 'WebPage',
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => 'Teacher Dashboard - GyaanGhar',
            'description' => "Manage your classes, create new educational content, and oversee your student interactions on the GyaanGhar Teacher Dashboard.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            // Dashboards usually require login, so indicating this can be useful
            'accessibilitySummary' => 'This page requires user authentication and provides tools for teachers to manage their educational content.',
            // No breadcrumb as it's a top-level authenticated page
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $dashboardPageSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center flex-shrink-0">
                            <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-9 sm:h-10 mr-2">
                            <span class="text-xl sm:text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        {{-- User Info - Placeholder. Replace with actual user data --}}
                        <span class="text-sm text-gray-600 mr-4 hidden sm:inline">Welcome, {{ auth()->user()->name ?? 'Teacher' }}!</span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <ph-sign-out size="18" weight="bold" class="mr-1 sm:mr-2"></ph-sign-out>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow py-8 sm:py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 sm:px-0 mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Teacher Dashboard</h1>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md shadow-md" role="alert">
                        <div class="flex">
                            <div class="py-1"><ph-check-circle size="24" weight="fill" class="text-green-500 mr-3"></ph-check-circle></div>
                            <div><p>{{ session('success') }}</p></div>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 p-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md shadow-md" role="alert">
                         <div class="flex">
                            <div class="py-1"><ph-x-circle size="24" weight="fill" class="text-red-500 mr-3"></ph-x-circle></div>
                            <div><p>{{ session('error') }}</p></div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 p-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md shadow-md" role="alert">
                        <div class="flex">
                             <div class="py-1"><ph-x-circle size="24" weight="fill" class="text-red-500 mr-3"></ph-x-circle></div>
                            <div>
                                <p class="font-bold">Please correct the following errors:</p>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Create Class Form Column -->
                    <div class="lg:col-span-1">
                        <div class="bg-white shadow-xl rounded-xl p-6 sm:p-8">
                            <h2 class="text-xl font-semibold text-gray-800 mb-1 flex items-center">
                                <ph-chalkboard-teacher size="28" weight="duotone" class="text-indigo-600 mr-2"></ph-chalkboard-teacher>
                                Create New Class
                            </h2>
                            <p class="text-sm text-gray-500 mb-6">Set up a new virtual classroom for your students.</p>
                            <form action="/classes" method="POST" id="createClassForm">
                                @csrf
                                <div class="space-y-5">
                                    <div>
                                        <label for="className" class="block text-sm font-medium text-gray-700 mb-1">Class Name</label>
                                        <input type="text" name="className" id="className" required value="{{ old('className') }}"
                                               class="form-input w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                               placeholder="e.g., Grade 10 - Physics">
                                    </div>
                                    <div>
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                            <ph-plus-circle size="20" weight="bold" class="mr-2"></ph-plus-circle>
                                            Create Class
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Classes List Column -->
                    <div class="lg:col-span-2">
                        <div class="bg-white shadow-xl rounded-xl p-6 sm:p-8">
                            <h2 class="text-xl font-semibold text-gray-800 mb-1 flex items-center">
                                <ph-folders size="28" weight="duotone" class="text-blue-600 mr-2"></ph-folders>
                                Your Classes
                            </h2>
                            <p class="text-sm text-gray-500 mb-6">Access and manage your existing classes here.</p>

                            @if(isset($classes) && count($classes) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6 classes-list-container max-h-[70vh] overflow-y-auto pr-2">
                                    @foreach($classes as $id => $class)
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-200 flex flex-col justify-between space-y-3">
                                            <div class="flex items-start space-x-3">
                                                <ph-folder-simple-user size="24" weight="duotone" class="text-yellow-500 flex-shrink-0 mt-0.5"></ph-folder-simple-user>
                                                <span class="text-gray-800 font-medium text-base break-words line-clamp-2" title="{{ $class['name'] }}">{{ $class['name'] }}</span>
                                            </div>
                                            <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                                <a href="{{ '/folder/' . $class['folderId'] }}" {{-- Make sure accessCode is available --}}
                                                   class="inline-flex items-center bg-indigo-500 text-white text-xs font-semibold px-3 py-1.5 rounded-md hover:bg-indigo-600 transition duration-150">
                                                    <ph-arrow-square-out size="16" weight="bold" class="mr-1"></ph-arrow-square-out>
                                                    Open
                                                </a>

                                                <form action="/classes/{{ $id }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this class? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-100 transition-colors" title="Delete Class">
                                                        <ph-trash size="20" weight="bold">Delete</ph-trash>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <ph-chalkboard size="48" class="mx-auto mb-3 text-gray-400"></ph-chalkboard>
                                    <p class="font-medium">No classes created yet.</p>
                                    <p class="text-sm">Use the form on the left to create your first class!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white w-full mt-auto">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-sm">
                © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
                 <span class="mx-1">|</span>
                <a href="/privacy-policy" class="hover:underline">Privacy Policy</a>
                <span class="mx-1">|</span>
                <a href="/terms-and-conditions" class="hover:underline">Terms & Conditions</a>
            </div>
        </footer>
    </div>

    <!-- Firebase SDK - REPLACE 9.x.x with specific versions -->
    <script src="https://www.gstatic.com/firebasejs/9.22.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.1/firebase-database-compat.js"></script>
    {{--
    <script>
        // IMPORTANT: Firebase initialization code goes here
        // This should be configured with your Firebase project settings
        const firebaseConfig = {
            apiKey: "YOUR_API_KEY",
            authDomain: "YOUR_AUTH_DOMAIN",
            databaseURL: "YOUR_DATABASE_URL", // Crucial for Realtime Database
            projectId: "YOUR_PROJECT_ID",
            storageBucket: "YOUR_STORAGE_BUCKET",
            messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
            appId: "YOUR_APP_ID"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const database = firebase.database(); // Get a reference to the Realtime Database service

        // Example: Further JavaScript for dashboard interactions
        // document.getElementById('createClassForm').addEventListener('submit', function(event) {
        //     // Potentially add client-side validation or optimistic UI updates here
        // });

    </script>
    --}}
</body>
</html>