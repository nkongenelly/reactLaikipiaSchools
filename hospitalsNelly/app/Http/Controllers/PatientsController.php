<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Patient;
use App\Visit;


class PatientsController extends Controller
{
    //
    public function patients()
    {
        return view('hospital.patients');
    }

    public function save(Request $request){
        $this->validate($request,[
            'full_name' =>'required',
            'national_id' =>'required',
            'gender' =>'required',
            'date_of_birth' =>'required',
            
        ]);

       // $name = $_POST['lessonName'];
        $hospital = new Patient;
        $hospital->full_name =$request->input('full_name');
        $hospital->national_id =$request->input('national_id');
        $hospital->gender =$request->input('gender');
        $hospital->date_of_birth =$request->input('date_of_birth');
        $hospital->save();
      /*  $hospital = new Visit;
        $visit->visit_date =$request->input('visit_date');
        $visit->visit_time =$request->input('visit_time');
        $hospital->exit_time =$request->input('exit_time');
        $visit->save();*/

    }

    public function saveVisits(Request $request){
        $this->validate($request,[
            'visit_date' =>'required',
            'visit_type' =>'required',
            'exit_time' =>'required',
            'visit_status' =>'required',
            
        ]);
        $visits = new Visit;
        $visits->patient_patient_id =$request->input('patient_patient_id');
        $visits->visit_date =$request->input('visit_date');
        $visits->visit_type =$request->input('visit_type');
        $visits->exit_time =$request->input('exit_time');
        $visits->visit_status =$request->input('visit_status');
        $visits->save();

    }

    public function gets(){
            $patients = DB::table("patients")->get();
            // dd($patients);
            echo ($patients);
    }

    public function getSingle($patient_id){
        //$lesson = DB::table("lesson")->find($id);
            $patient = Patient::find($patient_id);
            echo json_encode($patient);

    }

    public function update(Request $request){
        $this->validate($request,[
            'full_name' =>'required',
            'national_id' =>'required',
            'gender' =>'required',
            'date_of_birth' =>'required',
        ]);
        
        $id =$request->patient_id;
        $patient = Patient::findOrFail($id);
        $patient->full_name =$request->full_name;
        $patient->national_id =$request->national_id;
        $patient->gender =$request->gender;
        $patient->date_of_birth =$request->date_of_birth;
        $patient->save();
    }

    public function delete($patient_id){
        DB::table("patients")->where('patient_id', $patient_id)->delete();
        $patient = DB::table("patient")->get();
        echo $patient;
       // return view('show_lessons');
    }

}
