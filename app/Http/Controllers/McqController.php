<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gemini\Laravel\Facades\Gemini;

class McqController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'text_input' => 'required|string|min:10',
        ]);

 
        $result = Gemini::geminiPro()->generateContent('Hello');
         
        $result->text(); // Hello! How can I assist you today?
    }
}
