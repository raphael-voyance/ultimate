<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDraw extends Model
{
    protected $table = 'user_draws';

    protected $fillable = [
        'user_id',
        'draw',
        'question',
        'feeling'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
