<?php namespace Hack;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SasList extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection = 'sas_list';

    /**
     * Users table rules
     *
     * @var array
     */
    public $rules = array(

        'save' => array(

        ),

        'create' => array(

        ),

        'update' => array()

    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );

    /**
     * Fillable values
     *
     * @var array
     */
    public $fillable = array(
        'title',
        'open',
        'users',
        'status',
        'user_id',
        'created_by'
    );

}
