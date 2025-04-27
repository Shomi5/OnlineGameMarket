<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kupovina extends Model
{
    protected $table = "kupovina";

    public $timestamps = false;
    
    protected $primaryKey = "Kupovina_ID";

    protected $guarded=[];
}
