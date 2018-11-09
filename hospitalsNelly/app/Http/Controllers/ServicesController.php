<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\Visit;


class ServicesController extends Controller
{
           //SERVICES

    public function services()
    {
        return view('hospital.services');
    }

    public function getServices(){
        $services = Service::all();
        // $services = Visitservice::selectRaw('service_id', 'service_amount')
        // ->orderBy('service_id')
        // ->get();
        echo ($services);
    }

    public function servicename($visit_id){
        $servicename = Service::all();
       // return view('hospital.bills', compact('servicename', 'visit_id', json_decode($servicename, $visit_id, true)));
        return view('hospital.bills', compact('servicename', json_decode($servicename, true), 'visit_id', json_decode($visit_id, true) ));
    }

    public function servicenames($service_id){
        $servicenames = Service::pluck('amount')->get($service_id);
       // return view('hospital.bills')->with(['servicename'=> $servicename]);
        return view('hospital.visits', compact('servicenames', 'service_id'));
    }

    public function saveServices(Request $request){
        $this->validate($request,[
            'service_name' =>'required',
            'amount' =>'required',
                   
        ]);

       // $name = $_POST['lessonName'];
        $services = new Service;
        $services->service_name =$request->input('service_name');
        $services->amount =$request->input('amount');
        $services->save();

    }

    public function getSingle($service_id){
        //$lesson = DB::table("lesson")->find($id);
            $services = Service::find($service_id);
            echo json_encode($services);

    }

    public function update(Request $request){
        $this->validate($request,[
            'service_name' =>'required',
            'amount' =>'required',
        ]);
        
        $id =$request->service_id;
        $services = Service::findOrFail($id);
        $services->service_name =$request->service_name;
        $services->amount =$request->amount;
        $services->save();
    }

    public function delete($service_id){
        DB::table("services")->where('service_id', $service_id)->delete();
        $services = DB::table("services")->get();
        echo $services;
       // return view('show_lessons');
    }

}
