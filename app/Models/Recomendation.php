<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    protected $table = 'recomendations';

    protected $fillable = [
        'title',
        'source',
        'related_journal_id',
    ];

    public function relatedJournal()
    {
        return $this->belongsTo(Journal_Entrie::class, 'related_journal_id');
    }
}
