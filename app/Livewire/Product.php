<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Actions\Webshop\AddProductVariantToCart;

class Product extends Component
{
    public $product_id;
    public $variants;
    public $variant_id;
    public $images;
    public $rules = [
        'variant_id' => ['required', 'exists:\App\Models\ProductVariants,id']
    ];

    public function addToCart(AddProductVariantToCart $cart) {
        // $this->validate();
        dd(["in addtoCart", $cart]);
        $cart->add($this->variant_id);
        $this->banner("Your product has been added to your cart");
        dd(["in function addToCart",$this,$_SERVER]);
    }
    public function mount($product_id) {
        $this->variants = DB::table('product_variants')->where('product_id', $product_id)->get();
        $this->images = DB::table('images')->where('product_id', $product_id)->get();
        $this->variant_id = $this->product->productVariants()->first()->id;
    }
    public function getProductProperty() {
        return \App\Models\Product::findOrFail($this->product_id);
    }
    public function render() {
        return view("livewire.product");
     //   header('location: /store');
     //   die();
    }
}
