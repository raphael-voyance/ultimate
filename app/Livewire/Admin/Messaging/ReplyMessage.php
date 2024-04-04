<?php

namespace App\Livewire\Admin\Messaging;

use Livewire\Component;

class ReplyMessage extends Component
{
    public array $message;

    public function render()
    {
        return view('livewire.admin.messaging.reply-message');
    }
}
