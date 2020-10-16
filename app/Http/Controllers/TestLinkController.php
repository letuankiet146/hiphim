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
        // $rawLink = "https://lh3.googleusercontent.com/YVhuFnB_dsUaHawzoVMR2aPdrENvZFgLsnf-RnPlEOuTzlIj95xTtaSImI3HDc4q5Z4nWQMTySFUhDqYiXqkfadqs0J9bJy6-EbyNZC7LCwRJf7NyfLZAJ0zSYq65PISzdJ_KDqfZtM1B_XuPjcQtCL9a_6_YsgOBPW5o_fxkGA6I71MRZW1c5W-SP_oa7J2NvK-Kp4woGwnHkfNBjwtMp7iS1DT7mrSKnOX--ozrFWcb2ItpqGCiWjbB-tL2uT-dZiWseihgmnB3Re3NHKMoBT5XXEoYh0-27AZq-JFTPgbaI3XAiO455tT9PFnfSh-M9k6GSJa5mVgqWdnB7XPmjTFDGFVaIwmylxvXk-smlZE6qZt3xVS-dP1irb7zI1xY1gUIOCjXSV9tlraPs03sjTBpC0rT-ub414YyzdZwhejwFhMiGpezDru5cQai9riRBnJzQ7ud1YmZ3sXt1zqcB3Jj4Bsj1ZqiM9CnqKkHtiZa865Ll1XAglEM2y9_t7yOYArcpstCvwQm4p19c822BJZlK__AsCnC5xFQGMV0jLscIVzMguC23o3v3PadzQG-X6xqPvIRDw4CZc-pOyAgkXYEW1q12qJBKqxu0ZPgmcWaij5N5MNzZSASmwP4Vts7V_EPH2mC4TqKT0lUv7oZ3rlHarfHbg6W54KlZfc_WEapKtAci_jW-MecPSJQQ=m37";

        // $rawUrlData = file_get_contents($rawLink);
        // var_dump($rawUrlData);
        return view('live');
    }
}
