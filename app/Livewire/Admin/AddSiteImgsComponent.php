<?php

// namespace App\Livewire\Admin;

// use Livewire\Component;
// use Livewire\Attributes\On;
// use Livewire\WithFileUploads;

// class AddSiteImgsComponent extends Component
// {
//     use WithFileUploads;

//     public $pending;
//     public $favicon;

//     public function saveFile($fileName) {
//         if ($fileName == 'pending' && $this->pending) {
//             $this->pending->storeAs('public/site-images', $fileName . '.jpg');
//         } elseif ($fileName == 'favicon' && $this->favicon) {
//             $this->favicon->storeAs('public/site-images', $fileName . '.ico');
//         } else {
//             dd('erreur');
//         }
    
//         $this->resetForm();
//         $this->dispatch('fileSaved');
//     }

//     public function resetForm() {
//         $this->pending = null;
//         $this->favicon = null;
//     }


//     public function render()
//     {
//         return view('livewire.admin.add-site-imgs-component');
//     }
// }



namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

use Livewire\WithFileUploads;

class AddSiteImgsComponent extends Component
{
    use WithFileUploads;

    public $pending;
    public $favicon;

    public function saveFile($fileName)
    {
        if ($fileName == 'pending' && $this->pending) {
            Log::info('Pending file exists: ' . $this->pending->getClientOriginalName());
            $this->pending->storeAs('public/site-images', $fileName . '.jpg');
            $this->dispatch('fileSaved');
            $this->dispatch('refreshPage');
        } elseif ($fileName == 'favicon' && $this->favicon) {
            Log::info('Favicon exists: ' . $this->favicon->getClientOriginalName());
            $this->favicon->storeAs('public/site-images', $fileName . '.ico');
            $this->dispatch('fileSaved');
            $this->dispatch('refreshPage');
        } else {
            Log::error('No file was uploaded.');
        }
    }

    public function render()
    {
        return view('livewire.admin.add-site-imgs-component');
    }
}