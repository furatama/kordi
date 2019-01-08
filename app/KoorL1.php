<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KoorL1 extends Model
{
	use SoftDeletes;

	public $table = "koorl1";
	protected $primaryKey = "id";
    protected $guarded = array('kontak2','kontak3');
    protected $dates = ['deleted_at'];

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

    public function koorl2()
    {
        return $this->hasMany('App\KoorL2','idl1','id');
    }    

    public function pemilih()
    {
        return $this->hasManyThrough(
            'App\Koorl2',
            'App\Pemilih',
            'idl2', // Foreign key on users table...
            'idpemilih', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}
