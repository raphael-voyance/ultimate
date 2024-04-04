<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_email',
        'sender_id',
        'sender_first_name',
        'sender_last_name',
        'sender_phone',

        'receiver_email',
        'receiver_id',
        'receiver_first_name',
        'receiver_last_name',

        'content',
        'read',
        'subject'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'subject' => 'Vous avez reçu un nouveau message',
    ];

    public function sent_Messages() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function received_Messages() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
