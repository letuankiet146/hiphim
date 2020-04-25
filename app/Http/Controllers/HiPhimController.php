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
        return view("index");
    }

    public function detail (){
        return view("detail");
    }

    public function xemphim (){
        return view("xemphim");
    }
}
