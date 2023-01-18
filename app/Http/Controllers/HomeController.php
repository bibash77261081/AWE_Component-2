<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::id()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('products.index');
            }
            else{
                $categories = Category::orderBy('name', 'ASC')->get();
                return view('home.index', ['categories' => $categories]);
            }
        }
        else{
            return redirect()-> back();
        }
    }

    public function displayProducts(){
        $products = Product::orderBy('id', 'ASC')->paginate(6);
        return view('home.homeProducts', ['products' => $products]);
    }

    public function displayCategories(){
        $categories = Category::orderBy('name', 'ASC')->get();
                return view('home.categories', ['categories' => $categories]);
    }

}
