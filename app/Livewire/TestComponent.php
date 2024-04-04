<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Modelable;
use Illuminate\Support\Facades\Auth;

class TestComponent extends Component
{
    public $query;
    public array $messages = [];
    public $selectedIndex = 0;

    // public function incrementIndex()
    // {
    //     if ($this->selectedIndex === (count($this->messages) - 1))
    //     {
    //         $this->selectedIndex = 0;
    //         return;
    //     }

    //     $this->selectedIndex++;
    // }

    // public function decrementIndex()
    // {
    //     if ($this->selectedIndex === 0)
    //     {
    //         $this->selectedIndex = count($this->messages) - 1;
    //         return;
    //     }

    //     $this->selectedIndex--;
    // }

    // public function selectIndex()
    // {
    //     if ($this->messages) {
    //         $this->redirect(route('admin.messaging', $this->messages[$this->selectedIndex]['id']));
    //     }
    // }

    // public function resetIndex()
    // {
    //     $this->reset('selectedIndex');
    // }

    public function updatedQuery()
    {
        $this->resetIndex();

        $words = '%' . $this->query . '%';

        if (strlen($this->query) >= 2) {
            $this->messages = Message::where('content', 'like', $words)->get()->toArray();
        }
    }

    public function searchQuery()
    {
        $this->resetIndex();

        $words = '%' . $this->query . '%';

        if (strlen($this->query) >= 2) {
            $this->messages = Message::where('content', 'like', $words)->get()->toArray();
        }
    }
    // public function render()
    // {
    //     return view('livewire.search', [
    //         'messages' => $this->messages
    //     ]);
    // }

    public function render()
    {
        return view('livewire.test-component', [
                    'messages' => $this->messages
                ]);
    }
}
