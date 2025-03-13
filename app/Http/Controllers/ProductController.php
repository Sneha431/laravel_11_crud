<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //show product page
    public function index() {}
    //show create product page
    public function create()
    {
        return view("products.create");
    }
    //insert product
    public function store(Request $request)
    {
        $rules = [
            "name" => "required|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route("products.create")->withInput()->withErrors($validator);
        }
        //dd() stands for Dump and Die.
        //It's a helper function in Laravel (and many other PHP frameworks) used for debugging purposes.
        //dd() will output the contents of that variable.
        //After dumping the contents, it stops the script execution, so no further code will run.
        dd($request->all());
    }
    //show edit product page
    public function edit() {}
    //update product
    public function update() {}
    //delete product
    public function delete() {}
}