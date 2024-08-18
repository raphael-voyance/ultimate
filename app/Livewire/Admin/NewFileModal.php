<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewFileModal extends Component
{
    use WithFileUploads;

    public $btnMd;
    public $newFileModal = false;
    public $allFolders;
    public $folder;
    public $file;

    public function mount() {
        $this->allFolders = cache()->remember('all_folders', 3600, function () {
            return $this->getAllFolders();
        });
    }

    public function openModal() : void {
        $this->newFileModal = true;
    }

    private function getAllFolders() {
        $folders = Storage::allDirectories();
        return $folders;
    }

    public function saveFile() {
        $this->validate([
            'folder' => 'required|string',
            'file' => 'required|file',
        ]);
        
        $this->file->storeAs($this->folder, $this->file->getClientOriginalName());

        $this->resetForm();
        $this->newFileModal = false;
        $this->dispatch('fileSaved');
    }

    public function resetForm() {
        $this->folder = null;
        $this->file = null;
    }

    public function render()
    {
        return view('livewire.admin.new-file-modal');
    }
}