<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyKomunitas extends Model
{
    use SoftDeletes;

    public $table = "keykomunitas";
    protected $primaryKey = "id";
    protected $guarded = [];

}
