<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TelegramPosts;

class SearchPosts extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.searchposts', [
                    'telegramposts' => TelegramPosts::where('title', $this->search)->get(),
        ]);
    }
}
