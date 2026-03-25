<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseVisited
{
    use SerializesModels;

    public $courseId;
    public $userId;
    public $ipAddress;

    public function __construct($courseId, $userId, $ipAddress)
    {
        $this->courseId = $courseId;
        $this->userId = $userId;
        $this->ipAddress = $ipAddress;
    }
}