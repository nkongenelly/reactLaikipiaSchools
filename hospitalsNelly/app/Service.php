<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Visitservice;
class Service extends Model
{
    //
    protected $primaryKey = 'service_id';
    
    public function visitservices(){
        return $this->hasMany('App\Visitservice');
    }
}
