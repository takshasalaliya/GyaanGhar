<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Take Quiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta name="description" content="Quiz">
    <link rel="canonical" href="{{url()->full()}}" />
    <meta property="og:title" content="Quiz" />
<meta property="og:description" content="Quiz | Lecture Quiz" />
<meta property="og:url" content="{{url()->full()}}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg" />
<link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon" class="favicon">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-3xl mx-auto p-6 bg-white mt-10 rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Quiz</h2>
        @if (session('success'))
    <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-400 rounded">
        {!! session('success') !!}
    </div>
@endif

@if ($errors->any())
    <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-400 rounded">
        @foreach ($errors->all() as $error)
            <div>{!! $error !!}</div>
        @endforeach
    </div>
@endif
<div class="register-container animate__animated animate__fadeInUp">
  <!-- Back Button -->
<a href="javascript:history.back()"><button class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"> ← Back</button></a>

        <form id="quizForm" action="/quiz/submit" method="POST" class="space-y-4">
    @csrf

            <input type="hidden" id="folderId" value="{{ $folderId }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold">Roll Number</label>
                    <input type="text" id="roll" name="roll" required class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold">Name</label>
                    <input type="text" id="name" name="name" required class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            {{-- QUESTIONS FROM CONTROLLER --}}
            @foreach ($questions as $index => $q)
                <div class="p-4 border rounded-md mt-4">
                    <p class="font-semibold mb-2">Q{{ $index+1 }}. {{ $q['question'] }}</p>
                    @foreach (['a', 'b', 'c', 'd'] as $opt)
                        <div>
                            <input type="radio" id="q{{ $index }}_{{ $opt }}" name="q{{ $index }}" value="{{ $opt }}" required>
                            <label for="q{{ $index }}_{{ $opt }}">{{ $q[$opt] }}</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="answer_{{ $index }}" value="{{ $q['answer'] }}">
                </div>
            @endforeach
            <input type="hidden" name="folderId" value="{{$folderId}}">
            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md font-semibold mt-6">
                Submit Quiz
            </button>
        </form>

        <div id="message" class="mt-6 text-center font-semibold text-red-600"></div>
    </div>

    <script>
    document.getElementById("quizForm").addEventListener("submit", function(e) {
        const questions = document.querySelectorAll("[name^='q']");
        const answers = [];
        const correctAnswers = [];

        let total = 0;

        document.querySelectorAll("[name^='q']").forEach((input, index) => {
            const questionIndex = input.name.match(/\d+/)[0];
            const selected = document.querySelector(`[name="q${questionIndex}"]:checked`);
            if (selected) {
                answers[questionIndex] = selected.value;
            }
            const correct = document.querySelector(`[name="answer_${questionIndex}"]`).value;
            correctAnswers[questionIndex] = correct;
            total++;
        });

        const form = document.getElementById("quizForm");

        // Create and append hidden inputs for answers and correct answers
        answers.forEach((value, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `answers[${index}]`;
            input.value = value;
            form.appendChild(input);
        });

        correctAnswers.forEach((value, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `correct_answers[${index}]`;
            input.value = value;
            form.appendChild(input);
        });

        // Allow form to submit
    });
</script>


</body>
</html>
