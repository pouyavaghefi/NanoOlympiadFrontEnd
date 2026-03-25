<?php

namespace App\Listeners;

use App\Events\CourseVisited;
use Carbon\Carbon;
use DB;

class RecordVisitor
{
    public function handle(CourseVisited $event)
    {
        $exists = DB::table('course_visitors')
            ->where('course_id', $event->courseId)
            ->where(function ($query) use ($event) {
                // Check by user_id if authenticated, or check by IP address
                if ($event->userId) {
                    $query->where('user_id', $event->userId);
                } else {
                    $query->where('ip_address', $event->ipAddress);
                }
            })
            ->whereDate('visited_at', Carbon::today())
            ->exists();

        if (!$exists) {
            // Record the visitor if not already recorded today
            DB::table('course_visitors')->insert([
                'course_id' => $event->courseId,
                'user_id' => $event->userId,
                'ip_address' => $event->ipAddress,
                'visited_at' => now(),
            ]);
        }
    }
}