<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $senderId;
    public $senderName;
    public $receiverId;
    public $messageId;
    public $message;
    public $createdAt;

    public function __construct(User $sender, $receiverId, $messageId, $message, $createdAt)
    {
        $this->senderId = $sender->id;
        $this->senderName = $sender->name;
        $this->receiverId = $receiverId;
        $this->messageId = $messageId;
        $this->message = $message;
        $this->createdAt = $createdAt;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    public function broadcastAs()
    {
        return 'private.message.sent';
    }
}
