<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\Feature;
use App\Order;
use App\OrderItems;
use App\FeatureProduct;
use App\Review;

class Product extends Model
{
   // protected $touches = array('category','features','user','featureproduct');
    protected $guarded = [];
    public function features(){
        return $this->belongsToMany(Feature::class)->withTimestamps();;
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderitems(){
        return $this->hasMany(OrderItems::class);
    }
    // public function featureproduct(){
    //     return $this->hasManyThrough(
    //         DB::table("feature_product"),
    //         Feature::class,
    //         'App\Post',
    //         'App\User',
    //         'country_id', // Foreign key on users table...
    //         'user_id', // Foreign key on posts table...
    //         'id', // Local key on countries table...
    //         'id' // Local key on users table...
    //     );
        // return $this->belongsTo(DB::table('feature_product'));
    // }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
  
}
