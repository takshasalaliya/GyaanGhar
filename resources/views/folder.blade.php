<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Subfolders - {{ $className ?? 'Class' }} | GyaanGhar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create and manage subfolders for your class '{{ $className ?? '' }}' on GyaanGhar.">
    {{-- This is an internal management page, usually not for public indexing --}}
    <meta name="robots" content="noindex, nofollow">

    <link rel="canonical" href="{{url()->full()}}" />
    <meta property="og:title" content="Manage Subfolders - {{ $className ?? 'Class' }} | GyaanGhar" />
    <meta property="og:description" content="Create and manage subfolders for your class '{{ $className ?? '' }}' on GyaanGhar." />
    <meta property="og:url" content="{{url()->full()}}" />
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
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
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url()->full();

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
        ];

        $breadcrumbItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Dashboard', 'item' => url('/dashboard')], // Link to teacher dashboard
        ];
        if (isset($className)) {
            // Assuming $folderId is the ID of the main class folder.
            // The link to the class's main folder view might be different, adjust if necessary.
            // For breadcrumb, we link to a conceptual "class page" or the main folder view.
            $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $className, 'item' => url('/folder/' . $folderId . '/' . $accessCode)]; // Link to the parent folder view
        }
         $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => count($breadcrumbItems) + 1, 'name' => 'Manage Subfolders'];


        $manageSubfoldersPageSchema = [
            '@type' => 'WebPage',
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => "Manage Subfolders - " . ($className ?? 'Class') . " | GyaanGhar",
            'description' => "Create and manage subfolders for the class '" . ($className ?? '') . "'.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumbItems
            ],
            'accessibilitySummary' => 'This page is for authenticated teachers to manage subfolders within a class.',
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $manageSubfoldersPageSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center flex-shrink-0">
                        <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-9 sm:h-10 mr-2">
                        <span class="text-xl sm:text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="/dashboard" class="text-sm font-medium text-gray-600 hover:text-blue-700 px-3 py-2 rounded-md transition-colors">Dashboard</a>
                    <form action="/logout" method="POST" class="ml-2 sm:ml-4">
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
    </header>

    <main class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 w-full">

        <div class="mb-6 flex justify-between items-center">
            <div>
                {{-- Breadcrumbs or a more direct back link --}}
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors group">
                    <ph-arrow-left size="18" weight="bold" class="mr-1 transform group-hover:-translate-x-0.5 transition-transform"></ph-arrow-left>
                    Back to Dashboard
                </a>
            </div>
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

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900">{{ $className ?? 'Manage Content' }}</h1>
            @if(isset($accessCode))
            <p class="text-gray-600 text-lg mt-2">Main Folder Access Code: <strong class="font-mono text-gray-700">{{ $accessCode }}</strong></p>
            @endif
        </div>

        <!-- Create Subfolder Form -->
        <div class="bg-white shadow-xl rounded-xl p-6 sm:p-8 mb-8 md:mb-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-1 flex items-center">
                <ph-folder-plus size="28" weight="duotone" class="text-green-600 mr-2"></ph-folder-plus>
                Create New Subfolder
            </h2>
            <p class="text-sm text-gray-500 mb-6">Organize your class materials by creating subfolders.</p>
            <form action="{{ url('subfolders/create') }}" method="POST" class="flex flex-col sm:flex-row items-end gap-3 sm:gap-4">
                @csrf
                <div class="w-full sm:flex-grow">
                    <label for="subfolder-name" class="sr-only">New Subfolder Name</label>
                    <input id="subfolder-name" type="text" name="name" placeholder="Enter new subfolder name"
                           class="form-input w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" required>
                </div>
                <input type="hidden" name="parent_id" value="{{ $folderId }}">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors text-sm">
                    <ph-plus size="18" weight="bold" class="mr-1.5"></ph-plus>
                    Create Subfolder
                </button>
            </form>
        </div>

        <!-- Subfolder List -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-1 flex items-center">
                <ph-tree-structure size="28" weight="duotone" class="text-blue-600 mr-2"></ph-tree-structure>
                Existing Subfolders
            </h2>
            <p class="text-sm text-gray-500 mb-6">View, open, or delete your existing subfolders.</p>

            @if(isset($subfolders) && count($subfolders) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6" id="folder-list">
                    @foreach($subfolders as $folder)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-4 flex flex-col justify-between space-y-3" id="folder-{{ $folder['id'] }}">
                            <div class="flex items-start space-x-3 flex-grow">
                                <ph-folder-simple size="24" weight="duotone" class="text-yellow-500 flex-shrink-0 mt-0.5"></ph-folder-simple>
                                <a href="{{ url('/subfolder/'.$folderId.'/'.$folder['id']) }}" class="text-gray-800 font-medium text-base break-words line-clamp-2 hover:text-indigo-600 hover:underline" title="Open {{ $folder['name'] }}">
                                    {{ $folder['name'] }}
                                </a>
                            </div>
                             
                            <div class="flex justify-between items-center pt-2 border-t border-gray-200 mt-auto">
                                 <a href="{{ url('/subfolder/'.$folderId.'/'.$folder['id']) }}"
                                   class="inline-flex items-center bg-indigo-500 text-white text-xs font-semibold px-3 py-1.5 rounded-md hover:bg-indigo-600 transition duration-150">
                                    <ph-arrow-square-out size="16" weight="bold" class="mr-1"></ph-arrow-square-out>
                                    Open
                                </a>
                                <form action="{{ url('subfolders/delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subfolder and all its contents? This action cannot be undone.');">
                                    @csrf
                                    <input type="hidden" name="folderId" value="{{ $folder['id'] }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-100 transition-colors" title="Delete Subfolder">
                                        <ph-trash size="20" weight="bold">Delete</ph-trash>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500 bg-white rounded-xl shadow-md">
                    <ph-folder-notch-open size="48" class="mx-auto mb-3 text-gray-400"></ph-folder-notch-open>
                    <p class="font-medium">No subfolders found in this class folder yet.</p>
                    <p class="text-sm">Use the form above to create your first subfolder.</p>
                </div>
            @endif
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

</body>
</html>