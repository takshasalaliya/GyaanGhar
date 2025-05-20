<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Content - {{ $subfolderName ?? 'Subfolder' }} | {{ $className ?? 'Class' }} | GyaanGhar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manage resources, audio files, and quizzes for the subfolder '{{ $subfolderName ?? '' }}' in class '{{ $className ?? '' }}' on GyaanGhar.">
    {{-- This is an internal management page --}}
    <meta name="robots" content="noindex, nofollow">

    <link rel="canonical" href="{{url()->full()}}" />
    <meta property="og:title" content="Manage Content - {{ $subfolderName ?? 'Subfolder' }} | GyaanGhar" />
    <meta property="og:description" content="Manage resources, audio files, and quizzes for '{{ $subfolderName ?? '' }}'." />
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
        .form-input:focus, .form-file-input:focus-within {
            border-color: #4f46e5; /* Tailwind indigo-600 */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.3);
        }
        .form-file-input input[type="file"] {
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
            position: absolute;
            overflow: hidden;
            z-index: -1;
        }
        .form-file-input-label {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            padding: 0.625rem 1rem; /* py-2.5 px-4 */
            border-radius: 0.375rem; /* rounded-md */
            background-color: #edf2f7; /* bg-gray-200 */
            color: #4a5568; /* text-gray-700 */
            border: 1px solid #e2e8f0; /* border-gray-300 */
            transition: background-color 0.2s;
        }
        .form-file-input-label:hover {
            background-color: #e2e8f0; /* bg-gray-300 */
        }
        /* Ensure Phosphor icons align well */
        [class^="ph-"] {
            vertical-align: middle;
        }
        /* Error styling for file inputs if needed */
        .alert-inline {
            font-size: 0.875rem; /* text-sm */
            color: #c53030; /* text-red-700 */
            margin-top: 0.25rem; /* mt-1 */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url()->full();
        // Assuming $subfolderName is passed from controller, or derive from $className if it's the subfolder name
        $currentSubfolderName = $subfolderName ?? (isset($folder) && $folder->name ? $folder->name : 'Subfolder');
        $parentClassName = $className ?? 'Class'; // Name of the main class folder

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
        // Assuming $fidclass is the ID of the main class folder for breadcrumb linking
        if (isset($parentClassName) && isset($fidclass)) {
            $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $parentClassName, 'item' => url('/folder/' . $fidclass)];
        }
         $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => count($breadcrumbItems) + 1, 'name' => $currentSubfolderName];


        $manageContentPageSchema = [
            '@type' => 'WebPage',
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => "Manage Content - {$currentSubfolderName} | {$parentClassName} | GyaanGhar",
            'description' => "Upload and manage resources, audio, and quizzes for the subfolder '{$currentSubfolderName}' in class '{$parentClassName}'.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumbItems
            ],
            'accessibilitySummary' => 'This page is for authenticated teachers to manage content within a specific subfolder.',
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $manageContentPageSchema
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
        </header>

    <main class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 w-full">
        <div class="mb-6">
            <a href="{{'/folder/'.$fidclass}}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors group">
                <ph-arrow-left size="18" weight="bold" class="mr-1 transform group-hover:-translate-x-0.5 transition-transform"></ph-arrow-left>
                Back to Parent Folder
            </a>
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
        {{-- For Laravel validation errors --}}
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
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 flex items-center justify-center">
                <ph-folder-open size="36" weight="duotone" class="text-indigo-600 mr-3"></ph-folder-open>
                {{ $subfolderName ?? (isset($folder) && $folder->name ? $folder->name : 'Subfolder Content') }}
            </h1>
            <p class="text-gray-600 text-md mt-2">Class: {{ $className ?? 'N/A' }}</p>
        </div>

        <!-- Upload Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-10">
            <!-- Resource Upload -->
            <form action="{{ url('upload/resource') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg space-y-4">
                @csrf
                <input type="hidden" name="folder_id" value="{{ $folderId }}">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <ph-file-text size="24" weight="duotone" class="text-blue-600 mr-2"></ph-file-text> Upload Resource
                </h3>
                <div class="form-file-input border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500">
                    <input type="file" name="file" id="resourceFile" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt" required class="form-file-input-target">
                    <label for="resourceFile" class="form-file-input-label w-full justify-center">
                        <ph-upload-simple size="20" class="mr-2"></ph-upload-simple>
                        <span id="resourceFileName">Choose Document</span>
                    </label>
                </div>
                 @error('file', 'resourceUpload') <div class="alert-inline">{{ $message }}</div> @enderror
                <button type="submit" class="w-full inline-flex items-center justify-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <ph-arrow-fat-line-up size="20" weight="bold" class="mr-2"></ph-arrow-fat-line-up>Upload Document
                </button>
            </form>

            <!-- Audio Upload -->
            <form id="audioUploadForm" action="{{ url('upload/audio') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg space-y-4">
                @csrf
                <input type="hidden" name="folder_id" value="{{ $folderId }}">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <ph-speaker-high size="24" weight="duotone" class="text-green-600 mr-2"></ph-speaker-high> Upload Audio
                </h3>
                <div class="form-file-input border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500">
                    <input type="file" name="file" id="audioFile" accept="audio/*" required class="form-file-input-target">
                     <label for="audioFile" class="form-file-input-label w-full justify-center">
                        <ph-upload-simple size="20" class="mr-2"></ph-upload-simple>
                        <span id="audioFileName">Choose Audio (Max 30MB)</span>
                    </label>
                </div>
                @error('file', 'audioUpload') <div class="alert-inline">{{ $message }}</div> @enderror
                <button id="uploadBtn" type="submit" class="w-full inline-flex items-center justify-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                    <ph-arrow-fat-line-up size="20" weight="bold" class="mr-2"></ph-arrow-fat-line-up>Upload Audio
                </button>
            </form>

            <!-- Quiz Section -->
            <div class="bg-white p-6 rounded-xl shadow-lg space-y-4 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <ph-question size="24" weight="duotone" class="text-yellow-500 mr-2"></ph-question> Manage Quiz
                    </h3>
                    <p class="text-sm text-gray-500 mt-1 mb-3">Create or view quiz questions for this subfolder.</p>
                </div>
                <div class="space-y-3">
                    <button type="button" onclick="document.getElementById('quizModal').classList.remove('hidden', 'opacity-0'); document.body.style.overflow = 'hidden';"
                            class="w-full inline-flex items-center justify-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                        <ph-note-pencil size="20" weight="bold" class="mr-2"></ph-note-pencil>Create/Edit Quiz
                    </button>
                    <a href="/score/{{$folderId}}" class="w-full block text-center py-2.5 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <ph-bar-chart size="20" weight="bold" class="inline mr-2"></ph-bar-chart>View Scores
                    </a>
                </div>
            </div>
        </div>

        <!-- Audio Upload Progress Modal -->
        <div id="progressContainer" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 hidden z-[70] transition-opacity duration-300 opacity-0">
            <div class="bg-white p-8 rounded-lg shadow-xl text-center">
                <svg id="progressCircle" width="120" height="120" viewBox="0 0 120 120" class="mx-auto">
                    <circle cx="60" cy="60" r="54" stroke="#e5e7eb" stroke-width="10" fill="none"/>
                    <circle id="progressBar" cx="60" cy="60" r="54" stroke="#22c55e" stroke-width="10" fill="none"
                            stroke-linecap="round" stroke-dasharray="339.292" stroke-dashoffset="339.292"
                            transform="rotate(-90 60 60)"/>
                    <text id="progressText" x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" class="text-2xl font-semibold fill-current text-green-600">0%</text>
                </svg>
                <p class="mt-4 text-gray-700 font-medium">Uploading Audio...</p>
            </div>
        </div>


        <!-- Files Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                <ph-files size="32" weight="duotone" class="text-gray-700 mr-2"></ph-files> Uploaded Files
            </h2>
            @if(isset($files) && count($files) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach ($files as $file)
                        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 flex flex-col justify-between h-full">
                            <div class="mb-3 flex-grow">
                                <div class="flex items-start space-x-2">
                                    @if($file['name']=='Resource')
                                        <ph-folder-simple size="22" weight="duotone" class="text-yellow-500 mt-0.5 flex-shrink-0"></ph-folder-simple>
                                        <a href="/resource/{{$file['id']}}" class="text-gray-800 font-medium break-words line-clamp-2 hover:text-indigo-600 hover:underline">
                                            {{ $file['original_name'] ?? $file['name'] }}
                                        </a>
                                    @else
                                        <ph-file size="22" weight="duotone" class="text-gray-500 mt-0.5 flex-shrink-0"></ph-file>
                                        <span class="text-gray-800 font-medium break-words line-clamp-2" title="{{ $file['original_name'] ?? $file['name'] }}">
                                            {{ $file['original_name'] ?? $file['name'] }}
                                        </span>
                                    @endif
                                </div>
                                 <p class="text-xs text-gray-400 mt-1">Type: {{ $file['type'] ?? 'Unknown' }}</p>
                            </div>
                            <div class="flex justify-end items-center text-sm text-gray-500 mt-auto pt-2 border-t border-gray-200">
                                <form action="{{ url('file/delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                    @csrf
                                    <input type="hidden" name="file_id" value="{{ $file['id'] }}">
                                    <input type="hidden" name="folder_id" value="{{ $folderId }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-100 transition-colors" title="Delete File">
                                        <ph-trash size="20" weight="bold">Delete</ph-trash>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500 bg-white rounded-xl shadow-md">
                    <ph-file-magnifying-glass size="48" class="mx-auto mb-3 text-gray-400"></ph-file-magnifying-glass>
                    <p class="font-medium">No files have been uploaded to this subfolder yet.</p>
                </div>
            @endif
        </div>

        <!-- Quiz Questions Section -->
        @if(isset($questions) && count($questions) > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <ph-list-checks size="32" weight="duotone" class="text-gray-700 mr-2"></ph-list-checks> Current Quiz Questions
        </h2>
        <div class="space-y-6">
            @foreach ($questions as $index => $q)
                <div class="bg-white p-5 rounded-lg shadow-md">
                    <p class="font-semibold text-gray-800 mb-3">{{ $index + 1 }}. {{ $q['question'] }}</p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 text-sm text-gray-700">
                        <li class="{{ $q['answer'] == 'a' ? 'font-bold text-green-600' : '' }}"><strong>A.</strong> {{ $q['a'] }}</li>
                        <li class="{{ $q['answer'] == 'b' ? 'font-bold text-green-600' : '' }}"><strong>B.</strong> {{ $q['b'] }}</li>
                        <li class="{{ $q['answer'] == 'c' ? 'font-bold text-green-600' : '' }}"><strong>C.</strong> {{ $q['c'] }}</li>
                        <li class="{{ $q['answer'] == 'd' ? 'font-bold text-green-600' : '' }}"><strong>D.</strong> {{ $q['d'] }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="mt-12 text-center py-8 text-gray-500 bg-white rounded-xl shadow-md">
         <ph-question size="48" class="mx-auto mb-3 text-gray-400"></ph-question>
         <p class="font-medium">No quiz has been created for this subfolder yet.</p>
         <p class="text-sm">Click "Create/Edit Quiz" above to add questions.</p>
    </div>
@endif
</main>

<!-- Main Quiz Modal -->
<div id="quizModal" class="fixed inset-0 z-[60] bg-black bg-opacity-70 overflow-y-auto hidden transition-opacity duration-300 opacity-0">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-xl w-full max-w-3xl p-6 sm:p-8 relative shadow-2xl max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <ph-note-pencil size="28" weight="duotone" class="text-yellow-500 mr-2"></ph-note-pencil> Create/Edit Quiz
                </h2>
                <!-- New Buttons -->
                <div class="flex space-x-2">
                    <button onclick="openAiTextModal()" class="px-3 py-1 bg-yellow-500 text-white rounded-md text-sm hover:bg-yellow-600 transition">Add Text</button>
                    <button onclick="removeLastQuestion()" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm hover:bg-red-600 transition">Remove Question</button>
                    <button onclick="closeQuizModal()" aria-label="Close quiz modal" class="text-gray-500 hover:text-red-600 p-1 rounded-full hover:bg-gray-100 transition-colors">
                        <ph-x size="24" weight="bold">❌</ph-x>
                    </button>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-4">Create between 5 to 15 multiple-choice questions for your quiz.</p>
            <form action="/upload/quiz/manual" method="POST" id="quizForm" class="flex-grow overflow-y-auto pr-2 space-y-3">
                @csrf
                <input type="hidden" name="folder_id" value="{{ $folderId }}">
                <div id="mcqContainer" class="space-y-5"></div>
            </form>
            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 pt-4 border-t border-gray-200 space-y-3 sm:space-y-0">
                <button type="button" onclick="addQuestion()" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-600 transition-colors">
                    <ph-plus-circle size="20" weight="bold" class="mr-2"></ph-plus-circle>Add Question
                </button>
                <button type="submit" form="quizForm" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 bg-green-600 text-white rounded-md font-semibold text-sm hover:bg-green-700 transition-colors">
                    <ph-check-circle size="20" weight="bold" class="mr-2"></ph-check-circle>Submit Quiz
                </button>
            </div>
        </div>
    </div>
</div>


<!-- AI Text Modal -->
<div id="aiTextModal" class="fixed inset-0 z-[62] bg-black bg-opacity-70 overflow-y-auto hidden transition-opacity duration-300 opacity-0">
  <div class="flex items-center justify-center min-h-screen px-4 py-8">
    <div class="bg-white rounded-xl w-full max-w-lg p-6 relative shadow-2xl">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Enter AI Prompt Text</h3>
        <button onclick="closeAiTextModal()" class="text-gray-500 hover:text-red-600 p-1 rounded-full">
          ❌
        </button>
      </div>

      <!-- Instruction Block -->
      <div class="text-sm text-gray-700 mb-3 bg-yellow-100 border border-yellow-300 p-3 rounded-md">
        <strong>Instruction:</strong> The AI should return JSON in the following format:
        <pre class="bg-white border rounded p-2 mt-2 overflow-auto text-xs">
[
  {
    "question_text": "What is the output of 2 + 2?",
    "options": ["3", "4", "5", "6"],
    "correct_answer": "4"
  },
  {
    "question_text": "Which keyword is used to extend a class in Java?",
    "options": ["implements", "extends", "inherits", "include"],
    "correct_answer": "extends"
  }
]
        </pre>
        Sample Prompt:
        <code class="block bg-white p-2 mt-1 rounded text-xs">
Generate 2 multiple choice questions in JSON format. Each should include "question_text", 4 "options", and one "correct_answer".
        </code>
      </div>

      <!-- Form -->
      <form action="/textai" method="POST">
        @csrf
        <input type="hidden" name="folder_id" value="{{ $folderId }}">
        <textarea name="ai_text" required rows="6" class="w-full p-2 border border-gray-300 rounded-md text-sm mb-4" placeholder="Enter instructions for AI generation"></textarea>
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">Generate Quiz</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
<script>
    // --- File Input Label Updater ---
    function setupFileInputLabel(inputId, labelId) {
        const fileInput = document.getElementById(inputId);
        const fileNameLabel = document.getElementById(labelId);
        const defaultLabelText = fileNameLabel.textContent;

        if (fileInput && fileNameLabel) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    fileNameLabel.textContent = this.files[0].name;
                } else {
                    fileNameLabel.textContent = defaultLabelText;
                }
            });
        }
    }
    setupFileInputLabel('resourceFile', 'resourceFileName');
    setupFileInputLabel('audioFile', 'audioFileName');


    // --- Audio Upload Progress ---
    const audioForm = document.getElementById('audioUploadForm');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const uploadBtn = document.getElementById('uploadBtn');

    if (audioForm) {
        audioForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const fileInput = audioForm.querySelector('input[type="file"]');
            if (fileInput.files.length === 0) {
                alert('Please select an audio file to upload.');
                return;
            }
            const file = fileInput.files[0];
            const maxSizeInBytes = 30 * 1024 * 1024; // 30 MB
            if (file.size > maxSizeInBytes) {
                alert('Audio file must be below 30 MB. Please choose a smaller file.');
                fileInput.value = '';
                setupFileInputLabel('audioFile', 'audioFileName'); // Reset label
                return;
            }

            const formData = new FormData(audioForm);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', audioForm.action, true);

            progressContainer.classList.remove('hidden', 'opacity-0');
             requestAnimationFrame(() => {
                progressContainer.classList.add('opacity-100');
            });
            uploadBtn.disabled = true;
            progressBar.style.strokeDashoffset = 339.292;
            progressText.textContent = '0%';

            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                    const circumference = 339.292;
                    const offset = circumference - (circumference * percentComplete) / 100;
                    progressBar.style.strokeDashoffset = offset;
                    progressText.textContent = percentComplete + '%';
                }
            };

            xhr.onload = function() {
                progressContainer.classList.remove('opacity-100');
                setTimeout(() => progressContainer.classList.add('hidden'), 300);
                uploadBtn.disabled = false;
                setupFileInputLabel('audioFile', 'audioFileName'); // Reset label
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Success, reload to show updated file list and session messages
                    window.location.reload();
                } else {
                    let errorMessage = 'Upload failed. Please try again.';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response && (response.message || response.error)) {
                            errorMessage = response.message || response.error;
                        }
                    } catch (parseError) { console.error("Error parsing server response:", xhr.responseText); }
                    alert(errorMessage);
                }
            };
            xhr.onerror = function() {
                alert('An error occurred during upload. Check your network connection.');
                progressContainer.classList.remove('opacity-100');
                setTimeout(() => progressContainer.classList.add('hidden'), 300);
                uploadBtn.disabled = false;
                setupFileInputLabel('audioFile', 'audioFileName'); // Reset label
            };
            xhr.send(formData);
        });
    }
    const quizModal = document.getElementById('quizModal');
