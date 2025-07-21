<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'sender_id',
        'message',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function chatMessageStore($chat_id, $sender_id, $chatMessage, $dir, $file_name)
    {
        $this->chat_id = $chat_id;
        $this->sender_id = $sender_id;
        $this->message = $chatMessage;
        $this->image = 'storage/' . $dir . '/' . $file_name;
        $this->save();
    }
}
