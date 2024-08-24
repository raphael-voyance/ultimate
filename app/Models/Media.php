<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'file_name', 'mime_type', 'disk', 'file_properties',
    ];

    protected $casts = [
        'file_properties' => 'array',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
