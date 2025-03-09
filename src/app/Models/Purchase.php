<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'shipping_postal_code',
        'shipping_address',
        'shipping_building',
        'payment_method',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
