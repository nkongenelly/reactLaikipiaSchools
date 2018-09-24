<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Product;
use App\Category;
use Session;
use App\Cart;
use App\Feature;
use App\Order;
use App\FeatureProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Buyer
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
        if($request->user() && $request->user()->usertype_id == '1'){
            // return redirect('home')->with('error','You do not have admin access');$products = Product::where('product_status','1')
                    $products = Product::where([
                        ['product_status','1'],
                        ['Product_quantity','>','0'],
                        ])
                        ->get(); 
                        //  dd($products);
                        if(array($products)){
                        if($category_id = request('category_name')){
                        $productss = Category::find($category_id);
                        $products = $productss->products;
                        // dd($products);
                        }
                        foreach($products as $product){
                        $category = $product->category_id;
                        // $countproducts = Product::where('category_id',$category)->count();
                        // $archives = Category::find($category);
                        $relatedfeatures = $product->features;
                        // dd($product->featureproduct);
                        // // }
                        // $pfeatures = DB::table('feature_product')->where('product_id',$product->id)->get();
                        // // $pfeatures = FeatureProduct::where('product_id',$product->id)->get();
                        // // dd($products);
                        // foreach($pfeatures as $onepfeature){
                        //     $featureid = $onepfeature->feature_id;
                        //     $findfeature = Feature::find($onepfeature->feature_id);
                        //     $featurename = $findfeature['feature_name'];
                        // }
                        // foreach($relatedfeatures as $relatedfeature){
                        //     $onefeature = $relatedfeature->id;
                        //     $pfeaturethiss = DB::table('feature_product')->where('feature_id',$onefeature)->get();
                        //     foreach($pfeaturethiss as $pfeaturethis)
                        //     {
                        //         $relatedfeatureone = $pfeaturethis->name;
                        //     // dd($pfeaturethis->name);
                        //     }
                        // }
                    }
                    }
                        $archives = Category::all();
                        $oldCart = Session::has('cart') ? Session::get('cart') : null;
                        $cart = new Cart($oldCart);
                        $request->session()->put('cart', $cart);
                        // dd($cart);
                        $orderid =0;
                        if($cart->items !=null){
                            foreach($cart->items as $item){
                                $orderid1 = $item['order_id'];
                            }
                            $orderid = $orderid1;
                            return new Response(view('products.indexpBuyer',compact('products','archives','productss','cart','orderid','pfeatures','featurename','relatedfeatures'))->with('role','BUYER'));
                        }else{
                            $allorders= Order::latest();
                            foreach($allorders as $oneorder){
                                $orderid = $oneorder->id;
                            }
                            // $orderid = $orderid2;
                            return new Response(view('products.indexpBuyer',compact('products','archives','productss','cart','orderid','pfeatures','featurename','relatedfeatures'))->with('role','BUYER'));
                        }
                    // return new Response(view('products.indexpBuyer',compact('products','archives','productss','cart','orderid'))->with('role','BUYER'));
                }
            
            // return new Response(view('unauthorised access'->with('user_type','ADMIN'));
        
        return new Response(view('unauthorized')->with('role','BUYER'));
    }
    
}
