<?php

namespace App\Http\Controllers\Universe;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function editUser(Request $request): View {
        $user = User::where('id', $request->id)->firstOrFail()->load('profile');

        return view('universe.users.edit', [
            'user' => $user
        ]);
    }
}
