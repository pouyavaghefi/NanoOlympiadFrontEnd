<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleQuestionController extends Controller
{
    public function index()
    {
        return view('courses.sample_questions.index');
    }
}
