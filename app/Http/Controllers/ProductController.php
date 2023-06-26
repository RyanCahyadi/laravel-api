<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use Auth;

class ProductController extends Controller
{

    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'price' =>  'required|numeric',
            'desc'  => 'max: 100',
            'brand_id'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $product = Product::create([
            'name'      =>  $request->name,
            'price'     =>  $request->price,
            'desc'      =>  $request->description,
            'brand_id'  =>  $request->brand_id
        ]);

        // $product = Product::create($request->all());

        var_dump($product);


        return response()->json([
            'message'   => 'Successfully created data',
            'data'      => $product
        ]);
    }

    public function getAllProduct()
    {
        // $products = Product::all();
        $products = Product::with('brand')->get();
        
        // var_dump($products);
        return response()->json([
            'message'   =>  'Successfully get data',
            'data'      => $products
        ]);
    }
    
    public function getProductId($id)
    {

        // $product = Product::findOrFail($id);
        $product = Product::with('brand')->findOrFail($id);

        return response()->json([
            'message'   =>  'Successfully get data',
            'data'      =>  $product
        ]);
    }

    public function updateProductId(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'price' =>  'required|numeric',
            'desc'  => 'max: 100',
            'brand_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $product = Product::find($id)->update([
            'name'      =>  $request->name,
            'price'     =>  $request->price,
            'desc'      =>  $request->description,
            'brand_id'  =>  $request->brand_id
        ]);

        return response()->json([
            'message'   => 'Successfully updated data',
            'data'      => $product
        ]);
    }

    public function deleteProductId($id)
    {
        $product = Product::find($id)->delete();

        return response()->json([
            'message'   => 'Successfully deleted data'
        ]);
    }

    public function searchProduct(Request $request)
    {
        // $product = Product::where('name', 'LIKE', '%'.$request->name.'%')->get();
        $product = Product::with('brand')->where('name', 'LIKE', '%'.$request->name.'%')->get();

        return response()->json([
            'message'   => 'Successfully searched data',
            'data'      => $product
        ]);
    }

}
