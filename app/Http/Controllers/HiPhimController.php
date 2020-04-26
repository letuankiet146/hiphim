<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phim;
use App\DanhMuc;
use App\TheLoai;
use App\TagTheLoai;
use DB;

class HiPhimController extends Controller
{
    public function ui(){
        $sliderTop = [];
        $phims = DB::table('phims')
        ->where('danhmucs_id', '=', "4")
        ->get();
        return view("index" ,compact('phims'));
    }

    public function detail (){
        return view("detail");
    }

    public function xemphim (){
        return view("xemphim");
    }
}
