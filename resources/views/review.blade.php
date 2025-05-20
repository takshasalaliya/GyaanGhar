<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Leave a Review - GyaanGhar</title>
    <meta name="description" content="Share your experience with GyaanGhar. Your feedback helps us improve our personalized learning platform." />

    <link rel="canonical" href="{{ url('/review') }}" /> {{-- Assuming this page is at /review --}}
    <meta property="og:title" content="Leave a Review - GyaanGhar" />
    <meta property="og:description" content="Share your experience with GyaanGhar. Your feedback helps us improve our personalized learning platform." />
    <meta property="og:url" content="{{ url('/review') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg.png" />
    <link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
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
        /* Custom star rating */
        .star-rating input[type="radio"] { display: none; }
        .star-rating label {
            font-size: 2.5rem; /* Increased size slightly */
            color: #cbd5e1; /* Tailwind gray-300 */
            cursor: pointer;
            transition: color 0.2s ease-in-out;
            padding: 0 0.2rem; /* Add some padding between stars */
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b; /* Tailwind amber-500 */
        }
        /* Custom focus styles for inputs */
        .form-input:focus,
        .form-textarea:focus {
            border-color: #4f46e5; /* Tailwind indigo-600 */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.3); /* Tailwind indigo-600 with opacity */
        }
        .form-radio:checked {
            background-color: #4f46e5; /* Tailwind indigo-600 */
            border-color: #4f46e5;
        }
        .form-radio:focus {
            ring-color: #4f46e5;
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/review'); // Specific URL for the review page

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
            'name' => 'Leave a Review - GyaanGhar',
            'description' => 'Share your experience with GyaanGhar. Your feedback helps us improve our personalized learning platform.',
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
        ];

        // This page is primarily for submitting a review, not displaying them.
        // However, it describes the *action* of reviewing the Organization.
        $reviewActionSchema = [
            '@type' => 'ReviewAction',
            'agent' => [
                '@type' => 'Person',
                'name' => 'User' // Generic user, as name is filled in form
            ],
            'object' => ['@id' => $siteBaseUrl . '#organization'], // The review is about the Organization
            'actionStatus' => 'PotentialActionStatus', // This is a form for a potential action
            'target' => [ // Describes where the form submits
                '@type' => 'EntryPoint',
                'urlTemplate' => url('/submitreview'), // Your form action URL
                'httpMethod' => 'POST',
                'encodingType' => 'application/x-www-form-urlencoded',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'resultComment' => 'A user review of GyaanGhar.'
        ];


        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $webPageSchema,
                $reviewActionSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-100 text-gray-800 antialiased">

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

    <main class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="w-full max-w-lg mb-6 bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-md shadow-md" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="w-full max-w-lg mb-6 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-md shadow-md" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <form action="/submitreview" method="POST"
              class="w-full max-w-xl bg-white rounded-xl shadow-2xl p-8 sm:p-10 space-y-6">
            @csrf
            <div class="text-center">
                <ph-chats-teardrop size="56" weight="duotone" class="text-indigo-600 mx-auto mb-3"></ph-chats-teardrop>
                <h1 class="text-3xl font-extrabold text-gray-900">Share Your Feedback</h1>
                <p class="mt-2 text-gray-600">Help us make GyaanGhar even better!</p>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                       placeholder="e.g., Jane Doe"
                       class="form-input w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" />
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                       placeholder="you@example.com"
                       class="form-input w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" />
                @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Role -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-2">I am a...</span>
                <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-2 sm:space-y-0">
                    <label class="inline-flex items-center p-3 border border-gray-300 rounded-lg hover:bg-indigo-50 cursor-pointer has-[:checked]:bg-indigo-100 has-[:checked]:border-indigo-500 transition-all">
                        <input type="radio" name="role" value="teacher" required {{ old('role') == 'teacher' ? 'checked' : '' }}
                               class="form-radio h-4 w-4 text-indigo-600 border-gray-400 focus:ring-indigo-500" />
                        <span class="ml-3 text-gray-700 font-medium">Teacher</span>
                    </label>
                    <label class="inline-flex items-center p-3 border border-gray-300 rounded-lg hover:bg-indigo-50 cursor-pointer has-[:checked]:bg-indigo-100 has-[:checked]:border-indigo-500 transition-all">
                        <input type="radio" name="role" value="student" {{ old('role') == 'student' ? 'checked' : '' }}
                               class="form-radio h-4 w-4 text-indigo-600 border-gray-400 focus:ring-indigo-500" />
                        <span class="ml-3 text-gray-700 font-medium">Student</span>
                    </label>
                </div>
                @error('role') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Rating -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-2">How would you rate us?</span>
                <div class="star-rating flex flex-row-reverse justify-center items-center py-2 bg-gray-50 rounded-lg border border-gray-300">
                    <input type="radio" id="star5" name="star" value="5" {{ old('star') == '5' ? 'checked' : '' }} /><label for="star5" title="5 stars">★</label>
                    <input type="radio" id="star4" name="star" value="4" {{ old('star') == '4' ? 'checked' : '' }} /><label for="star4" title="4 stars">★</label>
                    <input type="radio" id="star3" name="star" value="3" {{ old('star') == '3' ? 'checked' : '' }} /><label for="star3" title="3 stars">★</label>
                    <input type="radio" id="star2" name="star" value="2" {{ old('star') == '2' ? 'checked' : '' }} /><label for="star2" title="2 stars">★</label>
                    <input type="radio" id="star1" name="star" value="1" {{ old('star', '0') == '1' ? 'checked' : (old('star') ? '' : 'checked') }} /><label for="star1" title="1 star">★</label>
                </div>
                 @error('star') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Review</label>
                <textarea id="message" name="message" rows="5" required
                          class="form-textarea w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                          placeholder="Tell us about your experience...">{{ old('message') }}</textarea>
                @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <div class="pt-2">
                <button type="submit"
                        class="w-full inline-flex justify-center items-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <ph-paper-plane-tilt size="20" weight="bold" class="mr-2"></ph-paper-plane-tilt>
                    Submit Review
                </button>
            </div>
        </form>
         <p class="text-center text-gray-500 mt-10 text-xs">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </p>
    </main>

</body>
</html>