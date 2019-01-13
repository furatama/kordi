<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyBanjar extends Model
{

	use SoftDeletes;

    public $table = "keybanjar";
    protected $primaryKey = "id";
    protected $guarded = [];
    //
    
    public function banjar()
    {
        return $this->hasOne('App\Banjar','id','idbanjar');
    }

    public function desa()
    {
        return $this->hasOne('App\Desa','id','iddesa');
    }
}
