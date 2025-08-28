<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = 'professionals';

    protected $fillable = [
        'user_id',
        'license',
        'specialty',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }
}
