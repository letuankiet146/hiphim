<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Phim;
use App\DanhMuc;
use App\TheLoai;
use App\QuocGia;
use App\UserIp;
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

    private function getPublicUrl($oriUrl) {
        $serverResponse = Http::get($oriUrl);
        $serverJson = $serverResponse->json();
        $downloadUrl = $serverJson["@content.downloadUrl"];
        return $downloadUrl;
    }

    private function allowCount($phimId){
        $clientIP = \Request::ip();
        $userIp  = UserIp::from('user_ips')
        ->where('phims_id','=' ,$phimId)
        ->where('user_ip','=' ,$clientIP)
        ->first();
        if($userIp != null){
            if($userIp->ngayhethan >= date("yy-m-d")){
                return false;
            }
            UserIp::where('phims_id','=' ,$phimId)
            ->where('user_ip','=' ,$clientIP)
            ->update(['ngayhethan' => date("yy-m-d")]);
        } else {
            $newUserIp = new UserIp();
            $newUserIp->phims_id = $phimId;
            $newUserIp->user_ip = $clientIP;
            $newUserIp->ngayhethan = date("yy-m-d");
            $newUserIp->save();
        }
        return true;
    }

    public function detail ($id){

        $phim = Phim::find($id);
        $theloais = $phim->theloais;
        $dienviens = $phim->dienviens;
        $quocgia = $phim->quocgia;
        $danhmucId = $phim->danhmucs_id;
        $danhmuctitle = "phim-le";
        $sotaps = null;
        switch ($danhmucId) {
            case 1:
                $danhmuctitle = "phim-le-theo-quoc-gia";
            break;
            case 2:
                $danhmuctitle = "phim-bo";
                $sotaps = $phim->sotaps;
            break;
        }
        $phimLienQuan = [];
        $phimIds = [];
        foreach($theloais as $theloai){
            if(count($phimLienQuan)>=15){
                break;
            }
            $otherPhims = $theloai->phims;
            foreach($otherPhims as $otherPhim){
                if(count($phimLienQuan)>=15){
                    break;
                }
                if($id != $otherPhim->id && $danhmucId == $otherPhim->danhmucs_id && !in_array($otherPhim->id, $phimIds) ){
                    array_push($phimIds, $otherPhim->id);
                    array_push($phimLienQuan, $otherPhim);
                }
            }
        }
        $oriUrl = "https://api.onedrive.com/v1.0/drives/A5731D3943FE39D3/items/".$phim->url."?select=id%2C%40content.downloadUrl";
        $publicUrl = $this->getPublicUrl($oriUrl);
        if($this->allowCount($id)){
            $phim->luotxem = $phim->luotxem+1;
            $phim->update();
        }
        return view("detail",compact('phim','theloais','dienviens','quocgia','danhmuctitle','phimLienQuan','publicUrl','sotaps'));
    }

    public function detailTap ($id, $tap){

        $phim = Phim::find($id);
        $theloais = $phim->theloais;
        $dienviens = $phim->dienviens;
        $quocgia = $phim->quocgia;
        $danhmucId = $phim->danhmucs_id;
        $danhmuctitle = "phim-le";
        $sotaps = null;
        switch ($danhmucId) {
            case 1:
                $danhmuctitle = "phim-le-theo-quoc-gia";
            break;
            case 2:
                $danhmuctitle = "phim-bo";
                $sotaps = $phim->sotaps;
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
        $publicUrl =  null;
        foreach($sotaps as $sotap){
            $tapdangxem = $sotap["tap"];
            if($tap == $tapdangxem){
                $oriUrl = "https://api.onedrive.com/v1.0/drives/A5731D3943FE39D3/items/".$sotap->url."?select=id%2C%40content.downloadUrl";
                $publicUrl = $this->getPublicUrl($oriUrl);
            }
        }
        $taphientai = $tap;
        return view("detail",compact('phim','theloais','dienviens','quocgia','danhmuctitle','phimLienQuan','publicUrl','sotaps','taphientai'));
    }

    public function more($category, $data){
        define("PAGEINATE", 10);
        $phims=null;
        $title = "Hi Phim";
        switch ($category) {
            case 'tim-tat-ca':
                $phims =  Phim::from('phims')
                            ->where('tenphim','LIKE',"%".urldecode($data)."%")
                            ->orwhere('tenphim_en','LIKE',"%".urldecode($data)."%")
                            ->paginate(PAGEINATE);
                $title = "Kết quả tìm kiếm";
            break;
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
                ->orWhere(function($query) {
                    $query->where('danhmucs_id', '1')
                        ->orwhere('danhmucs_id', '3');
                })
                ->where('imdb','>','7')
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
            case 'phim-moi':
                $phims = Phim::from('phims')
                ->where('nam','=',$data)
                ->paginate(PAGEINATE);
                $title = "Phim mới";
            break;
            case 'phim-le':
                if(is_numeric($data)){
                    $phims = Phim::from('phims')
                                ->orWhere(function($query) {
                                    $query->where('danhmucs_id', '1')
                                        ->orwhere('danhmucs_id', '3');
                                })
                                ->where('nam','=',$data)
                                ->paginate(PAGEINATE);
                    $title = "Phim lẻ năm ".$data;
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
