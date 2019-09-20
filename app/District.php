<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class District extends Model
{
    protected $primaryKey = 'district_id';
    public $incrementing = false;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'districts';

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->district_id = (string) Uuid::generate(4);
        });
    }

    /**
     * One To One - Field
     */
    public function province()
    {
        return $this->hasOne('App\Province', 'province_id', 'province_id');
    }

    /**
     * One To One - Field
     */
    public function user()
    {
        return $this->hasOne('App\User', 'user_id', 'user_id');
    }
}
