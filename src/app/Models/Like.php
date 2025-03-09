<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function isLike($user_id, $item_id)
    {
        return (boolean)$this->where('user_id', $user_id)->where('item_id', $item_id)->first();
    }

    public function likeStore($user_id, $item_id) 
    {
        $this->user_id = $user_id;
        $this->item_id = $item_id;
        $this->save();

        return;
    }

    public function likeDestroy($like_id) 
    {
        return $this->where('id', $like_id)->delete();
    }
}
