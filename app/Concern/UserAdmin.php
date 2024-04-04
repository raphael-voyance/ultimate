<?php

namespace App\Concern;

use App\Models\User;

class UserAdmin {

    public function getUserAdmin() {
        return User::where('email', 'raaphel-praamaanik@outlook.com')->first();
    }

    public function getUserAdminId() {
        return User::where('email', 'raaphel-praamaanik@outlook.com')->first()->id;
    }

    public function getUserAdminEmail() {
        return User::where('email', 'raaphel-praamaanik@outlook.com')->first()->email;
    }

}
