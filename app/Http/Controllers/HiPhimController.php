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
        $phims = Phim::all();
        return view("index" ,compact('phims'));
    }

    public function detail ($id){
        $phim = Phim::find($id);
        $theloais = $phim->theloais;
        return view("detail",compact('phim','theloais'));
    }

    public function xemphim ($id){
        $phim = Phim::find($id);
        return view("xemphim",[
            'phim' => $phim
        ]);
    }
}
