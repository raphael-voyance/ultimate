<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class DataTablePosts extends Component
{
    use WithPagination;
    public $headers;

    public function mount() {
    
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'thumbnail', 'label' => 'Image à la une'],
            ['key' => 'title', 'label' => 'Titre'],
            ['key' => 'excerpt', 'label' => 'Description'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
    }

    public function deletePost($id) {
        $post = Post::where('id', $id)->firstOrFail();
        $post->delete();
    }

    public function render()
    {
        return view('livewire.admin.data-table-posts');
    }
}
