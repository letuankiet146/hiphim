<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phim;

class TestLinkController extends Controller
{
    static function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    static function pingLink($domain){
        if(!isset($domain) || empty($domain)){
            return "clgt: $domain";
        }
          $headers = get_headers($domain);
        //   foreach($headers as $header){
        //       echo $header."<br>";
        //   }
          $get_http_response_code = substr($headers[0], 9, 3);
          if ( strcmp($get_http_response_code ,"200")==0 || strcmp($get_http_response_code ,"302")==0) {
            return "GOOD";
          } else  {
            return "BAD";
          }
    }

    public function testlink(){
        $isAllGood = true;
        $films = Phim::all();
        foreach($films as $film ){
            $id = $film->id;
            $name = $film->tenphim;
            $url  = $film->url;
            $status = TestLinkController::pingLink($url);
            if( strcmp($status ,"GOOD")==0){
                //echo "<font color='blue'><h2>$status.<a href=$url> $name</a></h2></font>";
            } else {
                $isAllGood = false;
                echo "<font color='red'><p>|<a href=/update/$id >Fix</a>| $status  # <a href=$url> $name</a> </p></font>";
            }
        }
        if($isAllGood){
            echo "<h1>Everything is good! =)</h1>";
        }
        return view ("testlink");
    }

    public function updateURL($id){
        $film = Phim::find($id);
        return view("update",[
            'film'=>$film
        ]);
    }
}
