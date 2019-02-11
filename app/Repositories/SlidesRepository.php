<?php

namespace Corp\Repositories;

use Corp\Slider;

class SlidesRepository extends Repository
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }


}