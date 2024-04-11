<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Storefront extends Component
{

    public function getProductsProperty() {
        return Product::query()->paginate(2);
    }

    public function render()
    {
        $heading = "Store";

        return view('livewire.storefront', [
            'heading' => $heading
        ]);
    }
}
