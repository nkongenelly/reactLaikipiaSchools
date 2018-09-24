<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Category;
use App\Product;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Charts;
// 
class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        // dd("hallo");
        if($request->user() && $request->user()->usertype_id == '3'){
            $seller = $request->user()->id;
            $products = Product::where('user_id',$seller)->get();
            // $products = Product::all();
            // dd($products);
            // return redirect('home')->with('error','You do not have admin access');
            return new Response(view('products.indexP',compact('products'))->with('role','SELLER'));
        }
        return new Response(view('unauthorized')->with('role','SELLER'));
        // return $next($request); 
    }
}
