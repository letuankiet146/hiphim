<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phim;
use App\SoTap;
use App\DanhMuc;
use App\TheLoai;
use App\QuocGia;
use App\DienVien;
use App\TagDienVien;
use App\TagTheLoai;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function themphimbo(){
        define('DANH_MUC_PHIM_BO',2);
        $phimsBo = Phim::from('phims')
        ->where('danhmucs_id','=',DANH_MUC_PHIM_BO)->get();
        $phimArray = [];
        foreach($phimsBo as $phim){
            $phimArray[$phim->id] = $phim->tenphim;
        }
        $phimKeys = array_keys($phimArray);
        return view('themphimbo',compact('phimArray'
                                        ,'phimKeys'));
    }

    public function admin()
    {
        $danhmucs = DanhMuc::all();
        $theloais = TheLoai::all();
        $quocgias = QuocGia::all();
        $dienviens = DienVien::all();
        $phimsBo = Phim::from('phims')
        ->where('danhmucs_id','=',2)->get();

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

        $dienvienArray = [];
        foreach($dienviens as $dienvien){
            $dienvienArray[$dienvien->id] = $dienvien->tendienvien;
        }
        $dienvienKeys = array_keys($dienvienArray);

        $quocgiaArray = [];
        foreach($quocgias as $quocgia){
            $quocgiaArray[$quocgia->id] = $quocgia->tenquocgia;
        }
        $quocgiaKeys = array_keys($quocgiaArray);

        $phimArray = [];
        foreach($phimsBo as $phim){
            $phimArray[$phim->id] = $phim->tenphim;
        }
        $phimKeys = array_keys($phimArray);

        return view('admin',compact('danhmucArray'
                                    ,'danhmucKeys'
                                    ,'theloaiArray'
                                    ,'theloaiKeys'
                                    ,'dienvienArray'
                                    ,'dienvienKeys'
                                    ,'quocgiaArray'
                                    ,'quocgiaKeys'
                                    ,'phimArray'
                                    ,'phimKeys'));
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

    public function insertphimbo(Request $request){
        $sotap = new SoTap();
        $sotap->phims_id = $request->phimbo;
        $sotap->tap = $request->tap;
        $sotap->url = $request->url;
        $sotap->save();
        return redirect('/themphimbo');
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
        $phim->tenphim_en = $request->tenphim_en;
        $phim->nam = $request->nam;
        $phim->poster = $posterName;
        $phim->background = $bgName;
        $phim->mota = $request->mota;
        $phim->danhmucs_id = $request->danhmucId;
        $phim->tongsotap = $request->tongsotap;
        if(isset($request->phude)){
            $phim->phude = $request->phude;
        }
        if(isset($request->sapchieu)){
            $phim->sapchieu = $request->sapchieu;
        }
        $phim->url = $request->url;
        $phim->imdb = $request->imdb;
        $phim->thoiluong = $request->thoiluong;
        $phim->quocgias_id = $request->quocgiaId;
        $phim->ngaytao=date("yy-m-d");
        $phim->save();

        //tao phim bo
        if( $request->danhmucId == 2){
            $sotap = new SoTap();
            $sotap->phims_id = $phim->id;
            $sotap->tap = 1;
            $sotap->url = $phim->url;
            $sotap->save();
        }

        foreach($request->theloais as $theloai){
            $tagTheLoai = new TagTheLoai();
            $tagTheLoai->phims_id =$phim->id;
            $tagTheLoai->the_loais_id = $theloai;
            $tagTheLoai->save();
        }

        foreach($request->dienviens as $dienvien){
            $tagDienVien = new TagDienVien();
            $tagDienVien->phims_id= $phim->id;
            $tagDienVien->dien_viens_id = $dienvien;
            $tagDienVien->save();
        }


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

    public function dienvien (Request $request){
        $dienviens = DB::table("dien_viens")
                    ->orderBy('updated_at','desc')
                    ->get();

        return view("dienvien",[
            "dienviens" => $dienviens
        ]);
    }

    public function themdienvien(Request $request){
        $newDienVien = new DienVien();
        $newDienVien->tendienvien = trim($request->tendienvien);
        $newDienVien->save();
        return redirect('/dienvien');
    }

    public function reloadDienvien(){
        $dienviens = DB::table("dien_viens")
                    ->orderBy('updated_at','desc')
                    ->get();
        $dienvienArray = [];
        foreach($dienviens as $dienvien){
            $dienvienArray[$dienvien->id] = $dienvien->tendienvien;
        }
        $dienvienKeys = array_keys($dienvienArray);
        return response()->json(["dienvienKeys"=>$dienvienKeys
                                ,"dienvienArray"=>$dienvienArray],200);
    }
}
