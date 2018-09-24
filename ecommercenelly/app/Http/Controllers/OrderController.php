<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Product;
use App\OrderStatus;
use App\OrderItems;
use App\Cart;
use App\Feature;
use App\FeatureProduct;
use App\Category;
use Session;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    { 
        // $orders = Order::all();
      $orders = Order::where('user_id',$id)->get();
        // $visits = Order::where()
        //     ->join('order_items', 'order_items.product_id', '=', 'orders.product_id')
        //     ->join('products', 'products.product_id', '=', 'order_items.product_id')
        //     ->select('products.product_name', 'products.product_feature','products.product_description','products.product_price')
        //     ->get();
        //     // dd($visits);
        // dd($orders);
        foreach($orders as $order){
            $orderss = $order->product_id;
            $acb = $order->order_status_id;
            // dd(array($order));
            // dd($order->product_id);
            $productss = Product::where('id',$orderss)->get();
            // dd($productss);
           foreach($productss as $products){

            $product=$products->product_name;
            // dd($product);
           } 
        // dd($products->product_name);
       }
        //    dd($productss);
        return view('orders.indexBuyer',compact('orders','productss','products'));
        //}
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordersseller(){
        //Get Ordered products whose status are 2 for each user
        $user = auth()->user()->id;
        // $orders = Order::where('order_status_id',2)->get();
        // $products =0;
        $allorders = Order::where([
                    // 'user_id'=>$user,
                    'order_status_id'=>"2",
        ])->get();
        // dd($allorders);
        // foreach($allorders as $allorder){
            $orders = OrderItems::join('orders','orders.id','=','order_items.order_id')
                        ->where('order_items.completed',0)
                        ->join('products', 'products.id', '=', 'order_items.product_id')
                        ->where('products.user_id',$user)
                        ->join('users','users.id', '=', 'orders.user_id')
                        // ->where(['orders.order_status_id'=>"2"])
                        ->select('order_items.order_id','order_items.price','users.name','order_items.product_id')
                        // ->join('order_items','order_items.product_id', '=', 'products.id')
                        ->select('products.product_name','products.id','orders.user_id')
                        ->groupBy('products.product_name','products.id','orders.user_id')
                        
                        ->get();
                        foreach($orders as $order){
                            // dd($orders);  
                        }
        // }
 
        return view('orders.indexSeller',compact('orders','products','buyer','allorders'));

    }
    public function orderssellersingle($id){
        //Get Ordered products whose status are 2 for each user
        $user = auth()->user()->id;
        // $orders = Order::where('order_status_id',2)->get();
        // $products =0;
        $orders = OrderItems::where(['order_items.product_id'=>$id,'order_items.completed'=>0])
                                ->join('orders','orders.id','=','order_items.order_id')
                                ->select('order_items.order_id','orders.user_id',DB::raw("Sum(order_items.quantity) as quantity"),'order_items.price','order_items.product_id')
                                ->groupBy('order_items.order_id','order_items.quantity','orders.user_id','order_items.price','order_items.product_id')
                                ->get(); 
        return view('orders.indexSellerSingle',compact('orders','products','buyer'));

    }

    public function orderscomplete($id, $order,$product){
        //update order_status to completed
        $statuss = 3;
        //check if all products in the order have been completed
        $checkifall = Order::where('id',$order)->get();
        // dd($checkifall);
        foreach($checkifall as $confirmall){
            $confirmcount = OrderItems::where('order_id',$confirmall->id)->get();
            $checkcompleted = OrderItems::where(['order_id'=>$confirmall->id,'product_id'=>$product])->get();
            foreach($checkcompleted as $again){
            //update single product to completed 
            $number = $confirmcount->count();
            // dd($number);
            $count=array();
            // dd(in_array('false', $checkcompleted, true));
                if($again->completed != TRUE){
                    // dd($confirmall);
                    //  dd(count($count));
                    $find = OrderItems::where([
                        'order_id'=>$again->order_id,
                        'product_id'=>$product,
                    ])->update(['completed'=>TRUE]);
                    // array_push($count, "true","true");
                    //  dd($confirmall);
                }
                
                $confirmcount = OrderItems::where([
                                            'order_id'=>$confirmall->id,
                                            'completed'=>1,
                                            ])->get();
                // $confirm = OrderItems::where('order')
                // array_push($count, "true");
                // dd(count($confirmcount));
                if((count($confirmcount)) ==$number) {
                    // dd('now change status');
                    $status = Order::where('id',$order)
                    ->update([
                        'id' => $order,
                        'user_id' => $id,
                        'order_status_id' => $statuss,
                    ]);
                    $user = auth()->user()->id;
                    // $orders = Order::where('order_status_id',2)->get();
                    // $products =0;
                    $orders = OrderItems::where(['order_items.product_id'=>$id,'order_items.completed'=>0])
                                            ->join('orders','orders.id','=','order_items.order_id')
                                            ->select('order_items.order_id','orders.user_id',DB::raw("Sum(order_items.quantity) as quantity"),'order_items.price','order_items.product_id')
                                            ->groupBy('order_items.order_id','order_items.quantity','orders.user_id','order_items.price','order_items.product_id')
                                            ->get(); 
                                            // dd($orders);
                    return view('orders.indexSellerSingle',compact('orders','products','buyer'));

                }else{
                    $user = auth()->user()->id;
                    // $orders = Order::where('order_status_id',2)->get();
                    // $products =0;
                    $orders = OrderItems::where(['order_items.product_id'=>$id,'order_items.completed'=>0])
                                            ->join('orders','orders.id','=','order_items.order_id')
                                            ->select('order_items.order_id','orders.user_id',DB::raw("Sum(order_items.quantity) as quantity"),'order_items.price','order_items.product_id')
                                            ->groupBy('order_items.order_id','order_items.quantity','orders.user_id','order_items.price','order_items.product_id')
                                            ->get(); 
                                            // dd($orders);
                    return view('orders.indexSellerSingle',compact('orders','products','buyer'));
                }
            }
        }
    }
                //check if all products in order have been completed
        // }
        // $checkagain = OrderItems::where('id',$order)->get();
        // foreach($checkagain as $again){
            

            
        //     $nooforders = $again->count();
        //     // dd($allproducts->order_id);
        //     for($i = 1; $i<=$nooforders; $i++){
        //         $count+=1;
                       
        //                 if($again->completed == TRUE){

        //                     // dd("finished");
        //                     $status = Order::where('id',$order)
        //                                 ->update([
        //                                     'id' => $order,
        //                                     'user_id' => $id,
        //                                     'order_status_id' => $statuss,
        //                                 ]);
        //                     $user = auth()->user()->id;
        //                     // $orders = Order::where('order_status_id',2)->get();
        //                     // $products =0;
        //                     $orders = OrderItems::where('product_id',$id)
        //                                             ->join('orders','orders.id','=','order_items.order_id')
        //                                             ->select('order_items.order_id','orders.user_id',DB::raw("Sum(order_items.quantity) as quantity"),'order_items.price')
        //                                             ->groupBy('order_items.order_id','order_items.quantity','orders.user_id','order_items.price')
        //                                             ->get(); 
        //                     return view('orders.indexSellerSingle',compact('orders','products','buyer'));
        //                 }else{
        //                     // dd('continue');
        //                     $user = auth()->user()->id;
        // // $orders = Order::where('order_status_id',2)->get();
        // // $products =0;
        //                     $orders = OrderItems::where('product_id',$id)
        //                                             ->join('orders','orders.id','=','order_items.order_id')
        //                                             ->select('order_items.order_id','orders.user_id',DB::raw("Sum(order_items.quantity) as quantity"),'order_items.price')
        //                                             ->groupBy('order_items.order_id','order_items.quantity','orders.user_id','order_items.price')
        //                                             ->get(); 
        //                     return view('orders.indexSellerSingle',compact('orders','products','buyer'));
        //                 }
        //             }
        //         }
        //     }
        // }    
    

    // }

    public function orderview( $id, $order){
        // dd($id);
        $orderss = Order::where('id',$order)->select(['user_id'])->get();
        foreach($orderss as $orders){
            $userid = $orders->user_id;
            $userss = auth()->user()->where('id',$userid)->get(); 
            foreach($userss as $users){
                $user = $users->name;
                // dd($userid);
            }
            // $userid = auth()->user($single)->id;  
            
        }
        $quantities = OrderItems::where('order_id',$order)->select(['quantity','price'])->get();
        foreach($quantities as $quantitys){
            $quantity = $quantitys->quantity;
            $price =  $quantitys->price;
            // dd($quantity);
        }
        $productss = Product::where('id',$id)->select(['product_name','product_price'])->get();
        foreach($productss as $products){
            $product = $products->product_name;
            $created = $products->created_at;
            // dd($product);
        }
       
        return view('orders.orderSingleSeller',compact('user','quantity','product','price','order','userid'));

    }

    public function ordersbuyer($id){
       
            $orders = OrderItems::join('products', 'products.id', '=', 'order_items.product_id')
            // ->select('orders.id')
            ->join('orders','order_items.order_id', '=', 'orders.id')
            // ->join('order_items','order_items.product_id', '=', 'products.id')
            ->where(['orders.user_id'=>$id,'orders.order_status_id'=>2])
            ->select('products.product_name', 'products.product_description','orders.id','order_items.price')
            ->get();
            // dd($orders);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
             $cart = new Cart($oldCart);
                     return view('orders.indexOBuyer',compact('orders','products','pricess','cart','products','relatedfeatures'));
        }
            // dd($orders);
        // foreach($orders as $order){
        //     // $products = array();
        //         $productss = $order->product_id;
        //         // $orderid = $order->id;
        //         // $pricess = OrderItems::where([
        //         //         'order_id'=> $orderid,
        //         //         'product_id'=> $productss
        //         // ])->get();
             
        //         $products = Product::where('id',$productss)->get();
        //             foreach($products as $product){
        //                 $productsss = $product->product_name;
        //                 // dd($product);
        //                 // array_push($products,$product);
        //             // }
        //         // dd($order->product_id);
        //         // dd($products->product_name);
        //         // dd($products->product_name);
        //         // $products = Product::where('id',$productss)->get();
        //         // foreach($products as $product){
        //         //     $group = $product->product_name;
        //         //     $productid= $product->id;
        //             $pricess = DB::table('order_items')->select('price')->where([
        //                 'product_id'=>$productss,
        //                 'order_id'=>$id,
        //                 ])->get();
        //                 // dd($pricess);
        //             // $pricess = OrderItems::where('product_id',$productid)->select('price')->get();
        //             // dd($pricess);
                    
        //             foreach($pricess as $prices){
        //                 $price =$prices->price;
        //             }
        //         //     // dd($pricess);
        //         //     // $abs = $products->groupBy($group);
        //         //     // foreach($abs as $abc){
                        
        //             }
        //         // array_push($products,$product);
                    
        //         // }
        //         return view('orders.indexOBuyer',compact('orders','products','pricess'));
        // }
        // dd($products);
        // dd($product->prices);
       

    // }

    public function ordersbuyercomplete($id){
        // $orders = DB::table('orders')->where([
        //     'user_id'=>$id,
        //     'order_status_id' =>3,
        //     ])->get();
        // $orders = Order::where('user_id',$id)->select('order_status_id')->get();
        // $products =0;
        $orders = Order::join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->select('orders.id')
        ->join('products','order_items.product_id', '=', 'products.id')
        // ->join('order_items','order_items.product_id', '=', 'products.id')
        ->where(['orders.user_id'=>$id,'orders.order_status_id'=>3])
        ->select('products.product_name', 'products.product_description',DB::raw("Sum(order_items.quantity) as quantity"),'orders.id','order_items.price')
        ->groupBy('products.product_name', 'products.product_description','order_items.quantity','orders.id','order_items.price')
        ->get();

        // $count =0;
        // foreach($orders as $order){
        //     if($order->order_status_id = 3){
        //         $productss = $order->product_id;
        //         $products = Product::where('id',$productss)->get();
        //         foreach($products as $product){
        //             $group = $product->product_name;
        //             $abs = $products->groupBy($group);
        //             foreach($abs as $abc){

        //             }
        //             // dd(boolean($order->order_status_id = 2));
        //         }
        //     }
        // }
        
        // dd($orders->order_status_id);
        return view('orders.indexOBuyerComplete',compact('orders','products'));
    }

    public function orderbuyerview($id){
        $productsthis = Product::where([
            ['product_status','1'],
            ['Product_quantity','>','0'],
            ['id',$id],
            ])
            ->get(); 
        foreach($productsthis as $product){
            $relatedfeatures = $product->features;
            // dd($product->features);
            // }
            $pfeatures = DB::table('feature_product')->where('product_id',$product->id)->get();
            // $pfeatures = FeatureProduct::where('product_id',$product->id)->get();
            // dd($products);
            foreach($pfeatures as $onepfeature){
                $featureid = $onepfeature->feature_id;
                // dd($onepfeature->feature_id);
                $findfeature = Feature::find($onepfeature->feature_id);
                $featurename = $findfeature['feature_name'];
            }
            foreach($relatedfeatures as $relatedfeature){
                $onefeature = $relatedfeature->id;
                $pfeaturethiss = DB::table('feature_product')->where('feature_id',$onefeature)->get();
                foreach($pfeaturethiss as $pfeaturethis)
                {
                    $relatedfeatureone = $pfeaturethis->name;
                // dd($pfeaturethis->name);

                }
            }
        }
        $productss = Product::where('id',$id)->get();
        foreach($productss as $products){
            $users = $products->user_id;
            $user = auth()->user()->find($users)->name;
          
            $arrays = array($products->product_image); 
              if(array($arrays)){
            foreach($arrays as $product){
                // dd($product);
        }
        }
            }
        return view('orders.buyerViewProduct',compact('productss','user','productsthis','product','relatedfeatureone','pfeaturethis'));
    }

    public function create($id)
    {

        $product = Product::find($id);
        // dd($id);
        $status = 1;
        $orderstatus = OrderStatus::find($status);
  
        // dd($product);
        return view('orders.createBuyer',compact('product','orderstatus','id'));
    }

    public function carts(Request $request,$id, $product)
    {
        $status = 1;
        // Order::create([
        //     'user_id' => $id,
        //     'order_status_id' =>$status,
        // ]);
         session()->flash("success_message", "you have successfully added Product to your Cart");
        
        // dd('orderstatusd');
        return redirect('/productsbuyer');
    }
    public function pricetocart(Request $request,$id){

        return $this.getAddToCart($id);
    }

    public function getAddToCart(Request $request, $id) {
        // dd(request('name'));
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        $user = auth()->user()->id;
        $carts = $cart->items;
        // dd($cart->items);
        foreach($cart->items as $item){
        if(request('name') !=null){
            $item['name'] = request('name');
            $fname  = request('name');
            $fprices = DB::table('feature_product')->where(['product_id'=>$id,'name'=>request('name')])->get();
            foreach($fprices as $fprice){
                $featureprice = $fprice->feature_price;
            

            }
        }
            $status = 1;
            $getallorders=Order::latest()->get(); 
            if(count($getallorders)){
                // dd("Hallo1");
                foreach($getallorders as $getallorder){
                    // dd($getallorders);
                    if($getallorder->order_status_id == "1"){
                        // dd("Hallo33");

                    }
                    if($getallorder->id =$item['order_id']){
                // dd("Hallo44");
                       

                    }  else{
                        // dd('hakko');
                        $orderpresents = Order::create([
                            'user_id' => $user,
                            'order_status_id' =>$status,
                        ])->select('id')->get();

                    }
                    
                        
                  
                }
                // $orderpresents = Order::create([
                //     'user_id' => $user,
                //     'order_status_id' =>$status,
                // ])->select('id')->get();
            }else{ 
                // dd("Hallo22");
            $orderpresents = Order::create([
                'user_id' => $user,
                'order_status_id' =>$status,
            ])->select('id')->get();
            }
            
       
            $orderpresents = Order::all();
            
            }
        // }
        // dd($featureprice);
        if(array($cart)){ 
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
                        }
                    }
                    $archives = Category::all();
                    foreach($cart->items as $item){
                        $orderid = $item['order_id'];
                    }
                    // if(count($orderpresents)){
                    //     foreach($orderpresents as $orderpresent){
                    //         if(($orderpresent->order_status_id) =="1")
                    //         {
                    //             $orderid = $orderpresent->id;
                    //         //   return redirect('/productsbuyer'.$orderid);
                    //         }
                    //     }
                    // }
         return view('products.indexpBuyer',compact('products','archives','productss','orderid','cart','featureprice'));
        // return redirect('/productsbuyer',compact('orderid'));
        }
        else{
            return redirect('/productsbuyer');
        }
        
    }

    public function getCart(){
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
      $carts = $cart->items;
      foreach($cart->items as $item){
            if($item['name'] !=null){
                // $item['name'] = request('name');
                // dd($item);
                $fname  = request('name');
                $fprices = DB::table('feature_product')->where(['product_id'=>$item['product_id'],'name'=>$item['name']])->get();
                foreach($fprices as $fprice){
                    $featureprice = $fprice->feature_price;
                
    
                }
            }
          $productss = $item['item']->id;
          $userid = auth()->user()->id;
        $orders = Order::where('user_id',$userid)->get();
        foreach($orders as $order){
            // dd($cart);
        }
      }
      foreach($carts as $product){
        $productss = $product['product_id'];
        $products=Product::find($productss);
        $users = auth()->user()['id'];
        
      }
      return view('orders.indexBuyer',['products' => $cart->items, 'totalPrice' => $cart->totalPrice],compact('orders','featureprice'));
        // return view('orders.indexBuyer', compact('order','products'));
    }


    //     $users = auth()->user()->id;
    //     $orders = Order::where('user_id',$users)->get();
    //     // $visits = Order::where()
    //     //     ->join('order_items', 'order_items.product_id', '=', 'orders.product_id')
    //     //     ->join('products', 'products.product_id', '=', 'order_items.product_id')
    //     //     ->select('products.product_name', 'products.product_feature','products.product_description','products.product_price')
    //     //     ->get();
    //     //     // dd($visits);
    //     // dd($orders);
    //     foreach($orders as $order){
    //         $orderss = $order->product_id;
    //         $acb = $order->order_status_id;
    //         // dd(array($order));
    //         // dd($order->product_id);
    //         $productss = Product::where('id',$orderss)->get();
    //         // dd($productss);
    //        foreach($productss as $products){

    //         $product=$products->product_name;
    //         // dd($product);
    //        } 
    //     // dd($products->product_name);
    //    }
    // //    dd($productss);
    //     return view('orders.indexBuyer',compact('orders','productss','products'));
        //}
        
       
    //}
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // OrderController.php

    // public function storess(Request $request)
    // {
    // // $this->validate($request, [
    // //     'payment' => 'required',
    // //     'courier' => 'required',
    // // ]);
    // $cart = Session::get('cart');
    // $total = 0;
    // foreach ($cart as $data) {
    //     $total_harga = $data['harga'] * $data['qty'];
    //     $qty = $data['qty'];
    // }
    // $quantity = $qty + 0;
    
    // $new = new Orders();
    // $new->user_id = Auth::user()->id;
    // $new->payment = $request['payment'];
    // $new->courier = $request['courier'];
    // $new->note = $request['note'];
    // $new->total_quantity = $quantity;
    // $new->total_amount = $total_harga;
    // $new->status = 1;
    // $new->save();
    
    // $order_id = DB::getPdo()->lastInsertId();
    
    // foreach ($cart as $data) {
    //     $total_harga = $data['harga'] * $data['qty'];
    //     $qty = $data['qty'];
    //     $OrderPro = new Ordersproducts;
    //     $OrderPro->order_id = $order_id;
    //     $OrderPro->product_id = $data['product_id'];
    //     $OrderPro->product_name = $data['product_name'];
    //     $OrderPro->product_price = $data['product_price'];
    //     $OrderPro->product_quantity = $data['product_quantity'];
    //     $OrderPro->save();
    // }
    
    // Session::forget('cart');
    // return redirect()->route('order.status', $id);
    // }
     
    public function store(Request $request)
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
      $carts = $cart->items;
        //   dd($cart->items);
      foreach($cart->items as $item){
        
      
        // $this->validate(request(),[
        //     'user_id' => 'required',
        //     'order_status_id' => 'required',
        //     'product_id' => 'required',
        //     'quantity' => 'required',
        // ]);
        $userid = auth()->user()->id;
                // $abcd = Order::where(request([
                //     'user_id','order_status_id','product_id'
                // ]))->orderBy('created_at','desc')->first()->id;
                // dd($abcd);
                // $orderitems = request(['user_id','order_status_id','product_id','quantity']);
                $result = Order::where([
                    'order_status_id'=>'1' ,
                    'user_id'=>$userid,
                ])->select('id')->get();
                foreach($result as $resultorder){}
                // dd($orderitems);
                $prices = $item['product_name'];
                $pricess = Product::find($item['product_name']);
                if($item['feature_price'] != null){
                $pricesss = $item['feature_price'] * $item['quantity'];
                }else{
                    $pricesss = $item['product_price'] * $item['quantity'];
                }
                // dd($pricesss);
                // $price = $request->price=$pricesss;
                // $result = $results['user_id'];
                // $orderitems = OrderItems::where('id', $result)->select('id')->get();
                // dd($result);
                foreach($result as $orderitems){
                    $orderitem = $orderitems->id;
                    // dd(array('product_id'=>request(['product_id'])));
                }
                // $result = array (json_encode(orderitem),'product_id','');
                // dd($orderitem);
                // $orders = Order::find();
                // foreach($result as $orderitems){
                //     $orderitem = $orderitems->id;
                // $ab = array(
                //     'order_id'=>json_encode($abcd),
                //     request(['product_id']),
                //     request(['quantity']),
                //     'price'=>json_encode($pricesss),
                // );
                // // dd(request(['product_id','quantity']));
                // // dd(request(['product_id'])['product_id']);
                // $product = (request(['quantity'])['quantity']) * (json_encode($pricesss)); 
                // dd($product);
                foreach($cart->items as $item){
                OrderItems::create(array(
                    'order_id'=>$item['order_id'],
                    'product_id'=>json_encode($item['product_id']),
                    'quantity'=>json_encode($item['quantity']),
                    'price'=>json_encode($pricesss),
                    'completed'=>FALSE,
                    ));
                    // dd('okay');
                    // dd($abc);

                }
                Order::where('id',$item['order_id'])
                        ->update([
                            'order_status_id'=>"2"
                        ]);
               $productquantititess =  Product::where('id',$item['product_id'])->select('Product_quantity','id')->get();
                foreach($productquantititess as $productquantitites){
                    if($productquantitites->id = $item['product_id'] ){
                        // dd($item['quantity']);
                        Product::where('id', $item['product_id'])
                                ->update([
                                    'Product_quantity' =>($productquantitites->Product_quantity) - ($item['quantity'])
                        ]);
                    }
                }
                    // dd($abc);
                    // $orders = Order::all();
                    $orders = Order::where('user_id',$userid)->get();
                    foreach($orders as $order){
                        // $orderss = $order->product_id;
                        // $productss = Product::where('id',$orderss)->get();
                    }

                   //check whether quantity is below aero so as to update status to be out of stock
                    $quantitycheck = Product::find($item['product_id']);
                    $quantity = $quantitycheck->Product_quantity;
                    if($quantity<"0")
                    {               
                        $update = Product::find($item['product_id'])
                                ->update([
                                     "product_status" => "2"
                                ]);
                    }
                    // dd('more');
                    //  return view('orders.indexBuyer',compact('orders','productss','products'));
                    $user =$userid;
                    return $this->ordersbuyer($user);
                    // return redirect('/ordersbuyer/{{ Auth::user()["id"] }}');
                }
        }
    // }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function reports($id)
    {
        $reports = Product::where('user_id',$id)
                        ->join('order_items','order_items.product_id', '=', 'products.id')
                        ->join('categories','categories.id', '=', 'products.category_id')
                        // ->select('category.name','products.product_name')
                        ->select('categories.category_name','products.product_name','order_items.quantity','order_items.price','products.id','order_items.order_id')
                        ->get();
                        $total =0;
                        foreach($reports as $report){
                            for($i=1; $i<=$reports->count(); $i++){
                                $total +=$report->price;
                            }
                        }
                            // dd($total);
                        

        return view('reports.indexReports',compact('reports','total'));
    }

    public function productreports($id,$order){
        $productss = Product::find($id);
        $products=$productss->product_name;
        $productsid =$productss->id;
        $buyers =Order::where('product_id',$productsid)->get();
        foreach($buyers as $buyer){
            $buyerid = $buyer->user_id;
            $buyername = auth()->user()->find($buyerid)->name;
        }
        $quantitys =OrderItems::where([
            'product_id'=>$productss->id,
            'order_id'=>$order,
            ])->get();
        foreach($quantitys as $quantityss){
            $quantity= $quantityss->quantity;
            $price = $quantityss->price;
        }
                                // join('order_items', 'order_items.product_id', '=', 'products.id')
                                // ->join('orders','orders.id', '=', 'order_items.order_id')
                                // ->join('users','users.id', '=', 'orders.user_id')
                                // ->select('products.product_name','users.name','order_items.quantity','order_items.price')
                                // ->get();
        //    dd($productreport);
        return view('reports.productReport',compact('products','buyername','quantity','price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
