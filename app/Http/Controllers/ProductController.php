<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(7);
        
        return view('product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image:png,jpeg,jpg'
        ]);

        if($validator->passes()){
            //save data on database
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();

            //To save image on database
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/products/',$newFileName); //This will save images on the given folder as a $newFileName 
                $product->image = $newFileName;
                $product->save();
            }

            $request->session()->flash('success', 'Product Added Successfully');

            return redirect()->route('products.index');
        }
        else{
            //return error
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product = Product::findOrFail($product->id);

        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image:png,jpeg,jpg'
        ]);

        if($validator->passes()){
            //save data on database
            $product = Product::find($product->id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();

            //To save image on database
            if($request->image){
                $oldImage = $product->image;
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/products/',$newFileName); //This will save images on the given folder as a $newFileName 
                $product->image = $newFileName;
                $product->save();

                File::delete(public_path().'/uploads/products/'.$oldImage);
            }

            $request->session()->flash('success', 'Product Updated Successfully');

            return redirect()->route('products.index');
        }
        else{
            //return error
            return redirect()->route('products.edit', $product->id)->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
    }
}
