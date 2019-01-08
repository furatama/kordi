<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banjar extends Model
{
		protected $primaryKey = "id";
    public $table = "banjar";
    protected $guarded = [];

    public function desa()
    {
    		return $this->belongsTo('App\Desa','iddesa','id');
    }
}
