<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
		protected $primaryKey = "id";
    public $table = "desa";
    protected $guarded = [];

    public function koorl1()
    {
        return $this->hasMany('App\KoorL1','id','iddesa');
    }

    public function kecamatan()
    {
    		return $this->belongsTo('App\Kecamatan','idkecamatan','id');
    }

}
