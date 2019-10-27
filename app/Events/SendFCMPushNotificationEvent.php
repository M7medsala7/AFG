<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SendFCMPushNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $body;
    public $mode;
    public $itemId;
    public $userIds;
    public $extraData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $title, string $body, string $mode, int $itemId = null, array $userIds, array $extraData = [])
    {
        $this->title = $title;
        $this->body = $body;
        $this->mode = $mode;
        $this->itemId = $itemId;
        $this->userIds = $userIds;
        $this->extraData = $extraData;
    }
}
