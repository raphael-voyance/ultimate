<?php

namespace App\Http\Controllers\Universe;

use App\Models\Message;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class MessagingController extends Controller
{
    public function index(): View {
        // Messages reçus
        $received_messages = Message::where('receiver_id', auth()->user()->id)->orderBy('created_at')->get();

        // Messages envoyés
        $sent_messages = Message::where('sender_id', auth()->user()->id)->orderBy('created_at')->get();

        // Messages marqués

        // Réponses

        // dd(
        //     ['Boite de réception', $received_messages],
        //     ['Messages envoyés', $sent_messages]);

        return view('universe.messaging', [
            'sent_messages' => array_reverse($sent_messages->toArray()),
            'received_messages' => array_reverse($received_messages->toArray()),
        ]);
    }
}
