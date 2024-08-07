<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AlAminFirdows\LaravelEditorJs\Facades\LaravelEditorJs;

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

    public function getBodyAttribute()
    {
        //dd($this->attributes['content']);
        if($this->attributes['content']) {
            // $i = htmlspecialchars_decode($this->attributes['content']);
            // dd(LaravelEditorJs::render($i));
            return LaravelEditorJs::render($this->attributes['content']);
        }
        return;
        
    }

    public function excerpt() {
        return Str::excerpt($this->content, '', $options = ['radius' => 350, 'omission' => '...']);
    }

    
}
