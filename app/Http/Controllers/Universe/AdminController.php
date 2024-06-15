<?php

namespace App\Http\Controllers\Universe;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(): View {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        return view('universe.index');
    }
}
