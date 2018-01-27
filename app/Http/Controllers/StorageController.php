<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{

    private $format;

    public function images(Request $request, $path)
    {
        $xOssProcess = $request->query('x-oss-process');
        $filterStrings = explode('/', $xOssProcess);
        array_shift($filterStrings);
        $image = \Image::make(public_path($path));
        foreach ($filterStrings ?? [] as $filterString){
            $filterStringToArray = explode(',', $filterString);
            $filter = array_shift($filterStringToArray);
            if($filter === 'format') {
                $this->format = $filterStringToArray[0];
            } else {
                $classPath = '\App\ImageFilters\\'.ucfirst($filter).'Filter';
                $image->filter(new $classPath($filterStringToArray));
            }
        }
        return $image->response($this->format ?: $image->extension);
    }
}
