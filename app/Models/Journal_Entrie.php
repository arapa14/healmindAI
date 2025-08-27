<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal_Entrie extends Model
{
    protected $table = 'journal__entries';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_analyzed',
        'visibility',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function recomendations() {
        return $this->hasMany(Recomendation::class);
    }
}
