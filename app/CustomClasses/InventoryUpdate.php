<?php

namespace App\CustomClasses;

use App\Models\ProductVariants;

class InventoryUpdate implements \SplObserver {
    public function update($cart):void {
        $variant_id = $cart->variant_id;
        $variant = ProductVariants::findOrFail($variant_id);
        $variant->quantity -= 1;
        $variant->save();
    }
}

