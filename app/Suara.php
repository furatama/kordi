<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suara extends Model
{
    public $table = "suara";
		protected $primaryKey = "id";
    protected $guarded = [];

    public function tps()
    {
        return $this->hasOne('App\TPS','id','idtps');
    }

    public function caleg()
    {
        return $this->hasOne('App\Caleg','id','idcaleg');
    }
}
