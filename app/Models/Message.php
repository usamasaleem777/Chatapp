<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // ✅ Add receiver_id to fillable for mass assignment
    protected $fillable = ['user_id', 'receiver_id', 'message'];

    // ✅ Sender relationship
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ Receiver relationship
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
