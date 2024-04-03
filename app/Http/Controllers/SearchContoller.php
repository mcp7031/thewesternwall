<?php

namespace App\Http\Controllers;
// note to self: found this interesting and might be useful
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc')
            ->with('category')
            ->when($request->category_id, function ($query) use ($request) {
                $query->whereIn('category_id', $request->category_id);
            })
            ->paginate(5);

        return view('product.index', compact('products','request'));
    }
}

