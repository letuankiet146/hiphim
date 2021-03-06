<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Phim;
use App\DanhMuc;
use App\TheLoai;
use App\QuocGia;
use App\UserIp;
use App\DienVien;
use App\BaoLoi;
use App\Server;

use DB;

class HiPhimController extends Controller
{
    public function ui(){
        $phims = Phim::all();

        // Load phim chieu rap
        $phimChieuRap =  Phim::from('phims')
                            ->where('danhmucs_id',"3")
                            ->orderBy('ngaytao','desc')
                            ->limit(10)
                            ->get();

        //Load phim mới cập nhật
        $phimMoiCapNhat =  Phim::from('phims')
                            ->where('danhmucs_id',"1")
                            ->orderBy('ngaytao','desc')
                            ->limit(15)
                            ->get();
         //Load phim bo
        $phimChieuBo =  Phim::from('phims')
                            ->where('danhmucs_id',"2")
                            ->orderBy('ngaytao','desc')
                            ->limit(6)
                            ->get();

        //Load phim le
        $phimChieuLe =  Phim::from('phims')
                            ->where('danhmucs_id',"1")
                            ->inRandomOrder()
                            ->limit(12)
                            ->get();

        //Load phim tv
        $phimTv =  Phim::from('phims')
                            ->where('danhmucs_id',"4")
                            ->orderBy('ngaytao','desc')
                            ->limit(6)
                            ->get();

        return view("index" ,compact('phimChieuRap','phimMoiCapNhat','phimChieuBo','phimChieuLe','phimTv'));
    }

    public static function getPublicUrl($oriUrl) {
        $serverResponse = Http::get($oriUrl);
        $serverJson = $serverResponse->json();
        $downloadUrl = $serverJson["@content.downloadUrl"];
        return $downloadUrl;
    }

