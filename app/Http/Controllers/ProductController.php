<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('products', compact('products'));
    }

    // add product
    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products',
                'price' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Product Aready Exists',
                'price.required' => 'Price is required',
            ]
        );
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'status' => 'success',
        ]);
    }

    // update product
    public function updateProduct(Request $request)
    {
        $request->validate(
            [
                'update_name' => 'required|unique:products,name,' . $request->update_id,
                'update_price' => 'required',
            ],
            [
                'update_name.required' => 'Name is required',
                'update_name.unique' => 'Product Aready Exists',
                'update_price.required' => 'Price is required',
            ]
        );

        Product::where('id', $request->update_id)->update([
            'name' => $request->update_name,
            'price' => $request->update_price,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    // delete product
    public function deleteProduct(Request $request)
    {
        Product::find($request->product_id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    // pagination
    public function pagination(Request $request)
    {
        $products = Product::latest()->paginate(10);
        return view('products_pagination', compact('products'))->render();
    }

    // search product
    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search_string . '%')
            ->orwhere('price', 'like', '%' . $request->search_string . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($products->count() > 0) {
            return view('products_pagination',compact('products'))->render();
        }else{
            return response()->json([
                'status' => 'No data matched',
            ]);
        }
    }
}
