<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DienVien extends Model
{
    public function phims(){
        return $this->belongsToMany('App\Phim','tag_dien_viens','dien_viens_id','phims_id');
    }
}
