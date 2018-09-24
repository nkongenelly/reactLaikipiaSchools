<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Input;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find($id);
        return view('images.createImage',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->product_id);
        $this->validate($request, [
            'product_image' => 'required',
            // 'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $productimg = new ProductImages;
        if(Input::hasFile('product_image')){
            $file=Input::file('product_image');
            $file->move(public_path(). '/images/', $file->getClientOriginalName());
            $productimg->image_name = $file->getClientOriginalName();
        }
        $productimg->product_id=$request->product_id;
        $productimg->save();
        // if($request->hasfile('product_image'))
        //  {

        //     foreach($request->file('product_image') as $image)
        //     {
        //         $name=$image->getClientOriginalName();
        //         $image->move(public_path().'/images/', $name);  
        //         $data[] = $name;  
        //     }
        //  }
         

        //  $form= new ProductImages();
        // //  $form->image_name=$data;
        //  $form->image_name=json_encode($data);
        //  $form->product_id=$request->product_id;
         
        // // dd(json_encode($data));
        // $form->save();
        $product = Product::find($request->product_id);
        
        $productsimage = Product::where('id',$request->product_id)
                                ->update(['product_image'=>$file->getClientOriginalName()]);
        $user = auth()->user()->id;
        // $products = Product::where('user_id',$user);
        $products = Product::where('user_id',$user)->get();
        
        // dd($products);
        // return view('products.indexP',compact('user','products'));
        return view('products.indexP',compact('products','user'))->with('success', 'Your images has been successfully');
    
    }
    

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
