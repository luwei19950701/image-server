<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class CircleFilter implements FilterInterface
{
    use HandleParams;

    private $r;

    public function __construct($params = [])
    {
        $this->handleParams($params);
    }

    public function applyFilter(Image $image)
    {
        $halfOriginalHeight = round($image->height()/2);
        $halfOriginalWidth = round($image->width()/2);
        $this->r = min($this->r, $halfOriginalWidth, $halfOriginalHeight);
        $image->crop($this->r*2, $this->r*2, $halfOriginalWidth-$this->r, $halfOriginalHeight-$this->r);
        $mask = \Image::canvas($this->r*2, $this->r*2, [0,0,0,0]);
        $mask->circle($this->r*2, $this->r, $this->r, function ($draw) {
            $draw->background('#ffffff');
        });
        $image->mask($mask, true);
        return $image;
    }
}