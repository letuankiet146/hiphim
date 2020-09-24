<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Phim;
use App\BaoLoi;
use App\SoTap;

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
        $phims = [];
        $tapBiLoi=[];

        foreach($baolois as $baoloi){
            $phim = $baoloi->phim;
            if(isset($baoloi->tap_phim)){
                $phim->ghichu = $baoloi->tap_phim;
            }
            array_push($phims,$phim);
        }
        $phims =  array_unique($phims);
        return view ("testlink",compact('phims'));
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

    public function updateLinkTap($id, $tap){
        $film = Phim::find($id);
        $sotap = SoTap::from('so_taps')
        ->where('phims_id',$id)
        ->where('tap',$tap)
        ->first();
        return view("updateurl",[
            'film'=>$film,
            'sotap'=>$sotap
        ]);
    }

    public function fixedLinkTap($id, $tap){
        DB::table('bao_lois')
        ->where('phims_id', '=', $id)
        ->where('tap_phim', '=', $tap)
        ->delete();
        return redirect('/testlink');
    }

    public function updateFilm(Request $request){
        $id = $request->id;
        $url = $request->url;
        $sotap = $request->sotap;
        if(isset($sotap)){
            if(strpos($url, 'http')  !== false){
                DB::table('so_taps')
                    ->where('phims_id',$id)
                    ->where('tap',$sotap)
                    ->update(["fb_url"=>$url]);
            }else{
                DB::table('so_taps')
                    ->where('phims_id',$id)
                    ->where('tap',$sotap)
                    ->update(["url"=>$url]);
            }
        }else{
            if(strpos($url, 'http')  !== false){
                DB::table('phims')
                    ->where('id',$id)
                    ->update(["fb_url"=>$url]);
            }else{
                DB::table('phims')
                    ->where('id',$id)
                    ->update(["url"=>$url]);
            }
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
