<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Arduino
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Eloquent
 */

class Arduino extends Model
{
    use SoftDeletes;

    protected $table = 'arduinos';
    protected $dates = ['deleted_at'];

    public function zona()
    {
        return $this->belongsTo('App\Zona','zonas_id');
    }
}
