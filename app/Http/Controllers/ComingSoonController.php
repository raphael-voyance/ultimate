<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Concern\UserAdmin;
use Illuminate\Http\Request;
use App\Mail\ComingSoonSendEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ComingSoonFormRequest;

class ComingSoonController extends Controller
{
    private $userAdmin;

    public function __construct() {
        $this->userAdmin  = new UserAdmin;
    }

    public function index() {
        return view('coming-soon');
    }

    public function sendEmail(ComingSoonFormRequest $request) {
        $message = Message::create($request->all());
        if($message) {
            Mail::to($this->userAdmin->getUserAdmin())->send(new ComingSoonSendEmail($message));
            session()->flash('success', 'Votre message a bien été envoyé');
        }

        return redirect()->route('coming_soon');
    }
}
