<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $folder->name ?? $className ?? 'Folder View' }} - GyaanGhar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="View files and subfolders within '{{ $folder->name ?? $className ?? 'this folder' }}'. Access Code: {{ $code ?? 'N/A' }}." />

    <link rel="canonical" href="{{ url()->full() }}" />
    <meta property="og:title" content="{{ $folder->name ?? $className ?? 'Folder View' }} - GyaanGhar" />
    <meta property="og:description" content="View files and subfolders within '{{ $folder->name ?? $className ?? 'this folder' }}'. Access Code: {{ $code ?? 'N/A' }}." />
    <meta property="og:url" content="{{ url()->full() }}" />
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
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
        }
        img, video, audio {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            user-select: none;
        }
        video::-internal-media-controls-download-button,
        audio::-internal-media-controls-download-button,
        video::-webkit-media-controls-enclosure [download],
        audio::-webkit-media-controls-enclosure [download] {
            display: none !important;
        }
        iframe, object {
            border: none;
        }
        .file-preview-container img,
        .file-preview-container object,
        .file-preview-container video {
            pointer-events: none;
        }
        #imageModalContent {
            pointer-events: auto;
            max-width: 95vw;
            max-height: 95vh;
            object-fit: contain;
        }
        .file-item-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .file-preview-container {
            min-height: 16rem; /* h-64 */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6; /* bg-gray-100 */
            border-radius: 0.5rem; /* rounded-lg */
            overflow: hidden;
            position: relative; /* For overlays */
        }
         /* Ensure Phosphor icons inherit text color if not set explicitly */
        [class^="ph-"] {
            vertical-align: middle; /* Better alignment with text */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url()->full();
        $folderName = $folder->name ?? $className ?? 'Shared Content';
        $folderDescription = "Files and subfolders within '{$folderName}'. Access Code: " . ($code ?? 'N/A');

        $breadcrumbItems = [];
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl];

        if (isset($class) && $class) {
            $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => $class->name, 'item' => url('/class/' . $class->id)]; // Adjust URL as needed
            if (isset($folder) && $folder) {
                 $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $folder->name, 'item' => $pageFullUrl];
            }
        } elseif (isset($folder) && $folder) {
             $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => $folder->name, 'item' => $pageFullUrl];
        }


        $itemList = [];
        if (isset($folders) && count($folders) > 0) {
            foreach($folders as $idx => $subFolder) {
                $itemList[] = [
                    '@type' => 'ListItem',
                    'position' => $idx + 1,
                    'item' => [
                        '@type' => ['WebPage', 'CollectionPage'], // A folder can be seen as a collection page
                        'url' => url('/folder/'.$subFolder->id.'/'.$code),
                        'name' => $subFolder->name,
                        'description' => $subFolder->description ?? "Subfolder: {$subFolder->name}"
                    ]
                ];
            }
        }
        if (isset($files) && count($files) > 0) {
            $fileStartIndex = count($itemList);
            foreach($files as $idx => $file) {
                $fileSchemaType = 'CreativeWork'; // Default
                if (strpos($file->mimeType, 'image') !== false) $fileSchemaType = 'ImageObject';
                elseif (strpos($file->mimeType, 'video') !== false) $fileSchemaType = 'VideoObject';
                elseif (strpos($file->mimeType, 'audio') !== false) $fileSchemaType = 'AudioObject';
                elseif ($file->mimeType === 'application/pdf') $fileSchemaType = 'DigitalDocument';

                $itemList[] = [
                    '@type' => 'ListItem',
                    'position' => $fileStartIndex + $idx + 1,
                    'item' => [
                        '@type' => $fileSchemaType,
                        'url' => route('file.stream', $file->id), // URL to view/access the file
                        'name' => $file->name,
                        'encodingFormat' => $file->mimeType,
                    ]
                ];
            }
        }


        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => $siteBaseUrl . '#organization',
                    'name' => 'GyaanGhar',
                    'url' => $siteBaseUrl,
                    'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $pageFullUrl . '#webpage',
                    'url' => $pageFullUrl,
                    'name' => "{$folderName} - GyaanGhar",
                    'description' => $folderDescription,
                    'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
                    'publisher' => ['@id' => $siteBaseUrl . '#organization'],
                    'breadcrumb' => [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => $breadcrumbItems
                    ]
                ],
                [ // Describing this page as a collection of items
                    '@type' => 'CollectionPage',
                    'mainEntityOfPage' => ['@id' => $pageFullUrl . '#webpage'],
                    'name' => "Contents of folder: {$folderName}",
                    'description' => "List of files and subfolders available in {$folderName}.",
                    'hasPart' => array_map(function($item) { return ['@id' => $item['item']['url'] . '#item']; }, $itemList), // Referencing items by ID
                     'itemListElement' => $itemList, // Listing items
                ]
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-50 text-gray-800">

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
                <a href="/student" class="text-xs sm:text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 inline-flex items-center group px-3 py-1.5 sm:px-4 sm:py-2 rounded-md shadow-sm">
                    <ph-plus-circle size="16" weight="bold" class="sm:mr-1.5"></ph-plus-circle>
                    <span class="hidden sm:inline">New Code</span>
                    <span class="sm:hidden">New Code</span>
                </a>
            </nav>
        </div>
    </header>
 @php
                    $quiz=0;
                    @endphp
    <main class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900">
                {{ $folder->name ?? $className ?? 'Shared Files' }}
            </h1>
            @if(isset($folder->description) && $folder->description)
                <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-600">{{ $folder->description }}</p>
            @endif
            @if(isset($code))
                <p class="text-sm text-gray-500 mt-4">Access Code: <strong class="text-gray-600">{{ $code }}</strong></p>
            @endif
        </div>

        @if((!isset($folders) || count($folders) === 0) && (!isset($files) || count($files) === 0))
            <div class="text-center py-12">
                <ph-folder-notch-open size="64" class="text-gray-400 mx-auto"></ph-folder-notch-open>
                <p class="mt-4 text-xl font-medium text-gray-700">This folder is currently empty.</p>
                <p class="text-gray-500">Check back later or contact the folder owner if you expected content here.</p>
            </div>
        @else
            <div class="grid gap-6 md:gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                {{-- Folders --}}
                @if(isset($folders))
                    @foreach($folders as $subFolder)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out p-5 file-item-card">
                        <div class="flex-grow mb-4 text-center"> {{-- Centering content for folder --}}
                            <div class="flex items-center justify-center mb-3">
                                <ph-folder-simple-user size="48" weight="duotone" class="text-yellow-500"></ph-folder-simple-user>
                            </div>
                            <h3 class="font-semibold text-lg text-gray-800 break-words leading-tight">{{ $subFolder->name }}</h3>
                            @if($subFolder->description)
                                <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ $subFolder->description }}</p>
                            @endif
                        </div>
                        <a href="{{ url('/folder/'.$subFolder->id.'/'.$code) }}"
                           class="block w-full bg-indigo-600 text-white text-center px-4 py-2.5 rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 text-sm">
                            Open Folder
                        </a>
                    </div>
                    
                    @endforeach
                @endif

                {{-- Files --}}
                @if(isset($files))
                    @foreach($files as $file)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out p-5 file-item-card">
                        <div class="flex-grow mb-4">
                             <h3 class="font-semibold text-gray-800 mb-3 break-words leading-tight text-base line-clamp-2 text-center">
                                {{-- For audio, use filename without extension for cleaner look if desired, otherwise full name --}}
                                {{ strpos($file->mimeType,'audio')!==false ? pathinfo($file->name, PATHINFO_FILENAME) : $file->name }}
                            </h3>

                            {{-- IMAGE --}}
                            @if(strpos($file->mimeType,'image')!==false)
                            <div onclick="openImageModal('{{ route('file.stream', $file->id) }}', '{{ addslashes($file->name) }}')"
                                 class="file-preview-container cursor-pointer group">
                                <img src="{{ route('file.stream', $file->id) }}"
                                     alt="Preview of {{ $file->name }}"
                                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-200"
                                     onerror="this.onerror=null; this.parentElement.innerHTML = '<div class=\'flex flex-col items-center justify-center text-gray-500\'><ph-image-broken size=\'48\'></ph-image-broken><p class=\'text-xs mt-1\'>Preview unavailable</p></div>';"
                                     oncontextmenu="return false;">
                            </div>

                            {{-- PDF --}}
                            @elseif($file->mimeType==='application/pdf')
                            <div class="file-preview-container relative group">
                                <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center bg-gray-100">
                                    <ph-file-pdf size="64" weight="duotone" class="text-red-600 mb-2"></ph-file-pdf>
                                    <p class="text-sm font-medium text-gray-700">PDF Document</p>
                                </div>
                                <div onclick="openPdfModal('{{ route('file.stream', $file->id) }}', '{{ addslashes($file->name) }}')"
                                     class="absolute inset-0 w-full h-full cursor-pointer bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 flex items-center justify-center"
                                     title="Open PDF: {{ $file->name }}">
                                      <ph-magnifying-glass size="32" class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200"></ph-magnifying-glass>
                                </div>
                            </div>

                            {{-- VIDEO --}}
                            @elseif(strpos($file->mimeType,'video')!==false)
                            <div class="file-preview-container bg-black">
                                <video controls controlsList="nodownload nofullscreen noremoteplayback"
                                       disablePictureInPicture
                                       class="w-full h-full object-contain"
                                       oncontextmenu="return false;"
                                       preload="metadata">
                                    <source src="{{ route('file.stream', $file->id) }}" type="{{ $file->mimeType }}">
                                    Your browser does not support the video tag.
                                </video>
                            </div>

                            {{-- AUDIO --}}
                            @elseif(strpos($file->mimeType,'audio')!==false)
                            <div class="py-4 flex flex-col items-center justify-center">
                                <ph-speaker-high size="64" weight="duotone" class="text-indigo-600 mb-4"></ph-speaker-high>
                                  <p class="text-xs text-gray-600 mb-1 pb-4">
                                        <b>It may take few moment to load audio.</b>
                                    </p>
                                <audio controls controlsList="nodownload"
                                       class="w-full h-12 "
                                       preload="metadata"
                                       oncontextmenu="return false;"
                                       id="audioPlayer_{{ $file->id }}"> {{-- Added ID for event listener --}}
                                    <source src="{{ route('file.stream', $file->id) }}" type="{{ $file->mimeType }}">
                                    Your browser does not support the audio tag.
                                </audio>
                            </div>
 @php
                    $quiz=1;
                    @endphp

                            {{-- UNSUPPORTED / GENERIC FILE --}}
                            @else
                            <div onclick="window.open('{{ route('file.stream', $file->id) }}?download=true', '_blank')"
                                 class="file-preview-container cursor-pointer hover:bg-gray-200 transition-colors duration-150 flex flex-col items-center justify-center text-center p-4">
                                <ph-file-arrow-down size="64" weight="duotone" class="text-gray-500 mb-2"></ph-file-arrow-down>
                                <p class="text-sm font-medium text-gray-700">Open/Download File</p>
                                <p class="text-xs text-gray-500 mt-1">({{ $file->mimeType }})</p>
                            </div>
                            @endif
                        </div>
                        {{-- Common Action Button for non-audio files --}}
                        @if(strpos($file->mimeType,'audio') === false)
                            @if(strpos($file->mimeType,'video') === false && $file->mimeType !== 'application/pdf' && strpos($file->mimeType,'image') === false)
                                {{-- Download button for generic files --}}
                                <a href="{{ route('file.stream', $file->id) }}?download=true" target="_blank"
                                   class="block w-full mt-auto bg-gray-200 hover:bg-gray-300 text-gray-700 text-center px-4 py-2.5 rounded-lg font-medium transition-colors duration-150 text-sm">
                                    Download
                                </a>
                            @elseif($file->mimeType === 'application/pdf' || strpos($file->mimeType,'image') !== false)
                                 {{-- View button for PDF/Image --}}
                                 <button onclick="{{ strpos($file->mimeType,'image')!==false ? "openImageModal('".route('file.stream', $file->id)."', '".addslashes($file->name)."')" : "openPdfModal('".route('file.stream', $file->id)."', '".addslashes($file->name)."')" }}"
                                       class="block w-full mt-auto bg-blue-500 hover:bg-blue-600 text-white text-center px-4 py-2.5 rounded-lg font-medium transition-colors duration-150 text-sm">
                                    View
                                </button>
                            @endif
                        @endif
                    </div>
                    @endforeach
                @endif
            </div>
        @endif
        @if($quiz==1)
        <form method="get" action="/quiz">
    <input hidden name="folderid" value="{{url()->current()}}">
     <button class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-150 text-sm font-medium">
                                  Take Quiz
                                </button>