    static function urlExists($url=NULL)
    {
        if($url == NULL) return false;
        $client = new Client();
        try {
            $httpResponse = get_headers($url)[0];
            $strCode = substr($httpResponse,9,3);
            if($strCode==200 || $strCode==302){
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function getMediaFireUrl($fileId){
       try {
            $rawUrl = 'http://www.mediafire.com/file/'.$fileId.'/file';
            $rawUrlData = file_get_contents($rawUrl);
            $doc = new \DomDocument;

            libxml_use_internal_errors(true);

            htmlspecialchars($rawUrlData);
            $doc->loadHTMLFile($rawUrl);
            $mediaUrl = $doc->getElementsByTagName('a')[7]->getAttribute('href');
            return $mediaUrl;
       } catch (\Throwable $th) {
           return "";
       }
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

    public function oldDetail ($link_id){
        $phim = Phim::find($link_id);
        if(isset($phim)){
            return redirect('/phim/'.$phim->link_id.'.html');
        }else{
            return redirect('/');
        }
    }

    public function detail ($link_id){
        $p = Phim::from('phims')
        ->where('link_id', $link_id)->first();
        $id = $p->id;

        $phim = Phim::find($id);
        $theloais = $phim->theloais;
        $dienviens = $phim->dienviens;
        $quocgia = $phim->quocgia;
        $danhmucId = $phim->danhmucs_id;
        $danhmuctitle = "phim-le";
        $sotaps = null;
        $isErrorUrl = false;
        $servers = $phim->servers;
        $mediaServers = [];
        $okUrls = [];
        $hyUrls = [];
        foreach($servers as $server){
            if(strcasecmp($server->servers_type,"MEDIA")===0){
                array_push($mediaServers,$server);
            }
            if(strcasecmp($server->servers_type,"OK")===0){
                array_push($okUrls,$server);
            }
            if(strcasecmp($server->servers_type,"HY")===0){
                array_push($hyUrls,$server);
            }
        }

        $publicUrl = null;
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
            if(count($phimLienQuan)>=12){
                break;
            }
            $otherPhims = $theloai->phims;
            foreach($otherPhims as $otherPhim){
                if(count($phimLienQuan)>=12){
                    break;
                }
                if($id != $otherPhim->id && $danhmucId == $otherPhim->danhmucs_id && !in_array($otherPhim->id, $phimIds) ){
                    array_push($phimIds, $otherPhim->id);
                    array_push($phimLienQuan, $otherPhim);
                }
            }
        }

        if(strcasecmp($phim->url,"NA") === 0 ){
            $publicUrl = $phim->fb_url;
        }else {
            $oriUrl = "https://api.onedrive.com/v1.0/drives/A5731D3943FE39D3/items/".$phim->url."?select=id%2C%40content.downloadUrl";
            try {
                $publicUrl = $this->getPublicUrl($oriUrl);
            } catch (\Throwable $th) {
                $publicUrl = null;
                $isErrorUrl = true;
            }
        }


        if(isset($publicUrl) && !$this->urlExists($publicUrl)){
            $isErrorUrl = true;
            $isExistBkUrl = Server::where('phims_id', '=', $phim->id)
                                            ->wherein('servers_type', ['OK','HY'])
                                            ->first();
                    if($isExistBkUrl === null){
                        $this->baoloi($id,null);
                    }
        }
        if($this->allowCount($id)){
            $phim->luotxem = $phim->luotxem+1;
            $phim->update();
        }
        $taphientai = 1;

        //Load phim chieu rap QC
        $phimQC =  Phim::from('phims')
                            ->where('danhmucs_id',"5")
                            ->orderBy('ngaytao','desc')
                            ->limit(4)
                            ->get();

        return view("detail",
        compact('isErrorUrl',
                'phim',
                'theloais',
                'dienviens',
                'quocgia',
                'danhmuctitle',
                'phimLienQuan',
                'phimQC',
                'publicUrl',
                'sotaps',
                'mediaServers',
                'okUrls',
                'hyUrls',
                'taphientai'));
    }

    public function detailTap ($link_id, $tap){
        $p = Phim::from('phims')
        ->where('link_id', $link_id)->first();

        $id = $p->id;

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
                if(strcasecmp($sotap->url,"NA") === 0 ){
                    $publicUrl = $sotap->fb_url;
                } else {
                    $oriUrl = "https://api.onedrive.com/v1.0/drives/A5731D3943FE39D3/items/".$sotap->url."?select=id%2C%40content.downloadUrl";
                    $publicUrl = $this->getPublicUrl($oriUrl);
                }
            }
        }

        //check living
        $isErrorUrl = false;
        if(!$this->urlExists($publicUrl)){
            $isErrorUrl = true;
            $this->baoloi($id,$tap);
        }

        $taphientai = $tap;

        //Load phim chieu rap QC
        $phimQC =  Phim::from('phims')
                    ->where('danhmucs_id',"5")
                    ->orderBy('ngaytao','desc')
                    ->limit(4)
                    ->get();
        return view("detail",compact('isErrorUrl',
        'phim',
        'theloais',
        'dienviens',
        'quocgia',
        'danhmuctitle',
        'phimLienQuan',
        'phimQC',
        'publicUrl',
        'sotaps',
        'taphientai'));
    }

    public static function baoloi($id,$tap){
        $phim = Phim::find($id);
        $user_ip = \Request::ip();
        if($phim->danhmucs_id!=2){
            $baoloitruocdo  = BaoLoi::from('bao_lois')
            ->where('phims_id','=' ,$id)
            ->where('user_ip','=' ,$user_ip)
            ->first();
            if (!isset($baoloitruocdo)){
                $baoloi = new BaoLoi();
                $baoloi->phims_id = $id;
                $baoloi->user_ip = $user_ip;
                $baoloi->save();
            }
        } else {
            $baoloitruocdo  = BaoLoi::from('bao_lois')
            ->where('phims_id','=' ,$id)
            ->where('tap_phim','=' ,$tap)
            ->where('user_ip','=' ,$user_ip)
            ->first();
            if (!isset($baoloitruocdo)){
                $baoloi = new BaoLoi();
                $baoloi->phims_id = $id;
                $baoloi->tap_phim = $tap;
                $baoloi->user_ip = $user_ip;
                $baoloi->save();
            }
        }
    }

    public function more($category, $data){
        define("PAGEINATE", 30);
        $phims=null;
        $title = "Xem phim HiPhimORG";
        switch ($category) {
            case 'dien-vien':
                $dienvens = DienVien::from('dien_viens')
                ->where('tendienvien', 'LIKE', "%".urldecode($data)."%");
                if($dienvens->exists()){
                    $title = "Diễn viên: ".$dienvens->first()->tendienvien;
                    $phims = $dienvens->first()->phims();
                }
            break;
            case 'tim-tat-ca':
                $phims =  Phim::from('phims')
                            ->where('tenphim','LIKE',"%".urldecode($data)."%")
                            ->orwhere('tenphim_en','LIKE',"%".urldecode($data)."%");
                $title = "Kết quả tìm kiếm";
            break;
            case 'the-loai':
                $theloais  = TheLoai::from('the_loais')
                ->where('tentheloai', 'LIKE', "%".urldecode($data)."%");
                if($theloais->exists()){
                    $title = "Phim ".$theloais->first()->tentheloai;
                    $phims = $theloais->first()->phims();
                }
            break;
            case 'danh-muc':
                $danhmucs = DanhMuc::from('danh_mucs')
                ->where('tendanhmuc','LIKE',"%".urldecode($data)."%");
                if($danhmucs->exists()){
                    $title = $danhmucs->first()->tendanhmuc;
                    $phims = $danhmucs->first()->phims();
                }
            break;
            case 'quoc-gia':
                $quocgias = QuocGia::from('quoc_gias')
                ->where('tenquocgia', 'LIKE', "%".urldecode($data)."%");
                if($quocgias->exists()){
                    $title = "Phim ".$quocgias->first()->tenquocgia;
                    $phims = $quocgias->first()->phims();
                }
            break;
            case 'top-imdb':
                $phims = Phim::from('phims')
                ->orWhere(function($query) {
                    $query->where('danhmucs_id', '1')
                        ->orwhere('danhmucs_id', '3');
                })
                ->where('imdb','>','7');
                $title = "Phim Top IMDB";
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
                            ->where('quocgias_id','=',$quocgia->id);
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
                            ->where('quocgias_id','=',$quocgia->id);
                    $title = "Phim Lẻ ".$quocgia->tenquocgia;

                }
            break;
            case 'phim-moi':
                $phims = Phim::from('phims')
                ->where('nam','=',$data);
                $title = "Phim mới";
            break;
            case 'phim-le':
                if(is_numeric($data)){
                    $phims = Phim::from('phims')
                                ->orWhere(function($query) {
                                    $query->where('danhmucs_id', '1')
                                        ->orwhere('danhmucs_id', '3');
                                })
                                ->where('nam','=',$data);
                    $title = "Phim lẻ năm ".$data;
                }else if(strcasecmp(urldecode($data),'Trước năm 2014')===0){
                    $phims = Phim::from('phims')
                                ->orWhere(function($query) {
                                    $query->where('danhmucs_id', '1')
                                        ->orwhere('danhmucs_id', '3');
                                })
                                ->where('nam','<',2014);
                    $title = "Phim lẻ ".$data;
                }
                else{
                    $danhmuc = DanhMuc::from('danh_mucs')
                                ->where('tendanhmuc','LIKE',"Phim Lẻ")
                                ->first();

                    $quocgia = QuocGia::from('quoc_gias')
                                ->where('tenquocgia', 'LIKE', "%".urldecode($data)."%")
                                ->first();

                    $theloai = TheLoai::from('the_loais')
                    ->where('tentheloai', 'LIKE', "%".urldecode($data)."%")
                    ->first();

                    if(isset($danhmuc) && isset($theloai) && $danhmuc->exists() && $theloai->exists()){
                        $phims = $theloai->phims()
                        ->where('danhmucs_id','=',$danhmuc->id);
                        $title = "Phim ".$theloai->tentheloai;

                    }else if(isset($danhmuc) && isset($quocgia) && $danhmuc->exists() && $quocgia->exists()){
                        $phims = $quocgia->phims()
                        ->where('danhmucs_id','=',$danhmuc->id);
                        $title = "Phim ".$quocgia->tenquocgia;
                    }
                }
            break;
            case 'tv-show':
                if(isset($data) && strcmp($data ,"all")==0){
                    $danhmucs = DanhMuc::from('danh_mucs')
                            ->where('tendanhmuc','LIKE',"Phim Truyền Hình");
                    if($danhmucs->exists()){
                        $phims = $danhmucs->first()
                                ->phims();
                        $title = "TV shows";

                    }
                }else {
                    die;
                }
            break;
        }
        $endPage = PAGEINATE;
        if(isset($phims)){
            $phimList = $phims->get();
            if(count($phimList)%PAGEINATE>0){
                $endPage = bcdiv(count($phimList), PAGEINATE, 0) + 1;
            }else{
                $endPage = bcdiv(count($phimList), PAGEINATE, 0);
            }
            $phims = $phims->paginate(PAGEINATE);
        }
        if(method_exists($phims,"hasPages") ){
            $hasPage = $phims->hasPages();
        }else{
            $hasPage = false;
        }
        $pageLink=null;
        $currentPageNumber=null;
        if($hasPage){
            $pageLink = $phims->getUrlRange(1,$endPage);
            $currentPageNumber = $phims->currentPage();
        }
        $phims = $phims->sortByDesc('ngaytao');
        return view('more',[
            "phims"=>$phims,
            "title"=>$title,
            "currentPageNumber"=>$currentPageNumber,
            "pageLink"=>$pageLink
        ]);
    }

