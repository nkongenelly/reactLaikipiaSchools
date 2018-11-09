<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use App\Patient;

class User 
{
    //
   
    //add getters
    public $full_name;

    public function setFirstName($firstName){
        $this->full_name = $firstName;
    }
    public function getFirstName(){
        return 'Mary';
    }

        
}
