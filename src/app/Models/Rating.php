<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluator_id',
        'evaluated_id',
        'item_id',
        'score',
    ];

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function evaluated()
    {
        return $this->belongsTo(User::class, 'evaluated_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function ratingStore($evaluator_id, $evaluated_id, $item_id, $score)
    {
        $this->evaluator_id = $evaluator_id;
        $this->evaluated_id = $evaluated_id;
        $this->item_id = $item_id;
        $this->score = $score;
        $this->save();
    }
}
