<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

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



        $username = "khosravanihadi";
        $password = 'Hk129837';
        $from = "+98100009";
        $pattern_code = $patterncode;
        $to = array(substr($phone, 1));
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
   
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
    }

    public function SaveCaption(Request $request, $post, $destinationPath)
    {
        foreach ($request->captions as $key => $caption) {
            if (!is_null($caption[1]) && !is_null($caption[2])) {
                $ext = $caption[2]->getClientOriginalExtension();
                $fileName = 'vtt_' . date("Y-m-d") . '_' . time() . '.' . $ext;
                $caption[2]->move(public_path($destinationPath), $fileName);
                $vttPath = "$destinationPath/$fileName";

                $post->captions()->create([
                    'url' => $vttPath,
                    'lang' => $caption[1]
                ]);
            }
        }
    }


    public function sendNoty($user, $plan = null)
    {
        $query = DB::table('user_plan')->where('user_id', '=', $user->id)->where('plan_id', '=', $plan->id)->first();
        if (!is_null($plan)) {
            $content = 'اشتراک ' . $plan->name . ' با هزینه ' . $plan->price . ' تومان تا تاریخ ' . $query->expire_date . ' برای شما فعال میباشد';
            $noty = new Notification;
            $noty->content = $content;
            $noty->reciver_id = $user->id;
            $noty->save();
        }
    }
}
