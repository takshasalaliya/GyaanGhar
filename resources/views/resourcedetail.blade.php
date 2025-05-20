<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resources</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Resources Data">
    <meta property="og:title" content="Resources" />
<meta property="og:description" content="Resources Data" />
<meta property="og:url" content="{{url()->full()}}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg" />
<link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon" class="favicon">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen font-sans">

<div class="max-w-6xl mx-auto p-4 sm:p-8">
    <!-- Page Header -->
    <a href="javascript:history.back()"><button class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"> ← Back</button></a>
    <div class="text-center mb-8">
        <!-- Session Flash Messages -->
@if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        {{ session('error') }}
    </div>
@endif


        <h1 class="text-3xl font-bold text-gray-800">📄 Resources</h1>
        <p class="text-gray-600 text-sm">View and manage your class resources</p>
    </div>

    <!-- Resource Files -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse ($files as $file)
            <div class="bg-white p-4 rounded shadow flex flex-col justify-between">
                <div class="mb-3">
                    <div class="text-lg text-gray-800 truncate font-medium">📎 {{ $file['name'] }}</div>
                </div>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <form action="/file/delete" method="POST">
                        @csrf
                        <input type="hidden" name="file_id" value="{{ $file['id'] }}">
                        <input type="hidden" name="folder_id" value="{{ $folderId }}">
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>

                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No resources found.</p>
        @endforelse
    </div>
</div>

</body>
</html>
