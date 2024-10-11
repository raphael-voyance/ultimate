<?php

namespace App\Http\Controllers\Galaxy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        // Récupérer les 4 dernières notifications de l'utilisateur connecté
        $notifications = auth()->user()->notifications()->get();
        // $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        // Retourner les notifications en format JSON
        return view('galaxy.notifications', compact('notifications'));
    }

    public function get()
    {
        // Récupérer les 4 dernières notifications de l'utilisateur connecté
        $notifications = auth()->user()->unreadNotifications()->latest()->take(4)->get();
        // $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        // Retourner les notifications en format JSON
        return response()->json($notifications);
    }

    public function markAllAsRead(Request $request)
    {
        // Marquer les notifications comme lues
        auth()->user()->unreadNotifications->markAsRead();

        // Retourner un message de succès
        return response()->json(['message' => 'Notifications marquées comme lues.']);
    }

    public function markAsRead(Request $request)
    {
        // dd($request->notificationId);
        $user = auth()->user();
        $notificationId = $request->notificationId;

        // Marquer la notifications comme lues
        //auth()->user()->unreadNotifications->markAsRead();

        $notification = $user->notifications()->where('id', $notificationId)->first();

        // return true;

        $notification->markAsRead();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read.']);
        } else {
            return response()->json(['message' => 'Notification not found.'], 404);
        }
    }


}
