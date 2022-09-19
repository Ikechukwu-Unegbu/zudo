<?php 
namespace App\Services;
use Illuminate\Support\Facades\Http;

class SMSService{

    protected $passwordBettaSms = "Physics1994@RF";
    protected $usernameBettaSms = "iunegbu94@gmail.com"; 
    public function __construct()
    {
        
    }


    // public function sender($message, $sender, $phone){
    //     $sendSms = Http::get("http://login.betasms.com.ng/api/?username=iunegbu94@gmail.com&password=Physics1994@RF&message=".$message."&sender=".$sender."&mobiles=".$phone);
    //     var_dump($sendSms->json());
    // }

    // public function sendWithMobileAirtimeApi($message ='hello world', $sender='SpartanCo', $phone="2349073569459"){
    //     $send = Http::get('https://www.mobileairtimeng.com/smsapi/bulksms?userid=07038901997&password=64dfab6df6af8841742cd87&message='.$message.'&mobile='.$phone.'&sender='.$sender.'&jsn=json');
    //     $response = $send->json();
    //     var_dump($response["response"]);
    //     var_dump($send->successful());
    // }


    public function senderSMS($message, $mobiles, $sender){
        //allow remote access to this script, replace the * to your domain e.g http://www.example.com if you wish to recieve requests only from your server
        header("Access-Control-Allow-Origin: *");
        //rebuild form data
        $postdata = http_build_query(
            array(
                'username' => $this->usernameBettaSms,
                'password' => $this->passwordBettaSms,
          'message' => $message,
          'mobiles' => $mobiles,
          'sender' => $sender
            )
        );
        //prepare a http post request
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        //craete a stream to communicate with betasms api
        $context  = stream_context_create($opts);
        //get result from communication
        $result = file_get_contents('http://login.betasms.com/api/', false, $context);
        //return result to client, this will return the appropriate respond code
         return $result;
    }

    public function logsms($response, $trx){

    }
  
}