<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;
// use ConsoleTVs\Charts\Charts;
// use FusionCharts;
use App\User;
use App\Product;
use App\OrderItems;
use App\Order;
// use DB;

class FusionCharts extends Controller
{
    public function index()
    {
        
// $chart = app()->chartjs
// ->name('lineChartTest')
// ->type('line')
// ->size(['width' => 400, 'height' => 200])
// ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
// ->datasets([
//     [
//         "label" => "My First dataset",
//         'backgroundColor' => "rgba(38, 185, 154, 0.31)",
//         'borderColor' => "rgba(38, 185, 154, 0.7)",
//         "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
//         "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
//         "pointHoverBackgroundColor" => "#fff",
//         "pointHoverBorderColor" => "rgba(220,220,220,1)",
//         'data' => [65, 59, 80, 81, 56, 55, 40],
//     ],
//     [
//         "label" => "My Second dataset",
//         'backgroundColor' => "rgba(38, 185, 154, 0.31)",
//         'borderColor' => "rgba(38, 185, 154, 0.7)",
//         "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
//         "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
//         "pointHoverBackgroundColor" => "#fff",
//         "pointHoverBorderColor" => "rgba(220,220,220,1)",
//         'data' => [12, 33, 44, 44, 55, 23, 40],
//     ]
// ])
// ->options([]);


        // $id =auth()->user()->id;
    	// $users = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->where('user_id',$id)
        // 			->get();
        $user = auth()->user()->id;
        // $selectfields = Product::where([
        //     'user_id'=>$user,
        // ])->get();
        // foreach($selectfields as $field){
            $groups = OrderItems::join('products','products.id','=', 'order_items.product_id')
                                    ->where(['products.user_id'=>$user])
                                    ->join('orders','orders.id','=','order_items.order_id')
                                    ->where('orders.order_status_id',"3")
                                    // ->selectRaw('year(orders.created_at) as year, monthname (orders.created_at) as month, count(*) as count')
                                    // ->groupBy('year', 'month')
                                    // ->orderByRaw('min(orders.created_at) desc')
                                    ->select('products.product_name','order_items.price')
                                    ->get();
            // foreach($groups as $group){
                                    // dd($groups);
                $names = array();
                $prices = array();
                for($i=1; $i<=count($groups);$i++){
                    $name =$groups[$i-1]->product_name;
                    array_push($names,$name);
                    $price =$groups[$i-1]->price;
                    array_push($prices,$price);
                }          
                // dd($names);
            // }
                    $chart = Charts::database($groups,'bar', 'highcharts')
                        ->title("Total Product sales")
                        ->labels($names)
                        ->values($prices)
                        ->elementLabel("Total Sales")
                        ->dimensions(1000, 500)
                        ->responsive(true);
                        // ->groupByDay('09');
                // $chart = Charts::create('line', 'highcharts')
                //           ->title("Total Product sales")
                //           ->labels(["First","Second","Third"])
                //           ->values(["50",'200',"100"])
                // 	      ->elementLabel("Total Users")
                // 	      ->dimensions(1000, 500)
                // 	      ->responsive(true);
                                    // }
                    return view('fusioncharts.index',compact('chart'));
            // }
        }
    // }
        // dd($barChart);
    
// include("app/includes/fussioncharts.php");
//  $barChart = new FusionCharts("bar2d", "myFirstChart" , 600, 400, "chart-container", "json",
//  ' {
//         "chart": {
//             "caption": "What kind of apps are you building?",
//             "numberSuffix": "%",
//             "paletteColors": "#876EA1",
//             "useplotgradientcolor": "0",
//             "plotBorderAlpha": "0",
//             "bgColor": "#FFFFFFF",
//             "canvasBgColor": "#FFFFFF",
//             "showValues":"1",
//             "showCanvasBorder": "0",
//             "showBorder": "0",
//             "divLineColor": "#DCDCDC",
//             "alternateHGridColor": "#DCDCDC",
//             "labelDisplay": "auto",
//             "baseFont": "Assistant",
//             "baseFontColor": "#153957",
//             "outCnvBaseFont": "Assistant",
//             "outCnvBaseFontColor": "#8A8A8A",
//             "baseFontSize": "13",
//             "outCnvBaseFontSize": "13",
//             "yAxisMinValue":"40",
//             "labelFontColor": "#8A8A8A",
//             " captionFontColor": "#153957",
//             "captionFontBold": "1",
//             "captionFontSize": "20",
//             "subCaptionFontColor": "#153957",
//             "subCaptionfontSize": "17",
//             "subCaptionFontBold": "0",
//             "captionPadding": "20",
//             "valueFontBold": "0",
//             "showAxisLines": "1",
//             "yAxisLineColor": "#DCDCDC",
//             "xAxisLineColor": "#DCDCDC",
//             "xAxisLineAlpha": "15",
//             "yAxisLineAlpha": "15",
//             "toolTipPadding": "7",
//             "toolTipBorderColor": "#DCDCDC",
//             "toolTipBorderThickness": "0",
//             "toolTipBorderRadius": "2",
//             "showShadow": "0",
//             "toolTipBgColor": "#153957",
//             "theme": "fint"
//           },

//         "data": [{
//             "label": "Consumer general",
//             "value": "60.7"
//           }, {
//             "label": "Enterprise internal app",
//             "value": "41.7"
//           }, {
//             "label": "Progressive Web Apps",
//             "value": "25.1"
//           }, {
//             "label": "Consumer social network",
//             "value": "24"
//           }, {
//             "label": "Desktop web apps",
//             "value": "18.5"
//           }, {
//             "label": "Desktop apps (electron, etc)",
//             "value": "12.3"
//           }, {
//             "label": "Consumer chat",
//             "value": "12.2"
//           }, {
//             "label": "Other",
//             "value": "4.5"
//         }]
//     }');
//  $barCharts = $barChart->paginate(10);
    //     return view('fusioncharts.index',compact('chart'));
    // }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
    // {dd("hallo");
        $result = \DB::table('products')
                    ->join('order_items','order_items.product_id','=','products.id')
                    ->select('products.product_name','order_items.price')->selectRaw('monthname(products.created_at) as month')
                    ->get();
                    // dd($result);

        // echo response()->json_encode($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
