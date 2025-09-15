<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    protected $table = "kategorija";

    protected $primaryKey = "Kategorija_ID";
    public $timestamps = false;

    protected $guarded=[];
}
