<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Product extends Component
{
    public $product_id;
    public $variants;
    public $images;

    public function mount($product_id) {
        $this->variants = DB::table('product_variants')->where('product_id', $product_id)->get();
        $this->images = DB::table('images')->where('product_id', $product_id)->get();

    }
    public function getProductProperty() {
        return \App\Models\Product::findOrFail($this->product_id);
        return;
    }
    public function render() {
/*
        $errors[]="";
        $name = $this->product->name;
        $prod_desc = $this->product->description;
        $attribute = $this->variant->attribute;
        $price = $this->variant->product->price;
        $quantity = $this->variant->quantity;
        return view("livewire.product", [
            'heading' => 'Show Product',
            'id' => $this->variant->id,
            'product_id' => $product_id,
            'errors' => $errors,
            'name' => $name,
            'prod_desc' => $prod_desc,
            'attribute' => $attribute,
            'price' => $price,
            'quantity' => $quantity,
            'images' => $this->images
        ]);
            */
        return view("livewire.product");
        header('location: /store');
        die();
    }
}
