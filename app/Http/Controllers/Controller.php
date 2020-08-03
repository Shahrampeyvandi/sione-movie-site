<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function convertDate($date)
    {

        $date_array = explode('/', $date);
        $year = $date_array[2];
        $month = $date_array[1];
        $day = $date_array[0];
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        if (strlen($day) == 1) {
            $day = '0' . $day;
        }


        $new_date_array = array($year, $month, $day);
        $new_date_string = implode('/', $new_date_array);
        $carbon = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $new_date_string);

        return $carbon;
    }

    public function sendSMS($patterncode, $phone, $data)
    {

        // برای پیامک هنگام ثبت نام
        //$patterncode="g0mj7wtqv3";
        // $data = array("name" => "نام طرف", "username" => "یوزر نیم طرف","password"=>"پسورد طرف");
        //------------------------------
        // برای ارسال پیامک ثبت خرید اشتراک
        //$patterncode="97b8c9m9a5";
        //$data = array("name" => "نام طرف", "number" => "نام اشتراک");
        //-------------------------------



        //$username = "khosravanihadi";
        //$password = 'Hk129837';
        $datas = array(
            "pattern_code"=>$patterncode,
            "originator" => "+985000125475",
            "recipient" => '+98' . substr($phone, 1),
            "values" => $data
        );
        $url = "http://rest.ippanel.com/v1/messages/patterns/send";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, json_encode($datas));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: AccessKey E34dbA2knATnyD5dXlm3y1b5WzYT2dd8te2znaVWRgk='
        ));
        $response = curl_exec($handler);

        dd($response);
    }
}
