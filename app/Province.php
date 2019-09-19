<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Province extends Model
{
    protected $primaryKey = 'province_id';
    public $incrementing = false;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provinces';

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->province_id = (string) Uuid::generate(4);
        });
    }

    /**
     * One To One - Field
     */
    public function region()
    {
        return $this->hasOne('App\Region', 'region_id', 'region_id');
    }
}
