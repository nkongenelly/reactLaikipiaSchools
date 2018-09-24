<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Feature;
use App\FeatureProduct;

class FeatureProduct extends Model
{
    protected $guarded = [];
    // public function product(){
    //     return $this->belongsTo(Product::class);
    // }
    public function feature(){
        return $this->belongsTo(Feature::class);
    }

}
