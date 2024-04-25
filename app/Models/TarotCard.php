<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarotCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'numberArcane', 'interpretationsForTirages', 'arcanePath'
    ];

    public $timestamps = false;
}
