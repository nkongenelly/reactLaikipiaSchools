<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Visit;
use App\Patient;
use App\Service;
use App\Visitservice;

class VisitsController extends Controller
{
    //
    public function visits()
    {
        return view('hospital.visits');
    }

    public function getVisits(){
        $visits = Visit::join('patients', 'patients.patient_id', '=', 'visits.patient_patient_id')
            ->select('patients.full_name', 'visits.*')
            ->get();
           
        echo $visits;
       
    }

    public function saveBills(Request $request){
        $this->validate($request,[
            'service_service_id' =>'required',
            'quantity' =>'required',
            'amount' =>'required',
            'bill_time' =>'required',
            
        ]);
        $bills = new Visitservice;
        $bills->visit_visit_id =$request->input('visit_visit_id');
        $bills->service_service_id =$request->input('service_service_id');
        $bills->quantity =$request->input('quantity');
        $bills->amount =$request->input('amount');
        $bills->bill_time =$request->input('bill_time');
        $bills->save();

    }

    public function saveBills1(Request $request){
        $this->validate($request,[
            'service_service_id' =>'required',
            'quantity' =>'required',
            
        ]);
        $amount = Service::$request->input('service_id');
        $amount = Service::find('service_amount');
        $quantity = $request->input('quantity');
        $amounts = $amount * $quantity;
        $bills = new Visitservice;
        $bills->visit_visit_id =$request->input('visit_visit_id');
        $bills->service_service_id =$request->input('service_service_id');
        $bills->quantity =$request->input('quantity');
        $bills->amount =$request->input($amount);
        $bills->bill_time =$request->input('bill_time');
        $bills->save();

        echo $amounts;

    }

    public function getSingle($visit_id){
        $visits = Visit::find($visit_id)
        //$visits= DB::table('visits')
        ->join('patients', 'patients.patient_id', '=', 'visits.patient_patient_id')
        ->select('visits.*', 'patients.full_name')
        ->where('visits.visit_id', '=', $visit_id) 
        ->get();

 
            echo $visits; 

 
    }
   
    public function update(Request $request){
        $this->validate($request,[
            'visit_date' =>'required',
            'visit_type' =>'required',
            'exit_time' =>'required',
            'visit_status' =>'required'
        ]);
        
        $id =$request->visit_id;
        $visit = Visit::findOrFail($id);
        $visit->visit_date =$request->visit_date;
        $visit->visit_type =$request->visit_type;
        $visit->exit_time =$request->exit_time;
        $visit->visit_status =$request->visit_status;
        $visit->save();
    }

    public function delete($service_id){
        DB::table("visits")->where('service_id', $service_id)->delete();
        $visits = DB::table("visits")->get();
        echo $visits;
       // return view('show_lessons');
    }



}