const pdfModal = document.getElementById('pdfModal');
const aiTextModal = document.getElementById('aiTextModal');

function openQuizModal() {
    if (!quizModal) return;
    quizModal.classList.remove('hidden', 'opacity-0');
    requestAnimationFrame(() => quizModal.classList.add('opacity-100'));
    document.body.style.overflow = 'hidden';
    if (document.querySelectorAll('#mcqContainer .question-block').length < 5) {
        const needed = 5 - document.querySelectorAll('#mcqContainer .question-block').length;
        for (let i = 0; i < needed; i++) addQuestion(false);
    }
}

function closeQuizModal() {
    if (!quizModal) return;
    quizModal.classList.remove('opacity-100');
    setTimeout(() => { quizModal.classList.add('hidden'); document.body.style.overflow = ''; }, 300);
}


function openAiTextModal() {
    aiTextModal.classList.remove('hidden', 'opacity-0');
    requestAnimationFrame(() => aiTextModal.classList.add('opacity-100'));
}
function closeAiTextModal() {
    aiTextModal.classList.remove('opacity-100');
    setTimeout(() => aiTextModal.classList.add('hidden'), 300);
}

function submitAIGenerate() {
    showLoading();
    fetch('/aigenerate', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value},
        body: new URLSearchParams({'folder_id': '{{ $folderId }}'})
    })
    .then(res => res.json())
    .then(data => handleResponse(data))
    .catch(err => handleResponse({status: 'False', message: err.message}));
}

