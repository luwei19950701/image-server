<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class RotateFilter implements FilterInterface
{
    use HandleParams;

    private $value=0;

    public function __construct($params)
    {
        $this->value = $params[0];
    }

    public function applyFilter(Image $image)
    {
        $image->rotate($this->value);
        return $image;
    }
}