<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function registeredAt() {
        $dt = Carbon::parse($this->created_at)->locale('fr');
        return $dt->isoFormat('DD/MM/YYYY');
    }

    public function fullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function sexe() {
        if($this->profile->sexe == 'M') {
            return 'Homme';
        }
        if($this->profile->sexe == 'F') {
            return 'Femme';
        }
        if($this->profile->sexe == 'NB') {
            return 'Non binaire';
        }
        return false;
    }

    public function facturateAddress() {
        $contact = json_decode($this->profile->contact);

        if(isset($contact->address->facturation)) {
            $a = $contact->address->facturation->number_of_way . ', ';
            $a .= $contact->address->facturation->type_of_way . ' ';
            $a .= $contact->address->facturation->name_of_way;
            $a .= '<br>';
            $a .= $contact->address->facturation->postal_code . ' ';
            $a .= $contact->address->facturation->city;
            $a .= '<br>';
            $a .= $contact->address->facturation->country;

            return $a;
        }
        
        return false;
    }

    public function birthday() {
        if(!$this->profile->birthday) {
            return false;
        }
        $dt = Carbon::parse($this->profile->birthday)->locale('fr');
        return $dt->isoFormat('dddd D MMMM YYYY');
    }

    public function birthDateInformations() {
        $birthDateInformations = json_decode($this->profile->astrology);
        
        if(!$birthDateInformations) {
            return false;
        }

        $a = [];
        
        if(isset($birthDateInformations->city_of_birth)) {
           $a['city_of_birth'] = $birthDateInformations->city_of_birth;
        }
        if(isset($birthDateInformations->time_of_birth)) {
            $a['time_of_birth'] = $birthDateInformations->time_of_birth;
        }
        if(isset($birthDateInformations->native_country)) {
            $a['native_country'] = $birthDateInformations->native_country;
        }

        return $a;
    }

    public function phone() {
        $contact = json_decode($this->profile->contact);
        if(isset($contact->phone)) {
            return $contact->phone;
        }
        return false;
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

    public function invoices() :HasMany {
        return $this->hasMany(Invoice::class);
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
