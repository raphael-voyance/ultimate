<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['birthday', 'avatar', 'sexe', 'numerology', 'astrology', 'tarology', 'contact'];

    public $timestamps = false;

    protected $casts = [
        'contact' => 'json',
    ];

    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }
}
