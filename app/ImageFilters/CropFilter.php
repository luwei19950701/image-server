<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class CropFilter implements FilterInterface
{
    use HandleParams;

    private $w;

    private $h;

    private $x=0;

    private $y=0;

    private $g;

    public function __construct($params = [])
    {
        $this->handleParams($params);
    }

    public function applyFilter(Image $image)
    {
        $width = $image->width();
        $height = $image->height();
        $oneThirdWidth = round($width/3);
        $oneThirdHeight = round($height/3);

        if($this->g){
            $grid = [
                'nw' => [0, 0],
                'north' => [1, 0],
                'ne' => [2, 0],
                'west' => [1, 0],
                'center' => [1, 1],
                'east' => [1, 2],
                'sw' => [2, 0],
                'south' => [2, 1],
                'se' => [2, 2],
            ];
            $this->x += $oneThirdWidth*$grid[$this->g][0];
            $this->y += $oneThirdHeight*$grid[$this->g][1];
        }

        if($this->x > $width || $this->y > $height) {
            $image = Image::canvas(0, 0);
            return $image;
        }

        $this->w = min($width-$this->x, $this->w);
        $this->h = min($height-$this->y, $this->h);

        $image->crop($this->w, $this->h, $this->x, $this->y);
        return $image;
    }
}