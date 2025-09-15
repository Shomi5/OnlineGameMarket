<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kljuc extends Model
{
    protected $table = "kljuc";

    protected $primaryKey = "Kljuc_ID";
    public $timestamps = false;

    protected $guarded=[];
}
