<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    public function phims(){
        return $this->belongsToMany('App\Phim','tag_binh_luans','binh_luans_id','phims_id');
    }
}
