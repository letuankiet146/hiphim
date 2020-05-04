<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phim;
use App\DanhMuc;
use App\TheLoai;
use App\QuocGia;
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

    public function more($category, $data){
        define("PAGEINATE", 2);
        $phims=null;
        $title = "Hi Phim";
        switch ($category) {
            case 'the-loai':
                $theloais  = TheLoai::from('the_loais')
                ->where('tentheloai', 'LIKE', "%".urldecode($data)."%");
                if($theloais->exists()){
                    $title = $theloais->first()->tentheloai;
                    $phims = $theloais->first()->phims()->paginate(PAGEINATE);
                }
                break;
            case 'danh-muc':
                $danhmucs = DanhMuc::from('danh_mucs')
                ->where('tendanhmuc','LIKE',"%".urldecode($data)."%");
                if($danhmucs->exists()){
                    $title = $danhmucs->first()->tendanhmuc;
                    $phims = $danhmucs->first()->phims()->paginate(PAGEINATE);
                }
                break;
            case 'quoc-gia':
                $quocgias = QuocGia::from('quoc_gias')
                ->where('tenquocgia', 'LIKE', "%".urldecode($data)."%");
                if($quocgias->exists()){
                    $title = $quocgias->first()->tenquocgia;
                    $phims = $quocgias->first()->phims()->paginate(PAGEINATE);
                }
                break;
            case 'top-imdb':
                $phims = Phim::from('phims')
                ->where('imdb','>',$data)
                ->paginate(PAGEINATE);
                $title = "Top IMDB";
                break;
        }
        $hasPage = $phims->hasPages();
        $pageLink;
        $currentPageNumber;
        if($hasPage){
            $pageLink = $phims->getUrlRange(1,$phims->perPage());
            $currentPageNumber = $phims->currentPage();
        }
        return view('more',[
            "phims"=>$phims,
            "title"=>$title,
            "currentPageNumber"=>$currentPageNumber,
            "pageLink"=>$pageLink
        ]);
    }
}
