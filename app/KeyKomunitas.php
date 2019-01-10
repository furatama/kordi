<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyKomunitas extends Model
{
    use SoftDeletes;

    public $table = "keykomunitas";
    protected $primaryKey = "id";
    protected $guarded = [];

}
