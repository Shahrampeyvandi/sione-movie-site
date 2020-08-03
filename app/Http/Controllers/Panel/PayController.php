<?php

namespace App\Http\Controllers\Panel;

use App\Plan;
use App\Payment;
use App\User;
use App\Notification;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PayController extends Controller
{
    public function pay(Request $request)
    {
        //برای تست کردن مقدار دیباگ مد رو روی یک قررا بده وگرنه صفر
        $debugmode = 1;
        $user = auth()->user();
        $plan = Plan::find($request->plan);


        $payment = new Payment;
        $payment->user_id = $user->id;
        $payment->plan_id = $plan->id;
        $payment->amount = $plan->price;
        $payment->save();

        $data = array(
            'MerchantID' => '9cdad844-c97a-11e9-ab10-000c295eb8fc',
            'Amount' => $payment->amount,
            'CallbackURL' => route('Pay.CallBack') . '?id=' . $payment->id,
            'Description' => 'پرداخت از سایت'
        );
        $jsonData = json_encode($data);
        if ($debugmode == 1) {
            $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        } else {
            $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {

                if ($debugmode == 1) {
                    $link = 'https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"];
                } else {
                    $link = 'https://www.zarinpal.com/pg/StartPay/' . $result["Authority"];
                }

                return redirect($link);


                die();
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }
    }

    public function callback(Request $request)
    {
        //برای تست کردن مقدار دیباگ مد رو روی یک قررا بده وگرنه صفر
        $debugmode = 1;

        $payment = Payment::find($request->id);

        $Authority = $request->Authority;

        $data = array('MerchantID' => '26630526-5b97-44c5-b713-aa8777b7a915', 'Authority' => $Authority, 'Amount' => $payment->amount);
        $jsonData = json_encode($data);
        if ($debugmode == 1) {
            $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        } else {
            $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                //echo 'Transation success. RefID:' . $result['RefID'];

                $payment->success = 1;
                $payment->transaction_code = $result['RefID'];
                $payment->update();

                // برای ارسال پیامک ثبت خرید اشتراک
                $patterncode = "97b8c9m9a5";
                $data = array("name" => auth()->user()->first_name, "number" => Plan::find($payment->plan_id)->name);
                $this->sendSMS($patterncode, auth()->user()->mobile, $data);

                // به اعتبارش اضافه کن
                // تراکنش موفق بود هر جا می خوای ریدایرکتش کن

            } else {

                // تراکنش ناموفق بوده

            }
        }
    }
}