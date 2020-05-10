<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Phim;
use App\DanhMuc;
use App\TheLoai;
use App\QuocGia;
use DB;

class HiPhimController extends Controller
{
    public function ui(){
        $phims = Phim::all();

        //Load phim chieu rap
        $phimChieuRap = null;
        $chieuRap = DanhMuc::from('danh_mucs')
                ->where('tendanhmuc','LIKE',"%Phim Chiếu Rạp%");
        if($chieuRap->exists()){
            $phimChieuRap = $chieuRap->first()->phims()->get();
        }

         //Load phim bo
         $phimChieuBo = null;
         $bo = DanhMuc::from('danh_mucs')
                 ->where('tendanhmuc','LIKE',"%Phim Bộ%");
         if($bo->exists()){
             $phimChieuBo = $bo->first()->phims()->get();
         }

          //Load phim le
          $phimChieuLe = null;
          $le = DanhMuc::from('danh_mucs')
                  ->where('tendanhmuc','LIKE',"%Phim Lẻ%");
          if($le->exists()){
              $phimChieuLe = $le->first()->phims()->get();
          }

           //Load phim tv
           $phimTv = null;
           $tv = DanhMuc::from('danh_mucs')
                   ->where('tendanhmuc','LIKE',"%Phim Truyền Hình%");
           if($tv->exists()){
               $phimTv = $tv->first()->phims()->get();
           }


        return view("index" ,compact('phims','phimChieuRap','phimChieuBo','phimChieuLe','phimTv'));
    }

    private function activeLink($gofileUrl) {
        $downloadLength = strlen("download/");
        preg_match('/download/', $gofileUrl, $startMatch, PREG_OFFSET_CAPTURE);
        $start = $startMatch[0][1];
        $end = strrpos($gofileUrl,'/');
        $gofileId = substr($gofileUrl, $start+$downloadLength,$end-($start+$downloadLength));

        $serverResponse = Http::get('https://apiv2.gofile.io/getServer?c='.$gofileId.'');
        $serverJson = $serverResponse->json();
        $serverArr = $serverJson["data"];
        $serverName =  $serverArr["server"];
        $response = Http::get('https://'.$serverName.'.gofile.io/getUpload?c='.$gofileId.'');
    }

    //keep the same code with xemphim
    public function detail ($id){
        $phim = Phim::find($id);
        $theloais = $phim->theloais;
        $this->activeLink($phim->url);
        $dienviens = $phim->dienviens;
        $quocgia = $phim->quocgia;
        $danhmucId = $phim->danhmucs_id;
        $danhmuctitle = "phim-le";
        switch ($danhmucId) {
            case 1:
                $danhmuctitle = "phim-le-theo-quoc-gia";
            break;
            case 2:
                $danhmuctitle = "phim-bo";
            break;
        }
        $phimLienQuan = [];
        foreach($theloais as $theloai){
            if(count($phimLienQuan)>=15){
                break;
            }
            $otherPhims = $theloai->phims;
            foreach($otherPhims as $otherPhim){
                if(count($phimLienQuan)>=15){
                    break;
                }
                if($id != $otherPhim->id && $danhmucId == $otherPhim->danhmucs_id){
                    array_push($phimLienQuan,$otherPhim);
                }
            }
        }

        return view("detail",compact('phim','theloais','dienviens','quocgia','danhmuctitle','phimLienQuan'));
    }

    public function xemphim ($id){
        $phim = Phim::find($id);
        $theloais = $phim->theloais;
        $this->activeLink($phim->url);
        $dienviens = $phim->dienviens;
        $quocgia = $phim->quocgia;
        $danhmucId = $phim->danhmucs_id;
        $danhmuctitle = "phim-le";
        switch ($danhmucId) {
            case 1:
                $danhmuctitle = "phim-le-theo-quoc-gia";
            break;
            case 2:
                $danhmuctitle = "phim-bo";
            break;
        }
        $phimLienQuan = [];
        foreach($theloais as $theloai){
            if(count($phimLienQuan)>=15){
                break;
            }
            $otherPhims = $theloai->phims;
                foreach($otherPhims as $otherPhim){
                if(count($phimLienQuan)>=15){
                    break;
                }
                if($id != $otherPhim->id && $danhmucId == $otherPhim->danhmucs_id){
                    array_push($phimLienQuan,$otherPhim);
                }
            }
        }

        return view("xemphim",compact('phim','theloais','dienviens','quocgia','danhmuctitle','phimLienQuan'));
    }

    public function more($category, $data){
        define("PAGEINATE", 10);
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
            case 'phim-bo':
                $quocgia = QuocGia::from('quoc_gias')
                    ->where('tenquocgia', 'LIKE', "%".urldecode($data)."%")
                    ->first();

                $danhmucs = DanhMuc::from('danh_mucs')
                            ->where('tendanhmuc','LIKE',"Phim Bộ");
                if($danhmucs->exists()){
                    $phims = $danhmucs->first()
                            ->phims()
                            ->where('quocgias_id','=',$quocgia->id)
                            ->paginate(PAGEINATE);
                    $title = "Phim Bộ ".$quocgia->tenquocgia;

                }
            break;
            case 'phim-le-theo-quoc-gia':
                $quocgia = QuocGia::from('quoc_gias')
                    ->where('tenquocgia', 'LIKE', "%".urldecode($data)."%")
                    ->first();

                $danhmucs = DanhMuc::from('danh_mucs')
                            ->where('tendanhmuc','LIKE',"Phim Lẻ");
                if($danhmucs->exists()){
                    $phims = $danhmucs->first()
                            ->phims()
                            ->where('quocgias_id','=',$quocgia->id)
                            ->paginate(PAGEINATE);
                    $title = "Phim Lẻ ".$quocgia->tenquocgia;

                }
            break;
            case 'phim-le':
                if(is_numeric($data)){

                }else{
                    $danhmuc = DanhMuc::from('danh_mucs')
                                ->where('tendanhmuc','LIKE',"Phim Lẻ")
                                ->first();

                    $theloai = TheLoai::from('the_loais')
                    ->where('tentheloai', 'LIKE', "%".urldecode($data)."%")
                    ->first();

                    if($danhmuc->exists() && $theloai->exists()){
                        $phims = $theloai->phims()
                        ->where('danhmucs_id','=',$danhmuc->id)
                        ->paginate(PAGEINATE);
                        $title = "Phim ".$theloai->tentheloai;
                    }
                }
            break;
            case 'tv-show':
                if(isset($data) && strcmp($data ,"all")==0){
                    $danhmucs = DanhMuc::from('danh_mucs')
                            ->where('tendanhmuc','LIKE',"Phim Truyền Hình");
                    if($danhmucs->exists()){
                        $phims = $danhmucs->first()
                                ->phims()
                                ->paginate(PAGEINATE);
                        $title = "TV shows";

                    }
                }else {
                    die;
                }
            break;
        }
        $hasPage = $phims->hasPages();
        $pageLink=null;
        $currentPageNumber=null;
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
