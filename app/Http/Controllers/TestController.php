<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function upload(Request $request)
    {
        if($request->isMethod('post')){
            $path = $request->file('file')->store('images/'.date('ymd'), 'public');
            dd($path);
        } else {
            return view('test/upload');
        }
    }
}
