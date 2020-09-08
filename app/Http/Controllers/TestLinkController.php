<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Phim;
use App\BaoLoi;
use DB;

class TestLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function isAvailable(){
        $phims = Phim::all();
        foreach($phims as $phim){
            if(strcasecmp($phim->url,"NA") !== 0){
                continue;
            }
            if($phim->danhmucs_id !== 2){
                if(!HiPhimController::urlExists($phim->fb_url)){
                    HiPhimController::baoloi($phim->id,null);
                }
            }else{
                $sotaps = $phim->sotaps;
                foreach($sotaps as $tap){
                    if(!HiPhimController::urlExists($tap->fb_url)){
                        HiPhimController::baoloi($tap->phims_id, $tap->tap);
                    }
                }
            }

        }
        return redirect('/testlink');
    }

    public function testLink(){

        $baolois = BaoLoi::all();
        $countphim = [];
        $groupPhim = [];
        $groupPhimKeys = [];
        foreach($baolois as $baoloi){
            array_push($countphim,$baoloi->phims_id);
            if(!in_array($baoloi->phims_id,$groupPhim)){
                $phim = $baoloi->phim;
                $groupPhim[$baoloi->phims_id] = $phim->tenphim;
            }

        }
        $counts = array_count_values($countphim);
        $groupPhimKeys = array_keys($groupPhim);
        return view ("testlink",compact('groupPhim','counts','groupPhimKeys'));
    }

    public function updateLink($id){
        $film = Phim::find($id);
        return view("updateurl",[
            'film'=>$film
        ]);
    }

    public function fixedLink($id){
        DB::table('bao_lois')->where('phims_id', '=', $id)->delete();
        return redirect('/testlink');
    }

    public function updateFilm(Request $request){
        $url = $request->url;
        if(strpos($url, 'http')  !== false){
            echo "having http";
            $id = $request->id;
            DB::table('phims')
                ->where('id',$id)
                ->update(["fb_url"=>$url]);
        }else{
            echo "not having http";
            $id = $request->id;
            DB::table('phims')
                ->where('id',$id)
                ->update(["url"=>$url]);
        }

        return redirect('/testlink');
    }

    public function demo(){
        $rawUrl = 'http://www.mediafire.com/file/34j6iqah9ud1ubr/file';
        $rawUrlData = file_get_contents($rawUrl);
        $doc = new \DomDocument;

        libxml_use_internal_errors(true);

        htmlspecialchars($rawUrlData);
        $doc->loadHTMLFile($rawUrl);
        $links = array();
        $urlStream = null;
        $mediaUrl = $doc->getElementsByTagName('a')[7]->getAttribute('href');
        echo $mediaUrl;
        return view('live',compact('mediaUrl'));
    }
}
