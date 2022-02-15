<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Maps;
use App\Models\User;
use App\Models\Session;

class MapEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $maps;
    public $gracz;

    public function __construct(Maps $maps, User $gracz)
    {
        $this->maps = $maps;
        $this->gracz = $gracz;
        

    }

    public function broadcastOn()
    {
        return new PresenceChannel('rpg');
    }
}
