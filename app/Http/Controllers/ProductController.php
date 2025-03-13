<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //show product page
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view("products.list", ["products" => $products]);
    }
    //show create product page
    public function create()
    {
        return view("products.create");
    }
    //insert product
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            "name" => "required|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric"
        ];
        if ($request->image != "") {
            $rules["image"] = "image";
        }


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route("products.create")->withInput()->withErrors($validator);
        }
        //dd() stands for Dump and Die.
        //It's a helper function in Laravel (and many other PHP frameworks) used for debugging purposes.
        //dd() will output the contents of that variable.
        //After dumping the contents, it stops the script execution, so no further code will run.
        // dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();
        if ($request->image != "") {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route("products.index")->with("success", "Product added successfully.");
    }
    //show edit product page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view("products.edit", ["product" => $product]);
    }
    //update product
    public function update($id, Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);
        $rules = [
            "name" => "required|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric"
        ];
        if ($request->image != "") {
            $rules["image"] = "image";
        }


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route("products.edit", $product->id)->withInput()->withErrors($validator);
        }
        //dd() stands for Dump and Die.
        //It's a helper function in Laravel (and many other PHP frameworks) used for debugging purposes.
        //dd() will output the contents of that variable.
        //After dumping the contents, it stops the script execution, so no further code will run.
        // dd($request->all());

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();
        if ($request->image != "") {
            //delete old image
            File::delete(public_path('uploads/products/' . $product->image));
            //store new edited image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route("products.index")->with("success", "Product updated successfully.");
    }
    //delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        //delete image
        File::delete(public_path('uploads/products/' . $product->image));
        $product->delete();
        return redirect()->route("products.index")->with("success", "Product deleted successfully.");
    }
}