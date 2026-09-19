<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Events\MessageSent;

class Chat extends Component
{
    public $users;
    public $selectedUser = null;
    public $message = '';
    public $chatMessages = [];

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    public function getListeners()
    {
        return [
            'echo-private:chat.' . Auth::id() . ',.private.message.sent' => 'receiveMessage',
        ];
    }

    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);

        $this->chatMessages = Message::where(function ($q) use ($userId) {
            $q->where('user_id', Auth::id())
              ->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->where('receiver_id', Auth::id());
        })->with('sender')->orderBy('created_at')->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string'
        ]);

        $msg = Message::create([
            'user_id' => Auth::id(),
            'receiver_id' => $this->selectedUser->id,
            'message' => $this->message,
        ]);

        $msg->load('sender');

        broadcast(new MessageSent(
            Auth::user(),
            $this->selectedUser->id,
            $msg->id,
            $msg->message,
            $msg->created_at->toISOString()
        ))->toOthers();

        $this->chatMessages->push($msg);
        $this->message = '';
        $this->dispatchBrowserEvent('chat-message-sent');
    }

    public function receiveMessage($payload)
    {
        if (! $this->selectedUser || (int) $this->selectedUser->id !== (int) $payload['senderId']) {
            return;
        }

        $message = Message::with('sender')->find($payload['messageId']);

        if (! $message) {
            return;
        }

        $this->chatMessages->push($message);
        $this->dispatchBrowserEvent('chat-message-received');
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
