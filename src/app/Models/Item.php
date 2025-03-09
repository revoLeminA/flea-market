<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_name',
        'description',
        'price',
        'brand_name',
        'status',
        'item_image',
        'is_sold',
    ];

    public function user()
    {
        return $this->belongsTo(Like::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories');
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('item_name', 'like', '%' . $keyword . '%');
        }
    }

    public function itemStore($user_id, $data, $dir, $file_name)
    {
        $this->user_id = $user_id;
        $this->item_name = $data['item_name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->brand_name = $data['brand_name'];
        $this->status = $data['status'];
        $this->item_image = 'storage/' . $dir . '/' . $file_name;
        $this->is_sold = FALSE;
        $this->save();
    }
}
