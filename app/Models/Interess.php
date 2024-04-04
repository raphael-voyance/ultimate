<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Interess extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'desired_time',
        'distribution',
        'thumbnail'
    ];

    public function activities(): HasMany {
        return $this->hasMany(Activity::class);
    }
}


