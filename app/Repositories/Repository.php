<?php

namespace Corp\Repositories;

abstract class Repository
{
    protected $model = false;

    public function get($select = '*', $take = false)
    {
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        return $builder->get();
    }
}