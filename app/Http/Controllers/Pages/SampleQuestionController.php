<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleQuestionController extends Controller
{

    public function index(Request $request)
    {
        if ($this->isMobile($request)) {
            return redirect()->away(env('URL_MOBILE_VIEW') . '/sample-questions');
        }

        return view('courses.sample_questions.index');
    }

    protected function isMobile(Request $request): bool
    {
        $userAgent = $request->header('User-Agent');
        $mobileAgents = [
            'Mobile', 'Android', 'Silk/', 'Kindle', 'BlackBerry', 'Opera Mini', 'Opera Mobi', 'iPhone', 'iPad'
        ];

        foreach ($mobileAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true;
            }
        }

        return false;
    }
}
