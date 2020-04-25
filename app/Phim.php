<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    protected $attributes = array(
        'luotxem' => 0
      );

    public function danhmuc(){
        return $this->belongsTo('App\DanhMuc','danhmucs_id');
    }

    public function theloais(){
        return $this->belongsToMany('App\TheLoai','tag_the_loais','phims_id','the_loais_id');
    }

    public function binhluans(){
        return $this->belongsToMany('App\BinhLuan','tag_binh_luans','phims_id','binh_luans_id');
    }
}
