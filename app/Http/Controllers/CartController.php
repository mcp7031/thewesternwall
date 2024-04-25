<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\ProductVariants;
use App\Models\Images;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Money\Money;
use Money\Currency;
use Money\MoneyParser;
use Throwable;

class CartController extends Controller {

    public $product_id;
    public $product;
    public $variants;
    public $variant_id;
    public $images;
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $totalp = 0;
        if (auth()->check()) {
            $user = auth()->user();
            $cart = DB::table('carts')->where('user_id',$user->id)->first();
        } else {
            $sessionId = Session::getId();
            $cart = DB::table('carts')->where('session_id', $sessionId)->first();
        }
        if (isset($cart)) {
            //    $items = DB::table('cart_items')->where('carts_id', $cart->id)->get();
            $items = CartItems::where('carts_id', $cart->id)->get();
            $paginatedItems = CartItems::where('carts_id', $cart->id)->paginate(3);
           //    dd([$sessionId, $cart, $items]);
            foreach ($items as $item) {
                $variant = \App\Models\ProductVariants::findOrFail($item->product_variants_id);
                $product = \App\Models\Product::findOrFail($variant->product_id);
                $totalp += $item->quantity * $product->price->getAmount();
            }
            foreach ($paginatedItems as $item) {
                $variant = \App\Models\ProductVariants::findOrFail($item->product_variants_id);
                $product = \App\Models\Product::findOrFail($variant->product_id);
                $this->variants[] = $variant;
                $this->product[] = $product;
            }
            //dd([$items, $this->variants]);
            return view('cart.index', [
                'heading' => 'Cart',
                'carts' => $cart,
                'items' => $paginatedItems,
                'variants' => $this->variants,
                'totalp' => new Money($totalp, new currency('NZD'))
            ]);
        }
        header('location: /store');
        die();
    }

    public function show() {
        //    parse_str($_SERVER['REQUEST_URI'],$result);
        $result = explode('/',$_SERVER['REQUEST_URI']);
        $this->product_id = end($result);
        //dd([$result, $_SERVER]);
        $this->product = \App\Models\Product::findOrFail($this->product_id);
        $this->variants = DB::table('product_variants')->where('product_id', $this->product_id)->get();
        $this->images = DB::table('images')->where('product_id', $this->product_id)->get();
        $this->variant_id = $this->product->productVariants()->first()->id;
        return view('store.product', [
            'product' => $this->product
        ]);

        header('location: /store');
        die();
    }


    public function destroy() {

        $id = $_POST['id'];
        $prod_deleted = false;
        $product_variant = ProductVariants::firstWhere('id', $id);
        $product_id = $product_variant->product_id;
        if (ProductVariants::where('product_id', $product_id)->count() == 1 ) {
            $result = $this->delVariant($product_variant);
            $product = Product::firstWhere('id', $product_id);
            $result = $this->delProduct($product);
        } else {
            $result = $this->delVariant($product_variant);
        }
        /*
        if ($prod_deleted) {
            return response()->json([
                'message' => 'Variant records deleted successfully.',
                'variant' => $product_variant,
                'product' => $product,
            ],201);
        } else {
            return response()->json([
                'message' => 'Variant records deleted successfully.',
                'variant' => $product_variant,
            ],201);
        }
*/
        header('location: /inventory');
        die();
    }

    public function edit() {
        $errors = [];
        $id = $_GET['id'];
        $variant = ProductVariants::where('id', $id)->first();
        $images = DB::table('images')->where('product_variants_id', $id)->get();
        //   $images = $variant->images->all();
        //   dd($images);
        $product_id = $variant->product_id;
        $name = $variant->product->name;
        $description = $variant->product->description;
        $attribute = $variant->attribute;
        $price = $variant->product->price;
        $quantity = $variant->quantity;

        return view("inventory.edit", [
            'heading' => 'Edit Product',
            'product_id' => $product_id,
            'id' => $id,
            'errors' => $errors,
            'name' => $name,
            'description' => $description,
            'attribute' => $attribute,
            'price' => $price,
            'quantity' => $quantity,
            'images' => $images
        ]);
        header('location: /inventory');
        die();
    }

    public function store() {
        $errors = [];
        // put in a validator for contents
        if (! empty($errors)) {
            return view("inventory.create", [
                'heading' => 'Create Product',
                'errors' => $errors
            ]);
        }
        $id = $_POST['id'] ?? '';   // will not be defined for new Product
        $product_variant_id = $_POST['product_variant_id'] ?? '';
        if ($_SERVER['REQUEST_URI'] == '/invariant') {
            $product = Product::find($id);
            ProductVariants::create([
                'product_id' => $id,
                'attribute' => $_POST['attribute'],
                'quantity' => $_POST['quantity']
            ]);
        } else {
            $product = Product::updateOrCreate([
                'id' => $id ],[
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price']
                ]);
            ProductVariants::updateOrCreate([
                'id' => $product_variant_id ],[
                    'product_id' => $product->id,
                    'attribute' => $_POST['attribute'],
                    'quantity' => $_POST['quantity']
                ]);
        }
        /*
        return response()->json([
            'message' => 'Product and Variant records create/updated successfully.',
            'product' => $product,
            'variant' => $product_variant,
        ],201);
*/
        header('location: /inventory');
        die();
    }

}
