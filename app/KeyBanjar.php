<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyBanjar extends Model
{

	use SoftDeletes;

    public $table = "keybanjar";
    protected $primaryKey = "id";
    protected $guarded = [];
    //
}
