<?php

namespace App\Http\Controllers\Galaxy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        // Récupérer les 5 dernières notifications de l'utilisateur connecté
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        // Retourner les notifications en format JSON
        return response()->json($notifications);
    }
}
