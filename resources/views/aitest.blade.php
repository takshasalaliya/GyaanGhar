<!DOCTYPE html>
<html>
<head>
    <title>MCQ Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: sans-serif; margin: 20px; }
        textarea { width: 100%; min-height: 150px; margin-bottom: 10px; }
        button { padding: 10px 15px; }
        .mcq { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .mcq p { margin: 5px 0; }
        .mcq ul { list-style: none; padding-left: 20px; }
        .loading { display: none; }
    </style>
</head>
<body>
    <h1>MCQ Generator</h1>
    <form id="mcqForm" method="POST" action="{{ route('mcq.generate') }}">
        @csrf
        <div>
            <label for="text_input">Enter your text:</label><br>
            <textarea id="text_input" name="text_input" required minlength="10"></textarea>
        </div>
        <button type="submit">Generate MCQs</button>
    </form>

    <div id="loading" class="loading">Generating, please wait...</div>
    <div id="results"></div>
</body>
</html>
