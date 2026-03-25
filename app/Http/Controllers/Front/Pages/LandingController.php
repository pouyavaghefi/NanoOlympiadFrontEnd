<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Http\Request;
use App\Services\CourseValidationService;
use Illuminate\Support\Facades\DB;
use App\Models\Course\Course;

class LandingController extends FrontController
{
    public function index(CourseValidationService $courseService)
    {
        $partners = DB::table('partners')->get();
        $sliders = DB::table('sliders')->get();
        $courses = $courseService->retrieveValidCourses();
        $courseTranslations = DB::table('course_translations')->get()->keyBy('course_id');
        $enabledSections = DB::table('web_page_sections')
            ->where('page_id', 4)
            ->where('is_enabled', true)
            ->orderBy('priority', 'asc')
            ->pluck('section_name')
            ->toArray();

        return view('index', compact('partners','sliders','courses','enabledSections','courseTranslations'));
    }
}
