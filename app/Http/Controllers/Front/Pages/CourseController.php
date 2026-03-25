<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CourseValidationService;
use DB;
use App\Models\Course;
use Alert;
use Auth;
class CourseController extends Controller
{
    public function index(CourseValidationService $courseService)
    {
        $courses = $courseService->retrieveValidCourses();
        $courseTranslations = DB::table('course_translations')->get()->keyBy('course_id');

        return view('courses.all', compact('courses', 'courseTranslations'));
    }

    public function showCourse($slug)
    {
        $language_code = app()->getLocale();

        if($language_code !== "en"){
            $courseTranslated = DB::table('course_translations')->where('slug', $slug)->first();
            $course = DB::table('courses')->where('id', $courseTranslated->course_id)->first();
        }else{
            $course = DB::table('courses')->where('slug', $slug)->first();
        }

        if (!$course) {
            abort(404, 'Course not found');
        }

        $language_id = DB::table('languages')
            ->where('code', $language_code)
            ->first()->id;

        $courseTranslation = DB::table('course_translations')
            ->where('course_id', $course->id)
            ->where('language_id', $language_id)
            ->first();

        return view('courses.show', compact('course', 'courseTranslation'));
    }

    public function enroll(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $ip = $request->ip();

        if ($course->course_private == 1 && !Auth::check()) {
            Alert::error('Access Restricted', 'You must login to access this private course.');
            return redirect()->back();
        }

        // Track course visitors
        $this->trackCourseVisit($course->id, $ip);

        // Handle free course access
        if ($course->isFree()) {
            if ($course->course_private == 1 && !Auth::check()) {
                Alert::error('Access Restricted', 'You must login to access this private course.');
                return redirect()->back();
            }

            $playerUrl = "/courses/course-player/" . $course->slug;

            // Add token if user is logged in
            if (Auth::check()) {
                $token = DB::table('user_access_tokens')
                    ->where('user_id', Auth::id())
                    ->value('token');

                if ($token) {
                    $playerUrl .= "?auth_token=" . $token;
                }
            }

            return redirect("https://ino-official.org" . $playerUrl);
        }

        if (!Auth::check()) {
            Alert::warning('Login Required', 'You must be signed in to enroll.');
            return redirect()->back();
        }

        $userId = Auth::id();

        if ($this->isAlreadyEnrolled($course->id, $userId)) {
            Alert::info('Already Enrolled', 'You are already enrolled in this course.');
            return redirect()->back();
        }

        $this->registerUserForCourse($course->id, $userId, $course->price);

        Alert::success('Enrolled', 'You have successfully enrolled in the course.');
        return $this->redirectToProfileWithToken($userId);
    }

// Helper Methods
    protected function trackCourseVisit($courseId, $ip)
    {
        $table = 'course_visitors';
        $exists = Auth::check()
            ? DB::table($table)->where('course_id', $courseId)->where('user_id', Auth::id())->exists()
            : DB::table($table)->where('course_id', $courseId)->where('ip_address', $ip)->whereNull('user_id')->exists();

        if (!$exists) {
            DB::table($table)->insert([
                'course_id' => $courseId,
                'user_id' => Auth::id(),
                'ip_address' => $ip,
                'visited_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    protected function isAlreadyEnrolled($courseId, $userId)
    {
        return DB::table('course_registrations')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->exists();
    }

    protected function registerUserForCourse($courseId, $userId, $price)
    {
        DB::table('course_registrations')->insert([
            'course_id' => $courseId,
            'user_id' => $userId,
            'status' => ($price == 0) ? 'completed' : 'pending',
            'registered_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function redirectToProfileWithToken($userId)
    {
        $token = DB::table('user_access_tokens')
            ->where('user_id', $userId)
            ->value('token');

        if (!$token) {
            Alert::error('Error', 'Authentication token not found.');
            return redirect()->back();
        }

        return redirect("https://profile.nanolympiad.org/courses/registered_courses?auth_token=$token");
    }

}
