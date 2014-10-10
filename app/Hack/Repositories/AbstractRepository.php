<?php namespace Hack\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use StdClass;

abstract class AbstractRepository {
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Construct
     *
     * @param \Illuminate\Support\MessageBag|\Synergy\Repositories\Illuminate\Support\MessageBag $errors
     */
    public function __construct(MessageBag $errors)
    {
        $this->errors = $errors;
    }
    /**
     * Start a transaction
     *
     * @param  boolean $action
     * @return void
     */
    public function beginTransaction($action = false)
    {
        if ($action) DB::beginTransaction();
    }

    /**
     * Rollback a transaction
     *
     * @param  boolean $action
     * @return void
     */
    public function rollbackTransaction($action = false)
    {
        if ($action) DB::rollback();
    }

    /**
     * Commit a transaction
     *
     * @param  boolean $action
     * @return void
     */
    public function commitTransaction($action = false)
    {
        if ($action) DB::commit();
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Retrieve all entities
     *
     * @param array $with
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        $entity = $this->make($with);

        return $entity->get();
    }

    /**
     * Find a single entity
     *
     * @param int $id
     * @param array $with
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        $entity = $this->make($with);

        return $entity->find($id);
    }

    /**
     * Find a single entity by key and value
     *
     * @param        $key
     * @param        $value
     * @param  array $with
     *
     * @internal param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findBy($key, $value, array $with = array())
    {
        return $this->getBy($key, $value, $with)->first();
    }

    /**
     * Find a single entity by key and value
     *
     * @param array $array
     * @param  array $with
     *
     * @internal param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findByMany(array $array, array $with = array())
    {
        return $this->getByMany($array, $with)->first();
    }

    /**
     * Get Results by Page
     *
     * @param int $page
     * @param int $limit
     * @param array $with
     *
     * @internal param $key
     * @internal param $value
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, $with = array())
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->make($with);

        $users = $query->skip($limit * ($page - 1))->take($limit)->get();

        $result->totalItems = $this->model->count();
        $result->count = $users->count();
        $result->items = $users;

        return $result;
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     *
     * @return Illuminate\Database\Query\Builders
     */
    public function getBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     *
     * @return Illuminate\Database\Query\Builders
     */
    public function getIn($key, array $value = array(), array $with = array())
    {
        return $this->make($with)->whereIn($key, $value)->get();
    }

    /**
     * Search for many results by key and value
     *
     * @param array $where
     * @param array $with
     *
     * @param null $order
     * @internal param null $type
     *
     * @internal param string $key
     * @internal param mixed $value
     * @return Illuminate\Database\Query\Builders
     */
    public function getByMany(array $where, array $with = array(), $order = NULL)
    {
        $entity = $this->make($with);

        foreach ($where as $key => $value) {

            if (count($value) == 2) {

                list($key, $val) = $value;
                $o = '=';

            } else {

                list($key, $o, $val) = $value;

            }

            $entity->where($key, $o, $val);

        }

        if ($order) {
            $entity->orderBy($order[0], $order[1]);
        }

        return $entity->get();
    }

