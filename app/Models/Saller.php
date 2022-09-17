<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saller extends Model
{
    protected $table = 'saller';
    public $timestamps = false;
    protected $primaryKey = 'sid';

    public function route(){
        return $this->hasOne('App\Models\Route','rid','route_id');
    }

}
