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
    public $logo;

    public function saveFile($fileName)
    {
        if ($fileName == 'pending' && $this->pending) {
            Log::info('Pending file exists: ' . $this->pending->getClientOriginalName());
            $this->pending->storeAs('public/site-images', $fileName . '.jpg');
            toast()
                ->success('Image enregistrée avec succès.')
                ->pushOnNextPage();
            $this->dispatch('refreshPage');
        } elseif ($fileName == 'favicon' && $this->favicon) {
            Log::info('Favicon exists: ' . $this->favicon->getClientOriginalName());
            $this->favicon->storeAs('public/site-images', $fileName . '.ico');
            // Affiche un message de succès
            toast()
                ->success('Favicon enregistrée avec succès.')
                ->pushOnNextPage();
            $this->dispatch('refreshPage');
        }  elseif ($fileName == 'logo' && $this->logo) {
            Log::info('Logo exists: ' . $this->logo->getClientOriginalName());
            $this->logo->storeAs('public/site-images', $fileName . '.png');
            // Affiche un message de succès
            toast()
                ->success('Logo enregistrée avec succès.')
                ->pushOnNextPage();
            $this->dispatch('refreshPage');
        } else {
            // Affiche un message d'erreur
            toast()
                ->warning('L\'image n\'a pa pu s\'enregistrée.')
                ->pushOnNextPage();
            Log::error('L\'image n\'a pa pu s\'enregistrée.');
        }
    }

    public function render()
    {
        return view('livewire.admin.add-site-imgs-component');
    }
}