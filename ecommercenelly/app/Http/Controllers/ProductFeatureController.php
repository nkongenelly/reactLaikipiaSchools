<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Feature;
use App\FeatureProduct;

class ProductFeatureController extends Controller
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
    public function create($id, $user)
    {
        $product = Product::find($id);
        // $user = auth()->user()->id;
        $features = Feature::where('user_id',$user)->get();
        // $features = $product->features;
        // $features = Feature::find($product);
        // dd($user);
        
        // // dd(Feature::all());
        // // $productfeatures = ProductFeature::all();
        // $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        return view('products.featureCreate',compact(['product','features','user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate(request(),[
            'product_id' => 'required',
            'feature_id' => 'required',
            'name' => 'required',
        ]);
        DB::table('feature_product')->insert(request(['product_id','feature_id','name','feature_price']));

        $product = Product::find($id);
        
        $user = auth()->user();
   
            $pfeatures = DB::table('feature_product')->where('product_id',$product->id)->get();

            foreach($pfeatures as $pfeature){
                // dd($pfeature->feature_price);
                $featureid = $pfeature->feature_id;
                $select = DB::table('feature_product')->where(['product_id'=>$product->id,
                                                            'feature_id'=>$featureid])->get();
                // dd($pfeature);
                $featurename = $featureid['feature_name'];
                // dd($featurename->feature);
                // $belongs = $featurename->feature;
                foreach($select as $selectone){
                $findfeature = Feature::find($selectone->feature_id);
                $featurenames = $findfeature['feature_name'];
                }

            }
        return view('products.featurepIndex',compact(['product','features','user','pfeatures','featurename','select','featurenames']));
        // return redirect('/products/{{ Auth::user()->id  }}');
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
    public function edit($id,$feature)
    {
        $productfeatures = DB::table('feature_product')->find($feature);
        $featureid = $productfeatures->feature_id;
        $pfeatureid = $productfeatures->id;
        $features = Feature::find($featureid);
        // dd($pfeatureid);
        $featurename = $features->feature_name;
        $productfeature = $features->id;
        $user = auth()->user()->id;
        $featuresall = Feature::where('user_id',$user)->get();
        $pfeaturename = $productfeatures->name;
        $pfeatureprice = $productfeatures->feature_price;
        return view('products.featurepEdit',compact(['featureid','featurename','productfeature','featuresall','pfeaturename','id','user','pfeaturename','pfeatureid','pfeatureprice']));
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
        // dd(request(['product_id'])['product_id']);
        $this->validate(request(),[
            'product_id' => 'required',
            'feature_id' => 'required',
            'name' => 'required',
        ]);
// dd(request(['name']));
        $updated = DB::table('feature_product')
            ->where('id', $id)
            ->update(request(['product_id','feature_id','name','feature_price']));
// dd($id);
            $user = auth()->user()->id;
            $products = Product::where([
                            'user_id'=>$user,
                            'id'=>request(['product_id'])['product_id'],
            ]                   )->get();
            $ids = request(['product_id'])['product_id'];
            $product = Product::find($ids);
        // dd($product->id);
            $user = auth()->user();
            // dd($product);
            $features = $product->features;
            $pfeatures = DB::table('feature_product')->where('product_id',$product->id)->get();
            // dd($pfeatures);
            // foreach($pfeatures as $onepfeature){
            //     $featureid = $onepfeature->feature_id;
            //     $findfeature = Feature::find($onepfeature->feature_id);
            //     $featurename = $findfeature['feature_name'];
            // }
            foreach($pfeatures as $pfeature){
                // dd($pfeature->feature_price);
                $featureid = $pfeature->feature_id;
                $select = DB::table('feature_product')->where(['product_id'=>$product->id,
                                                            'feature_id'=>$featureid])->get();
                // dd($pfeature);
                $featurename = $featureid['feature_name'];
                // dd($featurename->feature);
                // $belongs = $featurename->feature;
                foreach($select as $selectone){
                $findfeature = Feature::find($selectone->feature_id);
                $featurenames = $findfeature['feature_name'];
                }

            }

            return view('products.featurepIndex',compact(['product','features','user','pfeatures','featurename','select','featurenames']));
            // return view('products.indexP',compact('user','products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$feature)
    {
        // $ids = DB::table('feature_product')->where('product_id',$id)->get(); dd($ids);
        //     $id = $ids->product_id;
        
        DB::table('feature_product')
            ->where([
                    'product_id'=> $id,
                    'id'=> $feature,
                    ])
            ->delete();
            $product = Product::find($id);
        
            $user = auth()->user();
            $features = $product->features;
            $pfeatures = DB::table('feature_product')->where('product_id',$product->id)->get();
            // dd($pfeatures);
            foreach($pfeatures as $pfeature){
                // dd($pfeature->feature_price);
                $featureid = $pfeature->feature_id;
                $select = DB::table('feature_product')->where(['product_id'=>$product->id,
                                                            'feature_id'=>$featureid])->get();
                // dd($pfeature);
                $featurename = $featureid['feature_name'];
                // dd($featurename->feature);
                // $belongs = $featurename->feature;
                foreach($select as $selectone){
                $findfeature = Feature::find($selectone->feature_id);
                $featurenames = $findfeature['feature_name'];
                }

            }
            // dd($id);
            
            return view('products.featurepIndex',compact(['product','features','user','pfeatures','featurename','featurenames','select']));
    }
}
