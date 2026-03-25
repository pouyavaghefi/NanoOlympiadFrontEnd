<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Illuminate\Http\JsonResponse;
use App\Models\EpisodeBugReport;
use App\Models\Episode;
use Illuminate\Support\Facades\Cache;
class EpisodeController extends Controller
{
    public function like($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            Alert::info('Login Required', 'You must be logged in to react to episodes.');
            return redirect()->back();
        }

        $this->storeReaction($id, 'like');
        return back()->with('success', 'You liked this episode.');
    }

    public function dislike($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            Alert::info('Login Required', 'You must be logged in to react to episodes.');
            return redirect()->back();
        }

        $this->storeReaction($id, 'dislike');
        return back()->with('success', 'You disliked this episode.');
    }

    protected function storeReaction($episodeId, $reactionType)
    {
        $existingReaction = \App\Models\EpisodeReaction::where('episode_id', $episodeId)
            ->where('user_id', $userId)
            ->first();


        if ($existingReaction) {
            if ($existingReaction->reaction === $reactionType) {
                return back()->with('info', 'You have already reacted to this episode.');
            }

            $existingReaction->update(['reaction' => $reactionType]);
        } else {
            \App\Models\EpisodeReaction::create([
                'episode_id' => $episodeId,
                'user_id' => $userId,
                'reaction' => $reactionType
            ]);
        }
    }
    public function reportBug($episodeSlug, Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => 'unauthenticated',
                'message' => 'Please login to submit a bug report'
            ], 401);
        }

        $validated = $request->validate([
            'report' => 'required|string|min:10|max:1000',
        ]);

        try {
            $episode = Episode::where('slug', $episodeSlug)->firstOrFail();
            $userId = Auth::id();

            $cacheKey = "bug_report_{$userId}_{$episode->id}";

            if (Cache::has($cacheKey)) {
                return response()->json([
                    'error' => 'duplicate',
                    'message' => 'You already submitted a bug report for this episode. Please wait 24 hours before submitting another.'
                ], 429);
            }

            EpisodeBugReport::create([
                'episode_id' => $episode->id,
                'user_id' => $userId,
                'report' => $validated['report'],
            ]);

            Cache::put($cacheKey, true, now()->addDay());

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your bug report!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'server_error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
