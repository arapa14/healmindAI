<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mood_Entrie extends Model
{
    protected $table = 'mood__entries';

    protected $fillable = [
        'user_id',
        'mood_date',
        'mood_score',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
