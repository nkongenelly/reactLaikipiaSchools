<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\Visit;
class Visitservice extends Model
{
    //
    protected $primaryKey = 'visitservice_id';
    
    public function services(){
        return $this->belongTo('App\Service');
    }

    public function visit(){
        return $this->belongTo('App\Visit');
    }
}
