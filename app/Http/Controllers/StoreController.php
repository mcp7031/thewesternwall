<?php

namespace App\Http\Controllers;

use App\Actions\Webshop\AddProductVariantToCart;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Images;
use Illuminate\Support\Facades\DB;
use Throwable;

// Areas of Concern (Categories)

class StoreController extends Controller {

    public $product_id;
    public $product;
    public $variants;
    public $variant_id;
    public $images;
    /**
     * Display a listing of the resource.
     */
    public function index() {
        /*
        $mergedData=[];
        $productList=[];
        $variantList=[];
        $imageList=[];
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            $product_id = $product->id;
            $productList[$product_id] = $product;
            $variants = DB::table('product_variants')->where('product_id', $product->id)->get();
            foreach ($variants as $variant) {
                $variant_id = $variant->id;
                $variantList[$variant_id] = $variant;
                $images = DB::table('images')->where('product_variants_id', $variant->id)->get();
                foreach ($images as $image) {
                    if($image->featured) {
                        $image_id = $image->id;
                        $imageList[$image_id] = $image;
                    }
                }
            }
        }
        //dd($mergedData);
        return view('store.index', [
            'heading' => 'Store',
            'products' => $productList,
            'variants' => $variantList,
            'images' => $imageList
        ]);
*/
        return view('store.index', [
            'heading' => 'Store',
            'products' => Product::orderBy('name')->paginate(2)
        ]);
        header('location: /store');
        die();
    }

    public function show() {
        //    parse_str($_SERVER['REQUEST_URI'],$result);
        $result = explode('?',$_SERVER['REQUEST_URI']);
        $this->product_id = end($result);
   //     dd([$result, $_SERVER]);
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

    public function delProduct($product): bool {
        try {
            $product->delete();
        } catch (Throwable $e) {
            report("Product not deleted: ".$product . $e);
            return false;
        }
        return true;
    }
    public function delVariant($variant): bool {
        try {
            $variant->delete();
        } catch (Throwable $e) {
            report("Product Variant not deleted: ".$variant .$e);
            return false;
        }
        return true;
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

    public function create(AddProductVariantToCart $cart) {

        $errors = [];
        $this->variant_id = $_POST['id'];
        $cart->add($this->variant_id);
   //     $this->banner("Your product has been added to your cart");
   //     dd(["in create", $cart, $_POST]);
        //    'product_variants' => ProductVariants::orderBy('product_id')->with('product')->paginate(4)
        /*
        $variant = ProductVariants::where('id', $id)->first();
        $images = DB::table('images')->where('product_variants_id', $id)->get();
        //   dd($variant);
        $product_id = $variant->product_id;
        $name = $variant->product->name;
        $prod_desc = $variant->product->description;
        $attribute = $variant->attribute;
        $price = $variant->product->price;
        $quantity = $variant->quantity;

        return view("inventory.show", [
            'heading' => 'Show Product',
            'id' => $id,
            'product_id' => $product_id,
            'errors' => $errors,
            'name' => $name,
            'prod_desc' => $prod_desc,
            'attribute' => $attribute,
            'price' => $price,
            'quantity' => $quantity,
            'images' => $images
        ]);
        header('location: /inventory');
        die();
*/
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
