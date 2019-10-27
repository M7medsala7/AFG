<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AddNotificationToFirebaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $body;
    public $mode;
    public $itemId;
    public $userToken;
    public $extraData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $title, string $body, string $mode, int $itemId = null, string $userToken, array $extraData = [])
    {
        $this->title = $title;
        $this->body = $body;
        $this->mode = $mode;
        $this->itemId = $itemId;
        $this->userToken = $userToken;
        $this->extraData = $extraData;
    }
}
