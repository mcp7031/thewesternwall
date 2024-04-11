<?php

namespace App\CustomClasses;

class InventoryUpdate implements \SplObserver {
    public function update($cart):void {
        dd(["inventory update ", $cart]);
    }
}

