<?php

namespace CodePub\Repositories;


trait BaseRepositoryTrait
{
    public function lists($colum, $key = null)
    {
        $this->applyCriteria();

        return $this->model->pluck($colum, $key);
    }
}