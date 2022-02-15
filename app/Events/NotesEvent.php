<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Models\Notes;
use App\Models\User;
use App\Models\User_has_Notes;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotesEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notes;
    public $user;
    public $textnotes;

    public function __construct(Notes $notes, User $user, User_has_Notes $textnotes)
    {
        $this->user = $user;
        $this->notes = $notes;
        $this->textnotes = $textnotes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('rpg');
    }
}
