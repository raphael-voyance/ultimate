<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['total_price', 'payment_invoice_token', 'appointment_id', 'user_id', 'ref', 'invoice_informations', 'status', 'payment_id'];

    protected $casts = [
        'invoice_informations' => 'json',
    ];

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }
}