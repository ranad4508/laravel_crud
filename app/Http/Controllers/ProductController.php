<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductController extends Controller
{
    //This method will show products page
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    //This method will show create product page
    public function create()
    {
        return view('products.create');
    }

    // This method will show added product page

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | min:3',
            'sku' => 'required | min:3',
            'price' => 'required | numeric',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        ///Insert Product in database
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        if ($request->image != "") {
            //Storing image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;//Unique image name
            //save image to products folder
            $image->move(public_path('uploads/products'), $imageName);
            //save image name in database
            $product->image = $imageName;
            $product->save();
        }


        return redirect()->route('products.index')->with('success', 'Products added successfully.');

    }

    // This method will edit a product page

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    // This method will update a product
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $rules = [
            'name' => 'required | min:3',
            'sku' => 'required | min:3',
            'price' => 'required | numeric',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        ///Update Product in database
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        if ($request->image != "") {

            //Delete old image if new selected
            File::delete(public_path('uploads/products/' . $product->image));
            //Storing image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;//Unique image name
            //save image to products folder
            $image->move(public_path('uploads/products'), $imageName);
            //save image name in database
            $product->image = $imageName;
            $product->save();
        }


        return redirect()->route('products.index')->with('success', 'Products updated successfully.');
    }

    // This method will delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        //Delete image
        File::delete(public_path('uploads/products/' . $product->image));

        //Delete product from database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
