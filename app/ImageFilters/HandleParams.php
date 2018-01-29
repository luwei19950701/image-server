<?php
namespace App\ImageFilters;
use Intervention\Image\Image;

trait HandleParams
{
    public function handleParams($params)
    {
        foreach ($params as $param){
            $paramToArray = explode('_', $param);
            $attr = $paramToArray[0];
            $this->$attr = $paramToArray[1];
        }
    }

    public function throwError($message)
    {
        if(config('app.debug')){
            throw new \Exception($message);
        } else {
            $image = Image::canvas(0, 0);
            return $image;
        }
    }
}