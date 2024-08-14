<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class DataTableCategories extends Component
{
    use WithPagination;
    public $headers;

    public function mount() {
    
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Nom'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
    }

    public function render()
    {
        return view('livewire.admin.data-table-categories');
    }
}
