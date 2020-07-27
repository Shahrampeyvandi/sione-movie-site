<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Show()
    {
        return view('Panel.Setting.Show');
    }

    public function Save(Request $request)
    {
        dd($request->all());
    }
}
