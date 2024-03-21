<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TelegramPosts;

class Dropdown extends Component
{
    public $category = 'all';

    public function render()
    {
        if ($this->category == "all") {
            $ss = TelegramPosts::latest()->paginate(23);
        } else {
            $ss = TelegramPosts::where('aoc_id', $this->category)->latest()->paginate(5);
        }
        return view('livewire.dropdown', [
                    'telegramposts' => $ss
        ]);
    //    return ['telegramposts' => $ss];
    }
}
