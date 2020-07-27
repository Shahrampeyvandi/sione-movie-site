<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

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
}
