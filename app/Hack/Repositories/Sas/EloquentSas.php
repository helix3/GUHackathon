<?php namespace Hack\Repositories\Sas;

use Hack\Repositories\AbstractRepository;
use Jenssegers\Mongodb\Model;

class EloquentSas extends AbstractRepository implements SasInterface  {
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    function __construct(Model $model)
    {
        $this->model = $model;
    }
}