function removeLastQuestion() {
    const blocks = document.querySelectorAll('#mcqContainer .question-block');
    if (blocks.length > 5) {
        blocks[blocks.length - 1].remove();
        updateQuestionNumbersAndRemoveButtons();
    } else alert('Minimum 5 questions are required.');
}

function showLoading() {
    const overlay = document.createElement('div');
    overlay.id = 'loadingOverlay';
    overlay.className = 'fixed inset-0 z-70 bg-black bg-opacity-50 flex items-center justify-center';
    overlay.innerHTML = `<div class=\"bg-white p-6 rounded-lg shadow-lg text-center\">\n        <p class=\"mb-4\">Processing... This may take 2-3 minutes with a good Internet connection.</p>\n        <div class=\"loader border-4 border-t-4 rounded-full w-12 h-12 animate-spin mx-auto\"></div>\n    </div>`;
    document.body.appendChild(overlay);
}

function hideLoading() {
    document.getElementById('loadingOverlay')?.remove();
}

function handleResponse(data) {
    hideLoading();
    closeQuizModal(); closePdfModal(); closeAiTextModal();
    location.reload();
    alert(data.status === 'True' ? data.message : 'Error: ' + data.message);
}

// --- MCQ Management ---
function addQuestion(showAlerts = true) {
    const currentQuestions = document.querySelectorAll('#mcqContainer .question-block').length;
    if (currentQuestions >= 15) {
        if (showAlerts) alert("Maximum 15 questions allowed.");
        return;
    }

    const mcqContainer = document.getElementById('mcqContainer');
    const newQuestionIndex = currentQuestions + 1;
    const div = document.createElement('div');
    div.className = 'p-4 border border-gray-200 rounded-lg bg-gray-50 question-block space-y-3';

    div.innerHTML = `
        <div class="flex justify-between items-center">
            <label class="block text-sm font-medium text-gray-700 question-label">Q${newQuestionIndex}. Question</label>
            ${newQuestionIndex > 5 ? '<button type="button" onclick="removeLastQuestion()" class="text-red-500 hover:text-red-700 text-xs font-medium p-1 hover:bg-red-100 rounded-full transition-colors"><ph-x size="16" weight="bold"></ph-x></button>' : ''}
        </div>
        <input type="text" name="questions[${newQuestionIndex}][question]" required class="form-input w-full p-2 border-gray-300 rounded-md text-sm" placeholder="Enter question text">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <input type="text" name="questions[${newQuestionIndex}][a]" placeholder="Option A" required class="form-input p-2 border-gray-300 rounded-md text-sm">
            <input type="text" name="questions[${newQuestionIndex}][b]" placeholder="Option B" required class="form-input p-2 border-gray-300 rounded-md text-sm">
            <input type="text" name="questions[${newQuestionIndex}][c]" placeholder="Option C" required class="form-input p-2 border-gray-300 rounded-md text-sm">
            <input type="text" name="questions[${newQuestionIndex}][d]" placeholder="Option D" required class="form-input p-2 border-gray-300 rounded-md text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Correct Answer</label>
            <select name="questions[${newQuestionIndex}][answer]" required class="form-input w-full p-2 border-gray-300 rounded-md text-sm bg-white">
                <option value="">Select Correct</option>
                <option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option>
            </select>
        </div>
    `;
    mcqContainer.appendChild(div);
    updateQuestionNumbersAndRemoveButtons();
}

