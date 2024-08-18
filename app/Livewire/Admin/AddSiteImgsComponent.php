<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class AddSiteImgsComponent extends Component
{
    use WithFileUploads;

    public $pending;
    public $favicon;

    public function saveFile($fileName) {

        // dd($fileName);

        if($fileName == 'pending') {
            $this->validate([
                'pending' => 'required|file',
            ]);
            $this->pending->storeAs('public/site-images', $fileName);
        }elseif ($fileName == 'favicon') {
            $this->validate([
                'favicon' => 'required|file',
            ]);
            $this->favicon->storeAs('public/site-images', $fileName);
        }

        $this->resetForm();
        $this->dispatch('fileSaved');
    }

    public function resetForm() {
        $this->pending = null;
        $this->favicon = null;
    }


    public function render()
    {
        return view('livewire.admin.add-site-imgs-component');
    }
}
