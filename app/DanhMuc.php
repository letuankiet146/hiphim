<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    public function phims() {
        return $this->hasMany('App\Phim','danhmucs_id');
    }
}
