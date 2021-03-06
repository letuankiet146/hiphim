<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Phim;
use App\BaoLoi;
use App\SoTap;
use App\Server;

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
                $publicUrl=null;
                if(strcasecmp($phim->url,"NA") === 0 ){
                    $publicUrl = $phim->fb_url;
                } else {
                    $oriUrl = "https://api.onedrive.com/v1.0/drives/A5731D3943FE39D3/items/".$phim->url."?select=id%2C%40content.downloadUrl";
                    $publicUrl = HiPhimController::getPublicUrl($oriUrl);
                }
                if(!HiPhimController::urlExists($publicUrl)){
                    $isExistBkUrl = Server::where('phims_id', '=', $phim->id)
                                            ->wherein('servers_type', ['OK','HY'])
                                            ->first();
                    if($isExistBkUrl === null){
                        HiPhimController::baoloi($phim->id,null);
                    }
                }
            }else{
                $sotaps = $phim->sotaps;
                foreach($sotaps as $tap){
                    $publicUrl=null;
                    if(strcasecmp($tap->url,"NA") === 0 ){
                        $publicUrl = $tap->fb_url;
                    } else {
                        $oriUrl = "https://api.onedrive.com/v1.0/drives/A5731D3943FE39D3/items/".$tap->url."?select=id%2C%40content.downloadUrl";
                        $publicUrl = HiPhimController::getPublicUrl($oriUrl);
                    }
                    if(!HiPhimController::urlExists($publicUrl)){
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

    public function addServer($id){
        $phim = Phim::find($id);
        $servers = $phim->servers;
        $serverIds = [0];
        foreach($servers as $server){
            array_push($serverIds,$server->servers_id);
        }
        $newServerId = max($serverIds)+1;
        return view("addserver",[
            'phim'=>$phim,
            'newServerId'=>$newServerId
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
        $original_url = isset($request->original_url) ? $request->original_url : "";
        $arr1 =  ["fb_url"=>$url, "original_url"=>$original_url];
        $arr2 =  ["url"=>$url, "original_url"=>$original_url];
        if(isset($sotap)){
            if(strpos($url, 'http')  !== false || strpos($url, '//')  !== false){
                DB::table('so_taps')
                    ->where('phims_id',$id)
                    ->where('tap',$sotap)
                    ->update( ["fb_url"=>$url]);
            }else{
                DB::table('so_taps')
                    ->where('phims_id',$id)
                    ->where('tap',$sotap)
                    ->update(["url"=>$url]);
            }
        }else{
            if(strpos($url, 'http')  !== false || strpos($url, '//')  !== false){
                DB::table('phims')
                    ->where('id',$id)
                    ->update( $arr1);
            }else{
                DB::table('phims')
                    ->where('id',$id)
                    ->update( $arr2);
            }
        }

        return redirect('/testlink');
    }
    public function insertServer(Request $request){
        $server = new Server();
        $server->phims_id = $request->id;
        $server->servers_id = $request->new_server_id ;
        $server->servers_type =  $request->server_type ;
        $server->url = $request->url;
        $server->save();

        return redirect('/testlink');
    }

    public function demo(){

        return view('live');
    }
}
