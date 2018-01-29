<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{

    private $format;

    public function images(Request $request, $path)
    {
        $xOssProcess = $request->query('x-oss-process');
        $noCache = $request->exists('nocache');
        if($noCache){
            return $this->getImage($xOssProcess, $path);
        }
        $leftTime = 30*24*60;
        return \Cache::remember($path.':'.$xOssProcess, $leftTime, function() use ($xOssProcess, $path) {
            return $this->getImage($xOssProcess, $path);
        });

    }

    private function getImage($xOssProcess, $path) {
        $filterStrings = explode('/', $xOssProcess);
        array_shift($filterStrings);
        $image = \Image::make(public_path($path));
        foreach ($filterStrings ?? [] as $filterString){
            $filterStringToArray = explode(',', $filterString);
            $filter = array_shift($filterStringToArray);
            if($filter === 'format') {
                $this->format = $filterStringToArray[0];
            } else {
                $classPath = '\App\ImageFilters\\'.studly_case($filter).'Filter';
                $image->filter(new $classPath($filterStringToArray));
            }
        }
        return $image->response($this->format ?: $image->extension);
    }

    public function upload(Request $request)
    {
        $path = $request->file('file')->store('images/'.date('ymd'), 'public');
        $path = '/storage'.$path;
        return response()->json(compact('path'));
    }
}
