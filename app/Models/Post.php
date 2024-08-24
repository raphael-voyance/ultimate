<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
        'status',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

}
