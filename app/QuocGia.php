<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuocGia extends Model
{
    public function phims(){
        return $this->hasMany('App\Phim','quocgias_id');
    }
}
