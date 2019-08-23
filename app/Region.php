<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Region extends Model
{
    protected $primaryKey = 'region_id';
    public $incrementing = false;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regions';

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->region_id = (string) Uuid::generate(4);
        });
    }
}
