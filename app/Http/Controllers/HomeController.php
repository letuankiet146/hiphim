<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoStream;
use App\Film;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
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
        $films = Film::all();
        foreach($films as $film){
            $name = $film->title;
            $url  = $film->url;
            $linkarray[$name] = $url;
        };
        $keys = array_keys($linkarray);
        return view("live",compact('linkarray','keys'));
    }

    public function insertFilm(Request $request){
        $film = new Film();
        $film->title = $request->title;
        $film->url = $request->url;
        $film->fb = $request->fb;
        $film->save();
        return redirect('/');
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
            $films = Film::all();
        } else {
            $films = DB::table('film')
            ->where('title', 'LIKE', "%".$title."%")
            ->get();
        }

        return view('home',[
            'films'=>$films
        ]);
    }

    public function deleteFilm($id){
        $film = Film::find($id);
        $film->delete();
        return redirect('/');
    }
}
