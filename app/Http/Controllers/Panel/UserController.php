<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function list()
    {
        $users = User::all();

        return view('Panel.Users.Lists', compact('users'));
    }
    public function Delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json('کاربر با موفقیت حذف شد');
    }

    public function Add(Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->save();

        toastr()->success('کاربر با موفقیت اضافه شد');
        return back();

    }

    public function Edit(User $user)
    {
        return view('Panel.Users.Edit',['user'=>$user]);
    }

     public function SaveEdit(Request $request ,User $user)
    {
       
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        if($request->password && !is_null($request->password)){
            $user->password =  Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->expire_date = $this->convertDate($request->date);
        $user->update();

        toastr()->success('کاربر با موفقیت ویرایش شد');
        return back();

    }


}
