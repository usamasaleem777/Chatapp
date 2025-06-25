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

    protected $listeners = ['privateMessageReceived' => '$refresh'];

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
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

        broadcast(new MessageSent(Auth::user(), $this->selectedUser->id, $this->message))->toOthers();

        $this->chatMessages->push($msg);
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
