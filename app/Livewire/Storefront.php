<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Storefront extends Component
{
    use WithPagination;

    public $products;

    public function getProductsProperty() {
        return Product::query();
    }

    public function render()
    {
        $products = Product::query();
        $heading = "Store";
$products = $products->paginate(2);
        return view('livewire.storefront');
            /*
            , [
            'heading' => $heading,
            'products' => $products
        ]);
            */
    }
}
