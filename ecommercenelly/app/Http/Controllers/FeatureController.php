<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feature;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('seller');
    // }
    public function index($id)
    {
        $user = auth()->user($id);
        // dd($user);
        // $features = Feature::all();
        $features = Feature::where('user_id',$id)->get();
        // dd($features);

        return view('features.indexF',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("hallo");
        $user = auth()->user();
        return view('features.createF',compact('user'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'user_id' => 'required',
            'feature_name' => 'required',
        ]);

        $features = Feature::create(request(['user_id','feature_name']));
        $user = auth()->user()->id;
        $features = Feature::where('user_id',$user)->get();

        return view('features.indexF',compact('features'));
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
        $feature = Feature::find($id);
        $user = auth()->user();

        return view('features.editF',compact('feature','user'));
            
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
        $this->validate(request(),[
            'user_id' => 'required',
            'feature_name' => 'required',
        ]);

        Feature::where('id',$id)
            ->update(request(['user_id','feature_name']));
            $user = auth()->user()->id;
            $features = Feature::where('user_id',$user)->get();
    
            return view('features.indexF',compact('features'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feature::where('id',$id)
            ->delete();  $user = auth()->user($id);
            $user = auth()->user()->id;
            $features = Feature::where('user_id',$user)->get();
    
            return view('features.indexF',compact('features'));
    }
}
