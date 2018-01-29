<?php

namespace App\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ResizeFilter implements FilterInterface
{
    use HandleParams;

    private $m;

    private $w;

    private $h;

    private $limit = '1';

    private $color = 'FFFFFF';

    private $p;

    public function __construct($params = [])
    {
        $this->handleParams($params);
    }

    public function applyFilter(Image $image)
    {
        $limitFunction = function ($constraint) {
            if($this->limit == '1') $constraint->upsize();
        }; // 指定当目标缩略图大于原图时是否处理。
        $ratioLimitFunction = function ($constraint) use ($limitFunction) {
            $constraint->aspectRatio();
            $limitFunction($constraint);
        }; // 保持比例，并指定当目标缩略图大于原图时是否处理。

        $originalHeight = $image->height();
        $originalWidth = $image->width();
        $deviation = $originalWidth * $this->h > $originalHeight * $this->w;

        if($this->p && $this->p > 0){
            $image->resize($originalWidth/100*$this->p, null, $ratioLimitFunction);
            return $image;
        }

        if(!$this->w || !$this->h) {
            $image->resize($this->w, $this->h, $ratioLimitFunction);// w或h, 只有一个，保持比例单边缩放
            return $image;
        }

        switch($this->m){
            case 'mfit':
                if($deviation){
                    $image->resize(null, $this->h, $ratioLimitFunction);
                } else {
                    $image->resize($this->w, null, $ratioLimitFunction);
                }
                break;
            case 'lfit':
                if($deviation){
                    $image->resize($this->w, null, $ratioLimitFunction);
                } else {
                    $image->resize(null, $this->h, $ratioLimitFunction);
                }
                break;
            case 'fill':
                if($deviation){
                    $image->resize(null, $this->h, $ratioLimitFunction);
                } else {
                    $image->resize($this->w, null, $ratioLimitFunction);
                }
                $image->resizeCanvas($this->w, $this->h);
                break;
            case 'pad':
                if($deviation){
                    $image->resize($this->w, null, $ratioLimitFunction);
                } else {
                    $image->resize(null, $this->h, $ratioLimitFunction);
                }
                $image->resizeCanvas($this->w, $this->h, 'center', false, $this->color);
                break;
            default: // 等同于fixed
                $image->resize($this->w, $this->h, $limitFunction);
        }

        return $image;
    }
}