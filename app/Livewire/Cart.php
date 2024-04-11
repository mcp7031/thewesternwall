<?php

namespace App\Livewire;

use App\Patterns\Observer\Observer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $items;
    public $session_id;

    public $rules = [
        'variant_id' => ['required', 'exists:\App\Models\ProductVariants,id']
    ];
    public function mount() {
        $this->session_id = session()->getId();
        $this->cart = DB::table('carts')->where('session_id', $this->session_id)->first();
        if ($this->cart)
        $this->items = DB::table('cart_items')->where('carts_id', $this->cart->id)->get();
    }
    public function getCartItemsProperty() {
        return \App\Models\Carts::findOrFail($this->session_id);
    }

    public function render()
    {
        $heading = "Cart";

        return view('livewire.cart', [
            'heading' => $heading
        ]);
    }
}
