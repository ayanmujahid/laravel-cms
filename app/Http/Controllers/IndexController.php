<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        // Logic for the home page
        return view('index')->with('title', 'Home'); // Assuming you have a home.blade.php view
    }
}
