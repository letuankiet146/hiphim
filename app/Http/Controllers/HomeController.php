<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoStream;
use App\Phim;
use App\DanhMuc;
use App\TheLoai;
use App\TagTheLoai;
use DB;

class HomeController extends Controller
{
    public function admin()
    {
        $danhmucs = DanhMuc::all();
        $theloais = TheLoai::all();
        $danhmucArray=[];
        foreach($danhmucs as $danhmuc){
            $danhmucArray[$danhmuc->id] = $danhmuc->tendanhmuc;
        }
        $danhmucKeys = array_keys($danhmucArray);
        $theloaiArray = [];
        foreach($theloais as $theloai){
            $theloaiArray[$theloai->id] = $theloai->tentheloai;
        }
        $theloaiKeys = array_keys($theloaiArray);

        return view('admin',compact('danhmucArray'
                                    ,'danhmucKeys'
                                    ,'theloaiArray'
                                    ,'theloaiKeys'));
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function fixBadUnicode($str) {
        return preg_replace_callback("/u00([0-9a-f]{2})/",
        function ($matches) {
            foreach ($matches as $charnum) {
                $charnum = ltrim($charnum,"u");
                $a = chr(hexdec($charnum));
                $result = $a;
            }
            return $result;
        }, $str);
    }

    public function live()
    {
        $linkarray=[];
        $films = Phim::all();
        foreach($films as $film){
            $name = $film->tenphim;
            $url  = $film->url;
            $linkarray[$name] = $url;
        };
        $keys = array_keys($linkarray);
        return view("live",compact('linkarray','keys'));
    }

    public function insertFilm(Request $request){

        $poster = $request->file('poster');
        $posterName = $poster->getClientOriginalName();
        $poster->move(public_path('img'), $posterName);

        $bg = $request->file('bg');
        $bgName = $bg->getClientOriginalName();
        $bg->move(public_path('img'), $bgName);

        $phim = new Phim();
        $phim->tenphim = $request->tenphim;
        $phim->poster = $posterName;
        $phim->background = $bgName;
        $phim->mota = $request->mota;
        $phim->danhmucs_id = $request->danhmucId;
        $phim->url = $request->url;
        $phim->fb = $request->fb;
        $phim->imdb = $request->imdb;
        $phim->ngaytao=date("yy-m-d");
        $phim->save();
        $tagTheLoai = new TagTheLoai();
        $tagTheLoai->phims_id =$phim->id;
        $tagTheLoai->the_loais_id = $request->theloaiId;
        $tagTheLoai->save();

        return redirect('/admin');
    }

    public function updateFilm(Request $request){
        $url = $request->url;
        $fb = $request->fb;
        $id = $request->id;
        DB::table('film')
            ->where('id',$id)
            ->update(["url"=>$url]);
        return redirect('/testlink');
    }

    public function searchFilm(Request $request){

        $title = $request->title;
        if(strcmp($title ,"*")==0){
            $films = Phim::all();
        } else {
            $films = DB::table('phims')
            ->where('tenphim', 'LIKE', "%".$title."%")
            ->get();
        }

        return view('admin',[
            'films'=>$films
        ]);
    }

    public function deleteFilm($id){
        $film = Phim::find($id);
        $film->delete();
        return redirect('/admin');
    }

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
