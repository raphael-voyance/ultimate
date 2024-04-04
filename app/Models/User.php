<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements Searchable, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * Function for initialise Serchable
     *
     */
    public function getSearchResult(): SearchResult
     {
         return new SearchResult(
            $this,
            $this->first_name,
         );
     }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function fullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function hasRole(string $role) {
        if($this->roles->contains('name', $role) || $this->roles->contains('slug', $role)) {
            return true;
        }
        return false;
    }

    public function profile() :HasOne {
        return $this->hasOne(UserProfile::class);
    }

    public function roles() :BelongsToMany {
        return $this->belongsToMany(Role::class);
    }

    public function received_messages(): HasMany {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function sent_messages(): HasMany {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
