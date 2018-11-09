<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patient;

class Patient extends Model
{
    //
    protected $primaryKey = 'patient_id';
    //add getters
    public $full_name;

    public function visits(){
        return $this->hasMany('App\Visit');
    }
    public function setFirstName($firstName){
        $this->full_name = $firstName;
    }
    public function getFirstName(){
        return 'Mary';
    }

        
}
