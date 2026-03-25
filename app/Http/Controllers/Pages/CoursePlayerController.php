<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CourseValidationService;
use App\Services\EpisodeValidationService;
use App\Events\CourseVisited;
use App\Models\CourseVisitor;
use Illuminate\Support\Facades\Cache;
use DB;

class CoursePlayerController extends Controller
{
    protected $courseValidationService;
    protected $episodeValidationService;

    // Inject the services via constructor
    public function __construct(CourseValidationService $courseValidationService, EpisodeValidationService $episodeValidationService)
    {
        $this->courseValidationService = $courseValidationService;
        $this->episodeValidationService = $episodeValidationService;
    }

    public function showCourseEpisodes($slug)
    {
        try {
            $course = Cache::remember("course_{$slug}", now()->addMinutes(30), function () use ($slug) {
                return $this->courseValidationService->validateAndRetrieveCourse($slug);
            });

            $episodes = Cache::remember("course_{$course->id}_episodes", now()->addMinutes(30), function () use ($course) {
                return $this->episodeValidationService->retrieveEpisodesByCourse($course->id);
            });

            $play = $episodes->sortBy('episode_number')->first();

            event(new CourseVisited(
                $course->id,
                auth()->check() ? auth()->id() : null,
                request()->ip()
            ));

            if (!session()->has('viewed_course_' . $course->id)) {
                $course->increment('view_count');
                session()->put('viewed_course_' . $course->id, true);
            }

            if (!session()->has('viewed_episode_' . $play->id)) {
                $play->increment('view_count');
                session()->put('viewed_episode_' . $play->id, true);
            }

            return view('courses.player.index', [
                'course' => $course,
                'episodes' => $episodes,
                'play' => $play,
            ]);
        } catch (\Exception $e) {
            return abort(404, $e->getMessage());
        }
    }

    public function showCourseNextEpisode($slug, $epi)
    {
        try {
            $course = $this->courseValidationService->validateAndRetrieveCourse($slug);

            $play = $this->episodeValidationService->validateAndRetrieveEpisode($epi, $course->id);

            $episodes = $this->episodeValidationService->retrieveEpisodesByCourse($course->id);

            if (!session()->has('viewed_episode_' . $play->id)) {
                $episode_viewers = $play->view_count;
                $episode_new_viewers = $episode_viewers + 1;
                $play->view_count = $episode_new_viewers;
                $play->save();

                session()->put('viewed_episode_' . $play->id, true);
            }

            return view('courses.player.index', compact('course', 'episodes', 'play'));
        } catch (\Exception $e) {
            return abort(404, $e->getMessage());
        }
    }
}