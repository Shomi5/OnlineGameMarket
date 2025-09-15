<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izdavac extends Model
{
    protected $table = "izdavac";

    protected $primaryKey = "Izdavac_ID";
    public $timestamps = false;

    protected $guarded=[];
}
