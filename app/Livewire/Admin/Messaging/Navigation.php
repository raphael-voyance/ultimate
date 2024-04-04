<?php

namespace App\Livewire\Admin\Messaging;

use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Arr;

class Navigation extends Component
{
    // Pagination
    public $itemsPerPage = 5;
    // Messages
    // Messages reçus
    public $totalReceivedPage;
    public $currentReceivedPage = 1;
    public $totalReceivedMessage;
    public $received_messages;
    public $receivedMessagesOnPage;
    public string $orderReceivedMessages = 'ASC';

    //Messages lus
    public $messageReadStates = [];

    // Messages envoyés
    public $totalSentPage;
    public $currentSentPage = 1;
    public $totalSentMessage;
    public $sent_messages;
    public $sentMessagesOnPage;
    public string $orderSentMessages = 'ASC';

    // Recherche
    public string $query;
    public array $searchResults = [];

    // Mount()
    public function mount(): void
    {
        $this->messageReadStates = Message::where('receiver_id', auth()->user()->id)->pluck('read', 'id')->toArray();

        $this->getReceivedMessagesOnPage();
        $this->totalReceivedMessage = count($this->received_messages);
        $this->totalReceivedPage = ceil($this->totalReceivedMessage / $this->itemsPerPage);

        $this->getSentMessagesOnPage();
        $this->totalSentMessage = count($this->sent_messages);
        $this->totalSentPage = ceil($this->totalSentMessage / $this->itemsPerPage);
    }

    // Dispatch()
    public function dispatchMessage($messageId): void {
        $message = Message::where('id', $messageId)->first();

        $this->markAsRead($message);

        $this->dispatchContentActive('show-message');
        $this->dispatch('messageReceived', $message);
    }

    public function dispatchContentActive($contentName): void {
        $this->dispatch('contentActive', $contentName);
    }

    // Functions()

    // Fonctions de Recherche des messages
    public function searchQuery()
    {

        $words = '%' . $this->query . '%';

        //Recupérer les messages de l'utilisateur connecté

        if (strlen($this->query) >= 2) {
            $this->searchResults = Message::where('content', 'like', $words)
                ->orWhere('sender_email', 'like', $words)
                ->orWhere('receiver_email', 'like', $words)
                ->orWhere('subject', 'like', $words)
                ->orWhere('receiver_first_name', 'like', $words)
                ->orWhere('receiver_last_name', 'like', $words)
                ->orWhere('sender_first_name', 'like', $words)
                ->orWhere('sender_last_name', 'like', $words)
                ->get()->toArray();
            if(count($this->searchResults) == 0) {
                $this->searchResults = ['No result'];
            }
        }
    }

    public function resetQuery() {
        $this->searchResults = [];
        $this->query = '';
    }


    // Gestion des messages reçus
    public function getReceivedMessagesOnPage()
    {
        $startIndex = ($this->currentReceivedPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;

        $this->receivedMessagesOnPage = array_slice($this->received_messages, $startIndex, $this->itemsPerPage, true);

        foreach($this->receivedMessagesOnPage as $k => $m) {
            $r = $m['read'];
            $this->receivedMessagesOnPage[$k]['read'] = $r;
        }
    }

    public function markAsRead($message):void {
        if($message && !$message->read) {
            $message->update([
                'read' => true
            ]);
            $this->messageReadStates[$message->id] = true;
        }
    }

    public function descReceivedMessages()
    {
        $startIndex = ($this->currentReceivedPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;

        $this->receivedMessagesOnPage = array_slice(array_reverse($this->received_messages), $startIndex, $this->itemsPerPage, true);


        foreach($this->receivedMessagesOnPage as $k => $m) {
            $r = $m['read'];
            $this->receivedMessagesOnPage[$k]['read'] = $r;
        }

        $this->orderReceivedMessages = 'DESC';
    }

    public function ascReceivedMessages()
    {
        $startIndex = ($this->currentReceivedPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;

        $this->receivedMessagesOnPage = array_slice($this->received_messages, $startIndex, $this->itemsPerPage, true);


        foreach($this->receivedMessagesOnPage as $k => $m) {
            $r = $m['read'];
            $this->receivedMessagesOnPage[$k]['read'] = $r;
        }

        $this->orderReceivedMessages = 'ASC';
    }

    public function nextReceivedPage()
    {
        if ($this->currentReceivedPage < $this->totalReceivedPage) {
            $this->currentReceivedPage++;
            $this->getReceivedMessagesOnPage();
        }
    }

    public function previousReceivedPage()
    {
        if ($this->currentReceivedPage > 1) {
            $this->currentReceivedPage--;
            $this->getReceivedMessagesOnPage();
        }
    }

    // Gestion des messages envoyés
    public function getSentMessagesOnPage()
    {
        $startIndex = ($this->currentSentPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;

        $this->sentMessagesOnPage = array_slice($this->sent_messages, $startIndex, $this->itemsPerPage, true);
    }

    public function descSentMessages()
    {
        $startIndex = ($this->currentSentPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;

        $this->sentMessagesOnPage = array_slice(array_reverse($this->sent_messages), $startIndex, $this->itemsPerPage, true);

        $this->orderSentMessages = 'DESC';
    }

    public function ascSentMessages()
    {
        $startIndex = ($this->currentSentPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;

        $this->sentMessagesOnPage = array_slice($this->sent_messages, $startIndex, $this->itemsPerPage, true);

        $this->orderSentMessages = 'ASC';
    }

    public function nextSentPage()
    {
        if ($this->currentSentPage < $this->totalSentPage) {
            $this->currentSentPage++;
            $this->getSentMessagesOnPage();
        }
    }

    public function previousSentPage()
    {
        if ($this->currentSentPage > 1) {
            $this->currentSentPage--;
            $this->getSentMessagesOnPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.messaging.navigation');
    }
}
