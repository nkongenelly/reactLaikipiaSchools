<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HospitalsController extends Controller
{   
    public function main()
    {
        return view('hospital.patients');
    } 

    public function getChat()
    {
       $getChat = file_get_contents('php://input');
       $chat = json_decode($getChat, true);

       if(is_array($chat) && (count($chat)>0)){

        
        $mobileNumber = $chat[0]["mobileNumber"];
        $name = $chat[0]["name"];
        $message = $chat[0]["message"];
       

       if(stripos($message, 'bomb') !==false){
            $send = $name . ", such words are not permitted here";
            $url = "https://prod-10.westeurope.logic.azure.com:443/workflows/8f843088ed4a4f1c811b2031ce984ce7/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=DDgoID5HVZtQ0r_yBcmU3fy7iiyjw5468xd9OgP6OOs";
            $text = array("message" => $send);
            $message = json_encode($text);
       

       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
       curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
       curl_setopt($ch, CURLOPT_HEADER, true);     
       curl_setopt($ch, CURLOPT_HTTPHEADER,
               array('Content-Type:application/json',
                      'Content-Length: ' . strlen($message))
               );

    $result = curl_exec($ch);
    curl_close($ch);
    } 
    }
}
public function registerBusiness()
{
   $getChat = file_get_contents('php://input');
   dd($getChat);
   $chat = json_decode($getChat, true);

   if(is_array($chat) && (count($chat)>0)){

    
    $mobileNumber = $chat[0]["mobileNumber"];
    $name = $chat[0]["name"];
    $message = $chat[0]["message"];
   

   if(stripos($message, 'bomb') !==false){
        $send = $name . ", such words are not permitted here";
        $url = "https://prod-10.westeurope.logic.azure.com:443/workflows/8f843088ed4a4f1c811b2031ce984ce7/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=DDgoID5HVZtQ0r_yBcmU3fy7iiyjw5468xd9OgP6OOs";
        $text = array("message" => $send);
        $message = json_encode($text);
   

   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
   curl_setopt($ch, CURLOPT_HEADER, true);     
   curl_setopt($ch, CURLOPT_HTTPHEADER,
           array('Content-Type:application/json',
                  'Content-Length: ' . strlen($message))
           );

$result = curl_exec($ch);
curl_close($ch);
} 
}
}



    public function webservice(){
        $config = array(
            'conector_secret' => env('KAIZALA_CONNECTOR_SECRET'),
            'connector_id' => env('KAIZALA_CONNECTOR_ID'),
            'connector_number' => env('KAIZALA_PHONE_NUMBER'),
            'test_groupId' => env('KAIZALA_TESTGROUP_ID'),
            'test_groupId1' => env('KAIZALA_TESTGROUP_ID1')
        );

        return view('hospital.kaizala', $config);
    }

    function searchByName()
    {
        $json = file_get_contents('php://input');
        $decodedJson = json_decode($json, TRUE);
        if(isset($decodedJson["phone"]))
        {
            $phone = $decodedJson["phone"];
        }
        else
        {
            $phone = NULL;
        }
        $name = $decodedJson["name"];
        
        $credentials = array(
            'grant_type'=>'client_credentials',
            'client_id'=>'281fb603-6abe-4079-8650-258e34ae1fe1',
            'resource'=>'https://nanyukiappfactory.api.crm4.dynamics.com',
            'client_secret'=>'sVDdLx20iW7SI0tIT2n+QVnWkVJ2SPVn/GX3qBSrNhY='
        );
        
        $urlSafeCredentials = http_build_query($credentials);
        $ch = curl_init();
        $test = curl_setopt($ch, CURLOPT_URL,'https://login.microsoftonline.com/afdf297f-b713-45ce-a072-eca2a0ec0533/oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlSafeCredentials);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Cache-Control: no-cache'));
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch);
        $token = $result->access_token;
        
        //'.$name.'
        $ch = curl_init('https://nanyukiappfactory.api.crm4.dynamics.com/api/data/v9.0/accounts?$select=name,telephone1&$filter=contains(name,\''.$name.'\')');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json','Authorization: Bearer '.$token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $dynamicsResult = curl_exec($ch);
        curl_close($ch);
        $coded = "[".$dynamicsResult."]";
        $decoded = json_decode($coded);
        
        $response = array();
        if(is_array($decoded))
        {
            if((count($decoded) > 0))
            {
                $results = $decoded[0]->value;
                foreach($results as $a){
                    $customer = array(
                        'name' => $a->name,
                        'telephone' => $a->telephone1,
                        'customerId' => $a->accountid
                    );
                    
                    array_push($response, $customer);
                }
            }
        }
        echo json_encode($response);
    }
}
