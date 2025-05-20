<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $commands = [
        \App\Console\Commands\GenerateSitemap::class,
    ];    
    //
}