</form>
@endif
    {{-- P
         <p class="text-center text-gray-500 mt-16 text-xs">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </p>
    </main>
DF Modal --}}
    <div id="pdfModal" class="fixed inset-0 bg-black bg-opacity-85 hidden z-50 flex items-center justify-center p-0 transition-opacity duration-300 opacity-0">
        <div id="pdfModalContentBox" class="relative w-screen h-screen bg-gray-100 shadow-none flex flex-col rounded-none">
            <div class="flex items-center justify-between p-3 sm:p-4 border-b border-gray-300 bg-white flex-shrink-0">
                <h3 id="pdfModalTitle" class="text-base sm:text-lg font-semibold text-gray-800 truncate pr-2">PDF Viewer</h3>
                <button id="closePdfModalBtn" aria-label="Close PDF Viewer" class="text-gray-500 hover:text-red-600 transition-colors p-1.5 sm:p-2 rounded-full hover:bg-gray-200">
                    <ph-x size="20" weight="bold" class="sm:hidden"></ph-x>
                    <ph-x size="24" weight="bold" class="hidden sm:inline-block"></ph-x>
                </button>
            </div>
            <div id="pdfContainer" class="w-full flex-grow overflow-auto bg-gray-300">
                {{-- PDF iframe/object injected here --}}
            </div>
        </div>
    </div>

    {{-- Image Modal --}}
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-[60] flex items-center justify-center p-2 sm:p-4 transition-opacity duration-300 opacity-0">
        <img id="imageModalContent" src="" alt="Full screen preview" class="rounded-lg shadow-xl" oncontextmenu="return false;">
        <button id="closeImageModalBtn" aria-label="Close image viewer" class="absolute top-3 right-3 sm:top-5 sm:right-5 text-white bg-black bg-opacity-40 hover:bg-opacity-60 transition-colors p-2 rounded-full">
            <ph-x size="24" weight="bold" class="sm:hidden"></ph-x>
            <ph-x size="28" weight="bold" class="hidden sm:inline-block"></ph-x>
        </button>
        <div id="imageModalTitleContainer" class="absolute bottom-3 left-1/2 -translate-x-1/2 bg-black bg-opacity-50 text-white text-xs sm:text-sm px-3 py-1.5 rounded-md">
            <span id="imageModalTitle">Image Name</span>
        </div>
    </div>

    <script>
        // --- Security: Disable right-click & common shortcuts ---
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', event => {
            const blockedKeys = ['s', 'u', 'p', 'i', 'j', 'c', 'a'];
            const isShortcutKey = event.ctrlKey || event.metaKey;
            if (event.key === 'F12' || (isShortcutKey && blockedKeys.includes(event.key.toLowerCase()))) {
                event.preventDefault();
            }
            if (event.ctrlKey && event.shiftKey && ['I', 'J', 'C'].includes(event.key.toUpperCase())) {
                event.preventDefault();
            }
        });

        // --- Quiz Button Logic for Audio Files (No timer, button always visible) ---
        // No specific DOMContentLoaded logic needed for this simplified button behavior.
        // The button is rendered directly in the HTML without the 'hidden' class.

        function redirectToQuiz(buttonElement) {
            const fileId = buttonElement.dataset.file; // Get the file ID for localStorage tracking

            const currentPathname = window.location.pathname; // e.g., /folder/1JbYM9UJ9qLNnB-9kFnJxlBBR9ZWMHYFX/CdKdGY
            const folderPrefix = '/folder/';
            
            let extractedFolderIdPart = '';

            if (currentPathname.startsWith(folderPrefix)) {
                extractedFolderIdPart = currentPathname.substring(folderPrefix.length);
            }

            if (!extractedFolderIdPart) {
                console.error("Could not extract folder ID part from URL:", currentPathname);
                alert("Error: Could not determine the folder ID from the URL to proceed to the quiz.");
                return;
            }
            
            // For localStorage, we use the extracted part and fileId to mark attempt
            // This assumes the `extractedFolderIdPart` is the relevant context for the quiz attempt.
            localStorage.setItem(`quiz_attempted_${extractedFolderIdPart.replace(/\//g, '_')}_${fileId}`, 'true');
            // Note: Replaced '/' with '_' in extractedFolderIdPart for localStorage key to avoid issues if it contains slashes.

            window.location.href = `/quiz/${extractedFolderIdPart}`;
        }


        // --- Modal Handling (Common Logic) ---
        function openModal(modalElement, onOpenCallback) {
            if (!modalElement) return;
            if (onOpenCallback) onOpenCallback();
            modalElement.classList.remove('hidden');
            requestAnimationFrame(() => {
                 modalElement.classList.remove('opacity-0');
                 modalElement.classList.add('opacity-100');
            });
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalElement, onCloseOperation) {
            if (!modalElement) return;
            modalElement.classList.remove('opacity-100');
            modalElement.classList.add('opacity-0');
            setTimeout(() => {
                modalElement.classList.add('hidden');
                if (onCloseOperation) onCloseOperation();
                document.body.style.overflow = '';
            }, 300);
        }

        // --- PDF Modal Specific Handling ---
        const pdfModal = document.getElementById('pdfModal');
        const pdfContainer = document.getElementById('pdfContainer');
        const closePdfModalBtn = document.getElementById('closePdfModalBtn');
        const pdfModalTitleEl = document.getElementById('pdfModalTitle');

        function openPdfModal(url, fileName = 'PDF Document') {
            if (!pdfModal || !pdfContainer || !pdfModalTitleEl) return;
            openModal(pdfModal, () => {
                pdfContainer.innerHTML = '';
                const pdfUrlWithOptions = `${url}#toolbar=0&navpanes=0&view=FitH`;
                const pdfElement = document.createElement('iframe');
                pdfElement.setAttribute('src', pdfUrlWithOptions);
                pdfElement.setAttribute('class', 'w-full h-full border-none');
                pdfElement.setAttribute('loading', 'lazy');
                pdfElement.setAttribute('title', `PDF Preview: ${fileName}`);
                pdfElement.oncontextmenu = () => false;
                pdfModalTitleEl.textContent = fileName;
                pdfContainer.appendChild(pdfElement);
            });
        }
        if (closePdfModalBtn) {
            closePdfModalBtn.addEventListener('click', () => closeModal(pdfModal, () => { if(pdfContainer) pdfContainer.innerHTML = ''; }));
        }
        if (pdfModal) {
            pdfModal.addEventListener('click', event => {
                if (event.target === pdfModal && closePdfModalBtn) closeModal(pdfModal, () => { if(pdfContainer) pdfContainer.innerHTML = ''; });
            });
        }

        // --- Image Modal Specific Handling ---
        const imageModal = document.getElementById('imageModal');
        const imageModalContent = document.getElementById('imageModalContent');
        const closeImageModalBtn = document.getElementById('closeImageModalBtn');
        const imageModalTitleEl = document.getElementById('imageModalTitle');

        function openImageModal(imageUrl, imageName = 'Image Preview') {
            if (!imageModal || !imageModalContent || !imageModalTitleEl) return;
            openModal(imageModal, () => {
                imageModalContent.src = imageUrl;
                imageModalContent.alt = `Full screen preview of ${imageName}`;
                imageModalTitleEl.textContent = imageName;
            });
        }
        if (closeImageModalBtn) {
            closeImageModalBtn.addEventListener('click', () => closeModal(imageModal, () => { if(imageModalContent) imageModalContent.src = ''; }));
        }
        if (imageModal) {
            imageModal.addEventListener('click', (event) => {
                 if (event.target === imageModal && closeImageModalBtn) closeModal(imageModal, () => { if(imageModalContent) imageModalContent.src = ''; });
            });
        }

        // --- Escape Key to Close Modals ---
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                if (pdfModal && !pdfModal.classList.contains('hidden') && !pdfModal.classList.contains('opacity-0')) {
                    closeModal(pdfModal, () => { if(pdfContainer) pdfContainer.innerHTML = ''; });
                }
                if (imageModal && !imageModal.classList.contains('hidden') && !imageModal.classList.contains('opacity-0')) {
                    closeModal(imageModal, () => { if(imageModalContent) imageModalContent.src = ''; });
                }
            }
        });
    </script>
</body>
</html>