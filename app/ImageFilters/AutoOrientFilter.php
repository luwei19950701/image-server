<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class AutoOrientFilter implements FilterInterface
{
    use HandleParams;

    private $value;

    public function __construct($params)
    {
        $this->value = $params[0];
    }

    public function applyFilter(Image $image)
    {
        if ($this->value == '1') {
            $image->orientate();
        }
        return $image;
    }
}