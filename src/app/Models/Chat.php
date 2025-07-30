<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'item_id',
        'is_completed',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function notifications()
    {
        return $this->hasMany(ChatNotification::class);
    }

    public function chatStore($buyerId, $sellerId, $itemId)
    {
        $this->buyer_id = $buyerId;
        $this->seller_id = $sellerId;
        $this->item_id = $itemId;
        $this->is_completed = false;
        $this->save();
    }
}
