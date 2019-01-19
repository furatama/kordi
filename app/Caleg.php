<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caleg extends Model
{
    use SoftDeletes;

    public $table = "partai";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    // public function banjar()
    // {
    //     return $this->hasOne('App\Banjar','id','idbanjar');
    // }

    // public function desa()
    // {
    //     return $this->hasOne('App\Desa','id','iddesa');
    // }

    // public function tps()
    // {
    //     return $this->hasOne('App\TPS','id','idtps');
    // }

}
