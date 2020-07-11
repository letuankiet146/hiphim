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
        $id = $request->id;
        DB::table('phims')
            ->where('id',$id)
            ->update(["url"=>$url]);
        return redirect('/testlink');
    }
}
