<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class IndexCropFilter implements FilterInterface
{
    use HandleParams;

    private $x;

    private $y;

    private $i=0;


    public function __construct($params = [])
    {
        $this->handleParams($params);
    }

    public function applyFilter(Image $image)
    {
        $width = $image->width();
        $height = $image->height();
        if(!$this->x && !$this->y){
            return $this->throwError("参数错误");
        } elseif ($this->y){
            $startY = $this->y * ($this->i);
            if($startY > $height){
                return $image;
            }
            $maxCropHeight = min($height-$startY, $this->y);
            $image->crop($width, $maxCropHeight, 0, $startY);
            return $image;
        } else {
            $startX = $this->x * ($this->i);
            if($startX > $width){
                return $image;
            }
            $maxCropWidth = min($width-$startX, $this->x);
            $image->crop($maxCropWidth, $height, $startX, 0);
            return $image;
        }
    }
}