<?php

namespace App\Models;

use Illuminate\Support\Str;
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

    public function excerpt() {
        return Str::excerpt($this->content, '', $options = ['radius' => 350, 'omission' => '...']);
    }

    
}
