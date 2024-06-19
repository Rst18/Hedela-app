<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
// use Laravel\Reverb\Protocols\Pusher\Channels\PresenceChannel;

class Hello implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $is_onLine;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->is_onLine = $is_onLine;
    }
    public function broadcastWith(){
       
        return[
            // 'hello'=>'there',
            // 'isOn'=> $this->is_onLine
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       
        return new PresenceChannel('presence-channel');
    }
}
