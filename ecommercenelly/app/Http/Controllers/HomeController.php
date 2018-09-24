<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function admin(Request $req)
    { 
        return view('middleware')->withMessage("Admin");
        // $categories = Category::all();
        // return view('categories.indexC',compact('categories')); 
    }
    public function buyer()
    { 
        return view('middleware')->withMessage("Buyer"); 
    }
    public function seller()
    { 
        return view('middleware')->withMessage("Seller");
    }

}
