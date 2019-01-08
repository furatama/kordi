<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemilih extends Model
{
    use SoftDeletes;

	public $table = "pemilih";
    protected $primaryKey = "id";
    protected $guarded = array('kontak2','kontak3');
    protected $dates = ['deleted_at'];

    public function koorl1()
    {
        return $this->belongsTo('App\KoorL2','idl2','id')->belongsTo('App\KoorL1','idl1','id');
    }

    public function koorl2()
    {
        return $this->belongsTo('App\KoorL2','idl2','id');
    }

    public function banjar()
    {
        return $this->hasOne('App\Banjar','id','idbanjar');
    }

    public function desa()
    {
        return $this->hasOne('App\Desa','id','iddesa');
    }

    public function tps()
    {
        return $this->hasOne('App\TPS','id','idtps');
    }
}
