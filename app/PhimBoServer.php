<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhimBoServer extends Model
{
    public function phim(){
        return $this->belongsTo('App\Phim','phims_id');
    }
}
