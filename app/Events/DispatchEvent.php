<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DispatchEvent implements ShouldBroadcast,ShouldBroadcastNow 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        private string $message;
    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }


    public function broadcastWith(){
        
        return[
            'hello'=>$this->message
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
       
        return [
            new Channel('dispatch-channel'),
        ];
    }
}
