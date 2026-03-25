<?php

// app/Http/Controllers/GlobeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobeController extends Controller
{
    public function show()
    {
        return view('globe');  // The view for the 3D globe
    }
}
