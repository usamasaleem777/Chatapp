<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $sender;
    public $receiverId;
    public $message;

    public function __construct(User $sender, $receiverId, $message)
    {
        $this->sender = $sender;
        $this->receiverId = $receiverId;
        $this->message = $message;
    }

    // 👇 Broadcast to a private channel: chat.{receiverId}
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    // 👇 Optionally name the event
    public function broadcastAs()
    {
        return 'private.message.sent';
    }
}