function updateQuestionNumbersAndRemoveButtons() {
    const blocks = document.querySelectorAll('#mcqContainer .question-block');
    blocks.forEach((block, idx) => {
        const num = idx + 1;
        const label = block.querySelector('.question-label');
        if (label) label.textContent = `Q${num}. Question`;
        block.querySelectorAll('input, select').forEach(input => {
            if (input.name) input.name = input.name.replace(/questions\[\d+\]/, `questions[${num}]`);
        });
        const removeBtn = block.querySelector('button[onclick="removeLastQuestion()"]');
        if (num > 5) {
            if (!removeBtn) {
                const header = block.querySelector('.flex.justify-between');
                const btn = document.createElement('button');
                btn.type = 'button'; btn.className = 'text-red-500 hover:text-red-700 text-xs font-medium p-1 hover:bg-red-100 rounded-full transition-colors';
                btn.innerHTML = '<ph-x size="16" weight="bold"></ph-x>';
                btn.onclick = () => removeLastQuestion();
                header.appendChild(btn);
            }
        } else if (removeBtn) removeBtn.remove();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    updateQuestionNumbersAndRemoveButtons();
    document.getElementById('quizForm').addEventListener('submit', e => {
        const cnt = document.querySelectorAll('#mcqContainer .question-block').length;
        if (cnt < 5 || cnt > 15) {
            e.preventDefault();
            alert(cnt < 5 ? "Please add at least 5 questions." : "Maximum 15 questions allowed.");
        }
    });
});

</script>
</body>
</html>