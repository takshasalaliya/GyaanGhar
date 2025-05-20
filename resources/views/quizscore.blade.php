<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Results - {{ $subfolderName ?? 'Subfolder' }} | GyaanGhar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View quiz scores and results for students in the subfolder '{{ $subfolderName ?? '' }}' on GyaanGhar.">
    {{-- This page displays specific user data, not for public indexing --}}
    <meta name="robots" content="noindex, nofollow">

    <link rel="canonical" href="{{url()->full()}}" />
    <meta property="og:title" content="Quiz Results - {{ $subfolderName ?? 'Subfolder' }} | GyaanGhar" />
    <meta property="og:description" content="View quiz scores for '{{ $subfolderName ?? '' }}'." />
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
        [class^="ph-"] {
            vertical-align: middle;
        }
        /* Styling for table for better readability */
        th, td {
            white-space: nowrap; /* Prevent text wrapping in cells initially */
        }
        td.wrap-text { /* Apply this class to cells where text wrapping is desired */
            white-space: normal;
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url()->full();
        // Assuming $className, $subfolderName, $parentFolderId (fidclass), and $folderId (current subfolder) are passed
        $currentSubfolderName = $subfolderName ?? 'Subfolder';
        $parentClassName = $className ?? 'Class';
        $parentFolderIdForBreadcrumb = $fidclass ?? null; // ID of the folder containing this subfolder
        $currentFolderIdForBreadcrumb = $folderId ?? null; // ID of the current subfolder (where the quiz is)

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
        ];

        $breadcrumbItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Dashboard', 'item' => url('/dashboard')],
        ];
        if (isset($parentClassName) && $parentFolderIdForBreadcrumb) {
            $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $parentClassName, 'item' => url('/folder/' . $parentFolderIdForBreadcrumb)]; // Link to main class folder
             if (isset($currentSubfolderName) && $currentFolderIdForBreadcrumb) {
                // Link to the subfolder content management page
                $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 4, 'name' => $currentSubfolderName, 'item' => url('/subfolder/' . $parentFolderIdForBreadcrumb . '/' . $currentFolderIdForBreadcrumb)];
            }
        }
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => count($breadcrumbItems) + 1, 'name' => 'Quiz Results'];


        $quizResultsPageSchema = [
            '@type' => 'WebPage',
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => "Quiz Results - {$currentSubfolderName} | {$parentClassName} | GyaanGhar",
            'description' => "View quiz scores for students in the subfolder '{$currentSubfolderName}'.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
             'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumbItems
            ],
            'accessibilitySummary' => 'This page displays quiz results and is intended for authenticated teachers.',
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [$organizationSchema, $quizResultsPageSchema]
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
        </header>

    <main class="py-8 px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-5xl mx-auto">
            <div class="mb-6">
                <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors group">
                    <ph-arrow-left size="18" weight="bold" class="mr-1 transform group-hover:-translate-x-0.5 transition-transform"></ph-arrow-left>
                    Back
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-2xl p-6 sm:p-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-2 text-center flex items-center justify-center">
                    <ph-exam size="36" weight="duotone" class="text-indigo-600 mr-3"></ph-exam>
                    Quiz Results
                </h1>

                @if(isset($users) && count($users) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                            <thead class="bg-gray-50 text-xs sm:text-sm uppercase">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-600 tracking-wider">Roll Number</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-600 tracking-wider">Name</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-600 tracking-wider">Score / Result</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-600 tracking-wider">IP Address</th>
                                   
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white text-sm">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-4 py-3 font-mono text-indigo-700">{{ $user['roll'] ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-gray-800 font-medium wrap-text">{{ $user['name'] ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="font-bold 
                                                @if(isset($user['result']) && is_numeric(explode('/', $user['result'])[0]) && (explode('/', $user['result'])[0] / explode('/', $user['result'])[1] >= 0.4)) 
                                                    text-green-600 
                                                @else 
                                                    text-red-600 
                                                @endif">
                                                {{ $user['result'] ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-500 font-mono">{{ $user['ip'] ?? 'N/A' }}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                @else
                    <div class="text-center py-12 text-gray-500">
                        <ph-list-magnifying-glass size="48" class="mx-auto mb-3 text-gray-400"></ph-list-magnifying-glass>
                        <p class="font-medium">No quiz records found for this subfolder.</p>
                        <p class="text-sm">Students may not have attempted the quiz yet.</p>
                    </div>
                @endif
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

</body>
</html>