<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoIgra extends Model
{
    protected $table = "video_igra";

    protected $primaryKey = "Igra_ID";
    public $timestamps = false;

    protected $guarded=[];
}
