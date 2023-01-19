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
    public function index(Request $request)
    {
        if(Auth::id()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('products.index');
            }
            else{
                if($search_text = $request->search){
                    $products = Product::where('name','like','%'.$search_text.'%')->orderBy('name', 'ASC')->paginate(6);
                    return view('home.homeProducts', ['products' => $products]);
                }
                else{
                    $categories = Category::orderBy('name', 'ASC')->get();
                return view('home.index', ['categories' => $categories]);
                }
            }
        }
        else{
            return redirect()-> back();
        }
    }

    public function displayProducts(Request $request){
        if($search_text = $request->search){
            $products = Product::where('name','like','%'.$search_text.'%')->orderBy('name', 'ASC')->paginate(6);
        }
        else{
            $products = Product::orderBy('id', 'ASC')->paginate(6);
        }
        return view('home.homeProducts', ['products' => $products]);
    }

    public function displayCategories(Request $request){
        if($search_text = $request->search){
            $categories = Category::where('name','like','%'.$search_text.'%')->orderBy('name', 'ASC')->paginate(6);
        }
        else{
            $categories = Category::orderBy('name', 'ASC')->paginate(6);
        }
         return view('home.categories', ['categories' => $categories]);
    }

}
