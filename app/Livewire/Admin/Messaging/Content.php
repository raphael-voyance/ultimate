<?php

namespace App\Livewire\Admin\Messaging;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class Content extends Component
{
    public $received_messages;
    public $sent_messages;
    public string $contentActive;
    public $message;

    //Listener
    #[On('contentActive')]
    // Permet d'afficher la vue correspondante
    public function showActiveContent($contentName): void
    {
        $this->contentActive = $contentName;
    }

    #[On('messageReceived')]
    //
    public function showContent($message): void
    {
        $this->message = $message;
    }

    #[On('messageDeleted')]
    // Permet d'afficher la vue correspondante
    public function refreshMessages(): void
    {
        $this->contentActive = '';
    }

    // Rendu
    public function render(): View
    {
        return view('livewire.admin.messaging.content');
    }
}
