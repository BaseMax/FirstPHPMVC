<?php

namespace App\Controllers;

use App\Models\User;
use Core\View;

class HomeController
{
    public function index()
    {
        View::render('index', ['message' => 'Quera']);
    }
    
    public function testView()
    {
        View::render('index', ['message' => 'Hello, World!']);
    }
}
