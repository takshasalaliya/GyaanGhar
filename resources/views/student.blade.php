<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Folder - GyaanGhar</title>

    <meta name="description" content="Enter your folder code to securely access shared educational materials, documents, and lectures on GyaanGhar." />
    <link rel="canonical" href="{{ url('/folder/access') }}" /> {{-- Assuming a route like /folder/access or similar --}}
    <meta property="og:title" content="Access Folder Content - GyaanGhar" />
    <meta property="og:description" content="Enter your folder code to securely access shared educational materials, documents, and lectures on GyaanGhar." />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg.png" />
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
            /* Disable right-click on the page */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .favicon {
            border-radius: 50px; /* Kept from original, though icon itself is already rounded */
        }
        /* Disable right-click on images and videos */
        img, video, audio {
            pointer-events: none;
        }
        /* Optional: To hide the download option in videos */
        video::-webkit-media-controls-enclosure {
            display: none !important;
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
        $pageFullUrl = url()->full(); // Or specific URL like url('/folder/access')

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
            'name' => 'Access Folder Content - GyaanGhar',
            'description' => 'Enter your folder code to securely access shared educational materials, documents, and lectures on GyaanGhar.',
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
        ];

        // If folder details are present, you might add more specific schema like `Dataset` or `CollectionPage`
        // For example, if $folder variable is passed with details:
        /*
        if (isset($folder) && $folder) {
            $webPageSchema['mainEntity'] = [
                '@type' => 'Dataset', // Or another appropriate type like CreativeWorkSeries for a collection of lectures
                'name' => $folder->name,
                'description' => $folder->description ?? 'Shared educational resources.',
                // Potentially list individual files as 'hasPart' if applicable and manageable
            ];
        }
        */

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
                <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="favicon h-10 mr-2">
                <span class="text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
            </a>
            <a href="/" class="text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150">
                Back to Home
            </a>
        </div>
    </header>

    <main class="flex flex-col items-center justify-start py-12 px-4 sm:px-6 lg:px-8 min-h-screen">

        <div class="w-full max-w-xl">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl animate__animated animate__fadeInUp">
                    Access Shared Content
                </h1>
                <p class="mt-3 text-xl text-gray-600 animate__animated animate__fadeInUp animate__delay-1s">
                    Enter the unique code provided to view folder details and files.
                </p>
            </div>

            <!-- Folder Code Form -->
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full animate__animated animate__fadeInUp animate__delay-2s">
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-md shadow animate__animated animate__shakeX" role="alert">
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                 @if (session('message'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-md shadow animate__animated animate__fadeIn" role="alert">
                        <p class="font-bold">Success</p>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif


                <form action="/folder/details" method="POST" id="folderCodeForm" class="space-y-6">
                    @csrf
                    <div>
                        <label for="folderCode" class="block text-sm font-medium text-gray-700 mb-1">Folder Code</label>
                        <input type="text" name="folderCode" id="folderCode" required
                               class="form-input appearance-none block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-base"
                               placeholder="Enter your unique folder code">
                         @error('folderCode')
                            <p class="mt-2 text-xs text-red-600 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            Get Folder Details
                        </button>
                    </div>
                </form>
            </div>

            <!-- Folder Details Section (Dynamically shown by server-side logic) -->
            {{-- Example: Assume $folder and $files are passed from controller if code is valid --}}
            @if(isset($folder) && $folder)
            <div id="folderDetails" class="mt-10 bg-white shadow-2xl rounded-xl p-8 w-full animate__animated animate__fadeInUp">
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ $folder->name ?? 'Folder Details' }}
                    </h2>
                    @if(isset($folder->description) && $folder->description)
                        <p class="mt-1 text-sm text-gray-600">{{ $folder->description }}</p>
                    @endif
                </div>

                <div id="folderInfo" class="space-y-3 text-gray-700 mb-6">
                    <p><span class="font-medium">Access Code:</span> {{ $folder->code ?? 'N/A' }}</p>
                    <p><span class="font-medium">Created By:</span> {{ $folder->teacher->name ?? 'N/A' }}</p>
                    <p><span class="font-medium">Class:</span> {{ $folder->class->name ?? 'N/A' }}</p>
                    {{-- Add more dynamic folder information as needed --}}
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-t border-gray-200 pt-6">Files in this Folder</h3>
                @if(isset($files) && count($files) > 0)
                    <ul id="filesList" class="space-y-3">
                        @foreach($files as $file)
                        <li class="flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-md border border-gray-200 transition-colors duration-150">
                            <div class="flex items-center">
                                {{-- Basic File Type Icon Logic (can be expanded) --}}
                                @php
                                    $extension = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                                    $iconClass = 'text-gray-500';
                                    $iconPath = 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'; // Default file icon
                                    if (in_array($extension, ['pdf'])) {
                                        $iconPath = 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z M9 10a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1v-2z'; // PDF icon
                                        $iconClass = 'text-red-500';
                                    } elseif (in_array($extension, ['doc', 'docx'])) {
                                        $iconPath = 'M4 4a2 2 0 012-2h4.586A1 1 0 0111.293 2.707L15.293 6.707a1 1 0 01.293.707V16a2 2 0 01-2 2h-1.586a1 1 0 00-.707.293l-2.414 2.414A1 1 0 018 21.414V18a2 2 0 00-2-2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2 6a1 1 0 00-1 1v2a1 1 0 102 0v-2a1 1 0 00-1-1zm6 0a1 1 0 00-1 1v2a1 1 0 102 0v-2a1 1 0 00-1-1z'; // DOC icon
                                        $iconClass = 'text-blue-500';
                                    } elseif (in_array($extension, ['mp3', 'wav', 'aac'])) {
                                        $iconPath = 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3'; // Audio icon
                                        $iconClass = 'text-purple-500';
                                    } elseif (in_array($extension, ['mp4', 'mov', 'avi'])) {
                                         $iconPath = 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'; // Video icon
                                         $iconClass = 'text-green-500';
                                    }
                                @endphp
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ $iconClass }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700">{{ $file->original_name ?? basename($file->file_path) }}</span>
                            </div>
                            {{-- The `pointer-events: none` on `audio/video` makes download links here tricky unless handled differently --}}
                            {{-- For other files, a download link might be appropriate if not for the general restrictions --}}
                             <a href="{{ Storage::url($file->file_path) }}" 
                               title="View/Download {{ $file->original_name ?? basename($file->file_path) }}"
                               class="text-indigo-600 hover:text-indigo-800 transition-colors duration-150 text-sm font-medium @if($file->is_media_type) opacity-50 cursor-not-allowed @else @endif"
                               @if($file->is_media_type) onclick="event.preventDefault(); alert('Direct download/viewing for media files might be restricted here.');" @else target="_blank" @endif>
                                View
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">No files found in this folder.</p>
                @endif
            </div>
            @endif
        </div>

         <p class="text-center text-gray-500 mt-12 text-xs">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </p>
    </main>

</body>
</html>