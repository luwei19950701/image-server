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

    public function draw()
    {
        $width = 500;
        $height = 400;
        $r = 50;
        $color = '#000000';
        $image = \Image::canvas(500, 400);
        $r = min(round($width/2), round($height/2), $r);
        $drawFunction = function ($draw) use ($color) {
            $draw->background($color);
        };
        $image->circle($r*2, $r, $r, $drawFunction)
            ->circle($r*2, $r, $height-$r, $drawFunction)
            ->circle($r*2, $width-$r, $r, $drawFunction)
            ->circle($r*2, $width-$r, $height-$r, $drawFunction)
            ->rectangle(0, $r, $r, $height-$r, $drawFunction)
            ->rectangle($r, 0, $width-$r, $height, $drawFunction)
            ->rectangle($width-$r, $r, $width, $height-$r, $drawFunction);
        return $image->response('png');
    }
}
