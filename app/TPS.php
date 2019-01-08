<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPS extends Model
{
		protected $primaryKey = "id";
    public $table = "tps";
    protected $guarded = [];

    public function banjar()
    {
    		return $this->belongsTo('App\Banjar','idbanjar','id');
    }
}
