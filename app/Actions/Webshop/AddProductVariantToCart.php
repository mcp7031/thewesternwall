<?php

namespace App\Actions\Webshop;

use App\Models\Carts;

class AddProductVariantToCart {

    public function add($variant_id) {

   //     dd(["in AddProductVariantToCart", $variant_id]);
        $cart = new Carts();
        $cart->addItem($variant_id);
        header('location: /store');
        die();
    }
}