    /**
     * Get Results by Page
     *
     * @param $where
     * @param int $page
     * @param int $limit
     * @param array $order
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByManyByPage($where, $page = 1, $limit = 10, array $order = array(), $with = array())
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        // Get the data
        $entity = $this->make($with);
        foreach ($where as $key => $value) {

            if ($value instanceof \Closure) {
                $entity->where($value);
                continue;
            }

            if (count($value) == 2) {

                list($key, $val) = $value;
                $o = '=';

            } else {

                list($key, $o, $val) = $value;

            }

            $entity->where($key, $o, $val);

        }

        $count = $entity->count();

        $entity->skip($limit * ($page - 1))->take($limit);

        if (!empty($order)) $entity->orderBy($order[0], $order[1]);

        $data = $entity->get();

        $result->totalItems = $count;
        $result->count = $data->count();
        $result->items = $data;

        return $result;
    }

    /**
     * Get Results by Page
     *
     * @param $where
     * @param int $page
     * @param int $limit
     * @param array $order
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByManyOrWhereByPage($where, $page = 1, $limit = 10, array $order = array(), $with = array(), $orWhere = array())
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        // Get the data
        $entity = $this->make($with);
        foreach ($where as $key => $value) {

            if ($value instanceof \Closure) {
                $entity->where($value);
                continue;
            }

            if (count($value) == 2) {

                list($key, $val) = $value;
                $o = '=';

            } else {

                list($key, $o, $val) = $value;

            }

            $entity->where($key, $o, $val);

        }

        foreach ($orWhere as $key => $value) {

            if ($value instanceof \Closure) {
                $entity->orWhere($value);
                continue;
            }

            if (count($value) == 2) {

                list($key, $val) = $value;
                $o = '=';

            } else {

                list($key, $o, $val) = $value;

            }

            $entity->orWhere($key, $o, $val);

        }

        $count = $entity->count();

        $entity->skip($limit * ($page - 1))->take($limit);

        if (!empty($order)) $entity->orderBy($order[0], $order[1]);

        $data = $entity->get();

        $result->totalItems = $count;
        $result->count = $data->count();
        $result->items = $data;

        return $result;
    }

    /**
     * Build paging of an Eloquent Collection
     *
     * @param                                          $page
     * @param                                          $limit
     * @param                                          $total
     * @param \Illuminate\Database\Eloquent\Collection $collection
     *
     * @internal param $ [type] $page       [description]
     * @internal param $ [type] $limit      [description]
     * @internal param $ [type] $collection [description]
     *
     * @return \StdClass [type]             [description]
     */
    public function buildPaging($page, $limit, $total, \Illuminate\Database\Eloquent\Collection $collection)
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $result->totalItems = $total;
        $result->items = $collection;
        $result->count = $collection->count();

        return $result;
    }

    /**
     * Create an entity
     *
     * @param array $data
     *
     * @param bool $return_id
     *
     * @return mixed
     */
    public function insert(array $data, $return_id = true)
    {
        $entity = $this->make(array());

        if ($return_id) {
            return $entity->insertGetId($data);
        }

        return $entity->insert($data);
    }

    /**
     * Create an entity
     *
     * @param array $data
     *
     * @param array $rules
     *
     * @return mixed
     */
    public function create(array $data, array $rules = array())
    {
        // Grab the entity
        $entity = $this->model->newInstance();

        // Loop through and attach the input
        foreach ($data as $key => $value) {

            $entity->$key = $value;

        }

        // Did it pass?
        $done = $entity->save();

        if ($done) {
            return $entity->id;
        }

        return $entity;
    }

    /**
     * Upsert and item
     *
     * Mongo db related
     *
     * @param  array $data
     *
     * @param null $id
     *
     * @internal param string $key
     * @internal param string $value
     * @return boolean
     */
    public function upsert(array $data = array(), $id = NULL)
    {
        // Unset the ID if it is there
        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }
        //$done = $this->model->where($key, $value)->update($data, array('upsert' => true));

        $entity = NULL;

        if ($id) {

            $entity = $this->model->find($id);

        }

        // We don't have an entity, get a scaffold
        if (!$entity) {
            $entity = $this->model->newInstance();
        }

        // Loop through and attach the input
        foreach ($data as $key => $value) {

            $entity->$key = $value;

        }

        // Did it pass?
        $done = $entity->save();

        if ($done) {
            return $entity->id;
        }

        return $entity;
    }

    /**
     * Upsert and item
     * Mongo db related
     *
     * @param        $id
     * @param  array $data
     *
     * @param array $rule_changes
     * @internal param string $key
     * @internal param string $value
     * @return boolean
     */
    public function update($id, array $data = array(), $rule_changes = array())
    {
        // Unset the ID if it is there
        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }
        //---------------------------------------------------
        //
        //---- This is set in the User model as a setter ----
        //
        // if (array_key_exists('password', $data)) {
        // $data['password'] = \Hash::make($data['password']);
        // }
        //
        // --------------------------------------------------
        //$done = $this->model->where($key, $value)->update($data, array('upsert' => true));

        $entity = $this->model->find($id);


        // We don't have an entity, get a scaffold
        if (!$entity) return 0;

        if (count($rule_changes) > 0) {

            foreach ($rule_changes as $key => $value) {

                foreach ((array)$value as $rule) {
                    $this->model->{$key . 'Rule'}($rule);
                }

            }

        }

        // Loop through and attach the input
        foreach ($data as $key => $value) {

            $entity->$key = $value;

        }

        //$entity->updateUniques();

        // Did it pass?
        $done = $entity->save();

        if ($done && !is_object($done)) {
            return 1;
        }

        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->model->find($id);

        return $entity ? $entity->delete() : NULL;
    }
}