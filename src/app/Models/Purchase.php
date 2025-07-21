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
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchaseStore($user_id, $item_id, $data)
    {
        $this->user_id = $user_id;
        $this->item_id = $item_id;
        $this->shipping_postal_code = $data['shipping_postal_code'];
        $this->shipping_address = $data['shipping_address'];
        $this->shipping_building = $data['shipping_building'];
        $this->payment_method = $data['payment_method'];
        $this->save();
    }
}
