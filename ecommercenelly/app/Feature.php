<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\FeatureProduct;
use App\Feature;
use App\Product;

class Feature extends Model
{
    protected $touches = array('products');
    protected $guarded = [];
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function featureproducts(){
        return $this->hasMany(DB::table('feature_product'));
    }
    // public function featureproduct(){
    //     return $this->hasManyThrough(
    //         DB::table("feature_product"),
    //         Product::class,
    //         'App\Post',
    //         'App\User',
    //         'country_id', // Foreign key on users table...
    //         'user_id', // Foreign key on posts table...
    //         'id', // Local key on countries table...
    //         'id' // Local key on users table...
    //     );
    // }
}

