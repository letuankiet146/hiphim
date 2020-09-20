<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use App\Phim;
use App\SoTap;
use App\DanhMuc;
use App\TheLoai;
use App\QuocGia;
use App\DienVien;
use App\TagDienVien;
use App\TagTheLoai;
use App\Server;
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

    public function themphimbo($id){
        $defaultId = $id;
        $tapketiep = null;
        $tapmoinhat= null;
        if($id!==00){
            $sotap = SoTap::from('so_taps')
                ->where('phims_id','=',$id)
                ->whereRaw('tap = (select max(`tap`) from so_taps where phims_id='.$id.')')
                ->first();
            if(isset($sotap)){
                $tapmoinhat= $sotap->tap;
                $tapketiep = $tapmoinhat + 1;
            }
        }
        define('DANH_MUC_PHIM_BO',2);
        $phimsBo = Phim::from('phims')
        ->where('danhmucs_id','=',DANH_MUC_PHIM_BO)->get();
        $phimArray = [];
        foreach($phimsBo as $phim){
            $phimArray[$phim->id] = $phim->tenphim;
        }
        $phimKeys = array_keys($phimArray);

        return view('themphimbo',compact('phimArray'
                                        ,'phimKeys','defaultId','tapmoinhat','tapketiep'));
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
        SitemapGenerator::create('https://hiphim.org/')->writeToFile('sitemap.xml');
        echo "Updated sitemap.xml";
    }

    public function insertphimbo(Request $request){
        $sotap = new SoTap();
        $sotap->phims_id = $request->phimbo;
        $sotap->tap = $request->tap;
        $sotap->url = $request->url;
        $sotap->fb_url = $request->fb_url;
        $sotap->save();
        return redirect('/themphimbo/'.$sotap->phims_id);
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
        $phim->link_id = $request->link_id;
        $phim->nam = $request->nam;
        $sub = $request->file('sub');
        if(isset($sub)){
            $subName = $sub->getClientOriginalName();
            $sub->move(public_path('sub'), $subName);
            $phim->sub = $subName;
        }
        $phim->poster = $posterName;
        $phim->background = $bgName;
        $phim->meta_desc = $request->meta_desc;
        $phim->mota = $request->mota;
        $phim->danhmucs_id = $request->danhmucId;
        $phim->tongsotap = $request->tongsotap;
        if(isset($request->phude)){
            $phim->phude = $request->phude;
        }
        $phim->ghichu = $request->ghichu;
        $phim->url = $request->url;
        $phim->fb_url = $request->fb_url;
        $phim->original_url = $request->original_url;
        $phim->trailer=$request->trailer;
        $phim->imdb = $request->imdb;
        $phim->thoiluong = $request->thoiluong;
        $phim->quocgias_id = $request->quocgiaId;
        $phim->ngaytao=date("yy-m-d");
        $phim->save();

        if(isset($request->media_url) && $request->media_url !== null){
            $server = new Server();
            $server->phims_id = $phim->id;
            $server->servers_id = 1 ;
            $server->servers_type = "MEDIA";
            $server->url = $request->media_url;
            $server->save();
        }

        //tao phim bo
        if( $request->danhmucId == 2){
            $sotap = new SoTap();
            $sotap->phims_id = $phim->id;
            $sotap->tap = 1;
            $sotap->url = $phim->url;
            $sotap->fb_url = $phim->fb_url;
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

        $dienvienInput = trim($request->tendienvien);
        if(strpos($dienvienInput, ',')  !== false){
            $newDienVienArr = explode(",",$dienvienInput);
            foreach($newDienVienArr as $dienvien){
                if(empty($dienvien)){
                    continue;
                }
                $newDienVien = new DienVien();
                $newDienVien->tendienvien = $dienvien;
                $newDienVien->save();
            }
        }else{
            $newDienVien = new DienVien();
            $newDienVien->tendienvien = $dienvienInput;
            $newDienVien->save();
        }
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
