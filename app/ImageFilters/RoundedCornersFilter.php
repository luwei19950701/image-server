<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class RoundedCornersFilter implements FilterInterface
{
    use HandleParams;

    private $r;

    public function __construct($params = [])
    {
        $this->handleParams($params);
    }

    public function applyFilter(Image $image)
    {
        $width = $image->width();
        $height = $image->height();
        $mask = \Image::canvas($width, $height);
        $r = min(round($width/2), round($height/2), $this->r);
        $widthMinusR = $width - $r;
        $heightMinusR = $height - $r;

        $drawFunction = function ($draw) {
            $draw->background('#000000');
        };
        $mask->circle($r*2, $r, $r, $drawFunction)
            ->circle($r*2, $r, $heightMinusR, $drawFunction)
            ->circle($r*2, $widthMinusR, $r, $drawFunction)
            ->circle($r*2, $widthMinusR, $heightMinusR, $drawFunction)
            ->rectangle(0, $r, $r, $heightMinusR, $drawFunction)
            ->rectangle($r, 0, $widthMinusR, $height, $drawFunction)
            ->rectangle($widthMinusR, $r, $width, $heightMinusR, $drawFunction);

        $image->mask($mask, true);
        return $image;
    }
}