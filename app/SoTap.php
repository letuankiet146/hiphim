<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoTap extends Model
{
    public function phim(){
        return $this->belongsTo('App/Phim','sotaps_id');
    }
}
