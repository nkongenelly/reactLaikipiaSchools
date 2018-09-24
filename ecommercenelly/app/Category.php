<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;

class Category extends Model
{
    //
    protected $touches = array('cuser');
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function cuser(){
        return $this->belongsTo(User::class);
    }
}