    public function liveSearch($data){
        $liveSearchResult =  Phim::from('phims')
        ->where('tenphim','LIKE',"%".urldecode($data)."%")
        ->orwhere('tenphim_en','LIKE',"%".urldecode($data)."%")
        ->get();
        return response()->json(["liveSearchResult"=>$liveSearchResult],200);
    }

    public function changeServer($phimId, $serverId){
        $server =  Server::where('phims_id',$phimId)
                            -> where ('servers_id',$serverId)
                            -> first();
        // if(strcasecmp($server->servers_type,'MEDIA')===0){
        //     $newUrl = $this->getMediaFireUrl($server->url);
        // }else{
        //     $newUrl = $server->url;
        // }
        switch ($server->servers_type) {
            case 'MEDIA':
                $newUrl = $this->getMediaFireUrl($server->url);
                break;
            default:
                $newUrl = $server->url;
                break;
        }
        //check living
        $isErrorUrl = false;
        if(strcasecmp($newUrl,"")===0 ||  !$this->urlExists($newUrl)){
            $isErrorUrl = true;
            $isExistBkUrl = Server::where('phims_id', '=', $phim->id)
                                            ->wherein('servers_type', ['OK','HY'])
                                            ->first();
                    if($isExistBkUrl === null){
                        $this->baoloi($phimId,null);
                    }
        }
        return response()->json(["newUrl"=>$newUrl,"isErrorUrl"=>$isErrorUrl],200);
    }
}
