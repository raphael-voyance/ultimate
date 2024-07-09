<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numerology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'number', 'interpretations'
    ];

    public $timestamps = false;
}
