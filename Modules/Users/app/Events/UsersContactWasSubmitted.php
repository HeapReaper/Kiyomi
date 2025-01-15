<?php

namespace Modules\Users\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UsersContactWasSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	
    public function __construct()
    {
        //
    }
	
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
