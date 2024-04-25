<?php

namespace App\Livewire;

use App\Models\CartItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ShoppingCartBadge extends Component
{
    public $itemCount;

    public function mount() {
        if (auth()->check()) {
            $user = auth()->user();
            $cart = DB::table('carts')->where('user_id',$user->id)->first();
        } else {
            $sessionId = Session::getId();
            $cart = DB::table('carts')->where('session_id', $sessionId)->first();
        }
        if (isset($cart)) {
            //   dd([$sessionId, $cart]);
            //    $items = DB::table('cart_items')->where('carts_id', $cart->id)->get();
            //$items = CartItems::where('carts_id', $cart->id)->get();
            $this->itemCount = CartItems::where('carts_id', $cart->id)->count();
        } else {
            $this->itemCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.shopping-cart-badge');
    }
}
