<?php

namespace App\Services;
use Kavenegar;

class kavenegarService {
    public static function send($receptor, $message){


        // return ;


        try{
            // $sender = "10004346";
            $sender = "10000100600666";// "1000596446";
            // $message = "خدمات پیام کوتاه کاوه نگار";
            // $receptor = array("09123456789","09367891011");
            $result = Kavenegar::Send($sender,$receptor,$message);
            // if($result){
            //     foreach($result as $r){
            //         echo "messageid = $r->messageid";
            //         echo "message = $r->message";
            //         echo "status = $r->status";
            //         echo "statustext = $r->statustext";
            //         echo "sender = $r->sender";
            //         echo "receptor = $r->receptor";
            //         echo "date = $r->date";
            //         echo "cost = $r->cost";
            //     }       
            // }
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}