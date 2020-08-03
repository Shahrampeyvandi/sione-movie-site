<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function Login()
    {
        $data['title'] = 'ورود';
        return view('Front.login', $data);
    }

    public function Verify(Request $request)
    {
        
        $rules = array(
            'mobile'             => 'required',
            'password'         => 'required | min:8',
        );
        $messages = array(
            'mobile.required'             => 'شماره همراه الزامی است',
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('login')
                ->withErrors($validator);
        }

        $member = User::where('mobile', $request->mobile)->first();
        if ($member) {
            if (Hash::check($request->password, $member->password)) {
                Auth::Login($member);
                if (Auth::user()->plans()->count()) {
                    return redirect()->route('MainUrl');
                } else {
                    return redirect()->route('S.BuyPlan');
                }
            } else {
                return Redirect::back()->withErrors(['رمز عبور اشتباه است']);
            }
        } else {
            return Redirect::back()->withErrors(['کاربری با این شماره موبایل وجود ندارد']);
        }
    }

    public function Register(Request $request)
    {

        $rules = array(
            'mobile'             => 'required | unique:users,mobile',
            'password'         => 'required | min:8',
            'fname' => 'required',
            'lname' => 'required'
        );
        $messages = array(
            'mobile.required'             => 'شماره همراه الزامی است',
            'mobile.unique'             => 'متاسفانه کابری با این شماره تماس ثبت نام کرده است',
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('login')
                ->withErrors($validator);
        }


        $user = User::create([
            'mobile' => $request->mobile,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            Auth::login($user);

            // send sms

            return redirect()->route('S.SiteSharing');
        } else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
