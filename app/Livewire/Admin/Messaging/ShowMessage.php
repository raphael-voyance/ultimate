<?php

namespace App\Livewire\Admin\Messaging;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class ShowMessage extends Component
{
    #[Reactive]
    public array $message;

    //Dispatch
    public function dispatchContentActive($contentName): void {
        $this->dispatch('contentActive', $contentName);
    }

    public function render()
    {
        return view('livewire.admin.messaging.show-message');
    }

    //Functions
    public function remove($messageId) {
        Message::destroy($messageId);
        session()->flash('status', [
            'message' => 'Le message a été supprimé avec succès',
            'timer' => true,
            'type' => 'success'
        ]);
        $this->redirect('messagerie');
    }
}
