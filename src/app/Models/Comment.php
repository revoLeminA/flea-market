<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'content',
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

    public function isComment($user_id, $commentUser_id)
    {
        return (boolean)$this->where('user_id', $user_id)->where('user_id', $commentUser_id)->first();
    }

    public function commentStore($user_id, $data)
    {
        $this->user_id = $user_id;
        $this->item_id = $data['item_id'];
        $this->content = $data['content'];
        $this->save();

        return;
    }
}
