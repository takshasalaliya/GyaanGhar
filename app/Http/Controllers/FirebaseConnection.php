<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;


class FirebaseConnection extends Controller
{
    //
    public function index(){
        $path = base_path('storage/firebase/firebase.json');
        if(!file_exists($path)){
            die("This file path .{$path}. is not exists");
        }

        try{
            $factory = (new Factory)
    ->withServiceAccount($path)
    ->withDatabaseUri('https://final-laravel-project-default-rtdb.firebaseio.com/');
    $database = $factory->createDatabase();
    $reference=$database->getReference('contacts');
    $reference->set(['connection' => true]);
    $sanShot = $reference->getSnapshot();
    $value = $sanShot->getValue();
    return response([
        'message' => true,
        'value' => $value
    ]); 
    
        } catch(Exception $e){
            return response([
                'message' => $e->getMessage(),
                'status' => 'False',
            ]);
        }
    }
}
