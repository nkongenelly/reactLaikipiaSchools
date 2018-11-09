<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patient;
use App\Visitservice;

class Visit extends Model
{
    //
    protected $primaryKey = 'visit_id';
    protected $fillable = ['patient_patient_id'];

    public function patients(){
        return $this->belongsTo('App\Patient');
    }

    public function visitservice(){
        return $this->hasMany('App\Visitservice');
    }

    public function getName($id){
        $post = App\Patient::find($id);
        echo $post->patients->full_name;
        //$name = $post->full_name;
       // $name->patients()->get('full_name');
        //return $name;
        //echo $post->patients->full_name;
    }
}
