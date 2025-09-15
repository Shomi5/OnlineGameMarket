<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    protected $table = "rezervacija";

    protected $primaryKey = "Rezervacija_ID";
    public $timestamps = false;

    protected $guarded=[];
}
