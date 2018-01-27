<?php
namespace App\ImageFilters;

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
}