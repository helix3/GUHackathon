<?php namespace Hack;

use Illuminate\Support\Str;
use Jenssegers\Mongodb\Model;

class SasList extends Model
{

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

        'save' => array(),

        'create' => array(),

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
        'event_id',
        'date',
        'country',
        'city',
        'lat',
        'long',
        'body',
        'attack_type',
        'attack_type_id',
        'target_type',
        'target_type_id',
        'group_name',
        'motive',
        'weapons',
        'weapon_id',
        'cost',
        'notes',
    );

}
