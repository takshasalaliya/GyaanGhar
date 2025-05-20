<?php

return [
   'credentials' => env('FIREBASE_CREDENTIALS', storage_path('firebase/firebase.json')),


    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'), // Optional: only needed if you're using Firebase Realtime Database
    ],
];
