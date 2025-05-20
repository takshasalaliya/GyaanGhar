<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseConnection;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\McqController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Http;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/',[FirebaseConnection::class,'index']);

Route::middleware(['User'])->group(function(){

Route::post('/logout',[FirebaseAuthController::class,'logout'])->name('auth.logout');
Route::post('/classes', [FirebaseAuthController::class, 'createClass']);
Route::get('/dashboard', [FirebaseAuthController::class, 'getClasses']);
Route::delete('/classes/{id}', [FirebaseAuthController::class, 'deleteClass']);
Route::get('google/redirect', [GoogleDriveController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('google/callback', [GoogleDriveController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/folder/{folderId}', [FirebaseAuthController::class, 'viewFolder'])->name('folder.view');
Route::post('/folder/{folderId}/upload', [FirebaseAuthController::class, 'uploadToFolder'])->name('folder.upload');
Route::delete('/file/{fileId}', [FirebaseAuthController::class, 'deleteFile'])->name('file.delete');

Route::post('/upload', [FirebaseAuthController::class, 'upload']);
// web.php
Route::post('subfolders/create', [FirebaseAuthController::class, 'createSubfolder']);
Route::post('subfolders/delete', [FirebaseAuthController    ::class, 'deleteSubfolder']);

Route::post('/delete', [FirebaseAuthController::class, 'delete']);


Route::get('subfolder/{id}/{fid}', [FirebaseAuthController::class, 'show']);
Route::post('upload/resource', [FirebaseAuthController::class, 'uploadResource']);
Route::post('upload/audio', [FirebaseAuthController::class, 'uploadAudio']);
Route::post('upload/quiz', [FirebaseAuthController::class, 'uploadQuiz']);
Route::post('file/delete', [FirebaseAuthController::class, 'deleteFiles']);
Route::get('resource/{id}',[FirebaseAuthController::class,'showResources']);
Route::post('/upload/quiz/manual', [FirebaseAuthController::class, 'uploadQuizManual']);
Route::get('/score/{id}',[FirebaseAuthController::class,'score']);
Route::post('/aigenerate',[FirebaseAuthController::class,'aigenerate']);
Route::post('/uploadpdfai',[FirebaseAuthController::class,'uploadpdfai']);
Route::post('/textai',[FirebaseAuthController::class,'textai']);

Route::get('/mcq-generator', function () {
    return view('aitest'); // You'll need to create this Blade view
});
Route::post('/mcq-generator/generate', [McqController::class, 'generate'])->name('mcq.generate');
});


Route::view('/student','student');
Route::get('/',[FirebaseAuthController::class,'welcome']);
Route::view('/privacy-policy','private');
Route::view('/about-us','aboutus');
Route::view('/contact-us','contantus');
Route::view('/disclaimer','disclamer');
Route::view('/terms-and-conditions','term');
Route::post('/folder/details',[FirebaseAuthController::class,'userdetail']);
Route::get('/register',[FirebaseAuthController::class,'registerForm']);
Route::post('/user-register',[FirebaseAuthController::class,'register']);
Route::get('/login',[FirebaseAuthController::class,'loginForm']);
Route::post('/user-login',[FirebaseAuthController::class,'login']);
Route::get('/folder/{id}/{code}', [FirebaseAuthController::class, 'showFolderContent']);
Route::get('/quiz/', [FirebaseAuthController::class, 'showquiz']);
Route::post('/quiz/submit', [FirebaseAuthController::class, 'submit']);
Route::post('/contact',[FirebaseAuthController::class,'contant']);
Route::get('/file/stream/{file}', [FirebaseAuthController::class, 'stream'])
     ->name('file.stream');
Route::view('/review','review');
Route::post('/submitreview',[FirebaseAuthController::class,'review']);

Route::get('/test-error', function () {
     abort(404); 
 });

 