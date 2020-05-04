<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    public function phims(){
        return $this->belongsToMany('App\Phim','tag_the_loais','the_loais_id','phims_id');
    }
}
