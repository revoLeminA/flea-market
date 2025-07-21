<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'receiver_id',
        'message_count',
        'is_read',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function chatNotificationStore($chat_id, $receiver_id, $message_count)
    {
        $this->chat_id = $chat_id;
        $this->receiver_id = $receiver_id;
        $this->message_count = $message_count;
        $this->is_read = false;
        $this->save();
    }
}
