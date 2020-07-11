<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaoLoi extends Model
{
    public function phim(){
        return $this->belongsTo('App\Phim','phims_id');
    }
}
