<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserType extends Model
{
    //
    protected $guarded = [];
    public function users(){
        return $this->hasMany(User::class);
    }
}
