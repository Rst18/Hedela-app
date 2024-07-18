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

class DonnerParoleEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $reunion;
    /**
     * Create a new event instance.
     */
    public function __construct($reunion,$user)
    {
        $this->reunion = $reunion;
        $this->user = $user;
    }

    public function broadcastWith(){

        return[
            'currentUser'=>$this->user
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
           new Channel("reunion-".str_replace('/','-',$this->reunion['id']) )
        ];
    }
}
