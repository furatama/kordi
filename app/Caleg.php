<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caleg extends Model
{
    use SoftDeletes;

    public $table = "caleg";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function partai()
    {
        return $this->hasOne('App\Partai','id','idpartai');
    }

    // public function desa()
    // {
    //     return $this->hasOne('App\Desa','id','iddesa');
    // }

    // public function tps()
    // {
    //     return $this->hasOne('App\TPS','id','idtps');
    // }

}
