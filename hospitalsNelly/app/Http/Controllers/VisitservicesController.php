<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Visitservice;
use App\Service;
use App\Visit;
use App\Patient;

class VisitservicesController extends Controller
{
    //
    public function bills()
    {
        return view('hospital.bills');
    }

    public function time()
    {
        return view('hospital.time');
    }

    public function revenue()
    {
        return view('hospital.revenue');
    }

    public function saveBills(Request $request){
        $this->validate($request,[
            'service_name' =>'required',
            'quantity' =>'required',
            
        ]);
        $amount = DB::table('services')->where('service_id', $service_id)->value('amount');
        $quantity = $request->input('quantity');
        $msg = $amount * $quantity;
        
        $mytime = Carbon\Carbon::now();
        $mytime->toDateTimeString();

        $service = new Visitservice;
        $service->visit_visit_id =$request->input('visit_visit_id');
        $service->service_service_id =$request->input('service_service_id');
        $service->quantity =$request->input('quantity');
        $service->amount =$request->input($msg);
        $service->bill_time =$request->input($mytime);
        $service->save();

        return view('hospital.visits');


    }

    public function saveBills1(Request $request){
        $bills = Visitservice::selectRaw('service_id', 'service_amount')
            ->orderBy('service_id')
            ->get();

 
    }

    public function getBills(){
        $bills = Visitservice::join('services', 'visitservices.service_service_id', '=', 'services.service_id')
            ->select(DB::raw('(services.amount * visitservices.quantity) as visitservices.amount'), 'visitservices.quantity', 'services.service_name', 'visitservices.bill_time')
            ->where('visitservices.service_service_id', '=', 'services.service_id') 
            ->get();
           
        echo $bills;
       
    }

    public function getAllBills(){
        $bills = Patient::join('visits', 'patients.patient_id', '=', 'visits.patient_patient_id')
            ->join('visitservices', 'visits.visit_id', '=', 'visitservices.visit_visit_id')
            ->join('services', 'visitservices.service_service_id', '=', 'services.service_id')
            ->select('visitservices.visitservice_id', 'patients.full_name', 'services.service_name', 'visitservices.quantity', 'visitservices.amount', \DB::Raw('(visitservices.amount * visitservices.quantity) AS TOTAL'))
            ->where('visits.visit_status', '=', '1')
            ->get();
           
        echo $bills;
       
    }
    public function getSingleBill($visitservice_id){
        //$bill = Visitservice::find($visitservice_id);
        $bills =Patient::join('visits', 'patients.patient_id', '=', 'visits.patient_patient_id')
            ->join('visitservices', 'visits.visit_id', '=', 'visitservices.visit_visit_id')
            ->join('services', 'visitservices.service_service_id', '=', 'services.service_id')
            ->select('visitservices.visitservice_id', 'patients.full_name', 'services.service_name', 'visitservices.quantity', 'visitservices.amount', \DB::Raw('(visitservices.amount * visitservices.quantity) AS TOTAL'))
            ->where('visitservices.visitservice_id', '=', $visitservice_id) 
            ->get();
        echo $bills;


    }
    public function updateBill(Request $request){
        $this->validate($request,[
            'service_name' =>'required',
            'quantity' =>'required',
            'amount' =>'required',
            'bill_time' =>'required',
            
        ]);
        $id = $request->visit_service;
        $bills = Visitservice::find($id);
        $bills->visitservice_id =$request->input('visitservice_id');
        $bills->service_name =$request->input('service_name');
        $bills->quantity =$request->input('quantity');
        $bills->amount =$request->input('amount');
        $bills->bill_time =$request->input('bill_time');
        $bills->save();

    }

    public function delete($visitservice_id){
        DB::table("visitservice")->where('visitservice_id', $visitservice_id)->delete();
        $bills = DB::table("visitservice")->get();
        echo $bills;
       // return view('show_lessons');
    }

    public function getTimeReports(){
        $time = Visitservice::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) as count')
        ->groupBy('month', 'year')
        ->orderBy('month')
        ->get();
        // ->toString();
         echo $time;
    }

    public function getRevenueReports(){
        // $revenue = Visit::join('visits', 'patients.patient_id', '=', 'visits.patient_patient_id')
        // ->join('visitservices', 'visits.visit_id', '=', 'visitservices.visit_visit_id')
        // ->join('services', 'visitservices.service_service_id', '=', 'services.service_id')
        // ->select('visitservices.visitservice_id', 'patients.full_name', 'services.service_name', 'visitservices.quantity', 'visitservices.amount', \DB::Raw('(visitservices.amount * visitservices.quantity) AS TOTAL'))
        // ->where('visits.visit_status', '=', '1')
        // ->get();
        // // ->toString();
        //  echo $revenue;
    }

}
