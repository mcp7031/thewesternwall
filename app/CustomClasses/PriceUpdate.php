<?php

namespace App\CustomClasses;

class PriceUpdate implements \SplObserver {
    public function update($cart):void {
        print_r("price update " . $cart);
    }
}

