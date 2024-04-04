<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FlagMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'message_id'
    ];

    public function messages(): BelongsToMany {
        return $this->belongsToMany(Message::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(Message::class);
    }
}
