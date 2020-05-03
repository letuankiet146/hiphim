<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function create(Request $request){
        $message = new Message();
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();
        return redirect('/');
    }
    public function view(){
        return view ('message');

    }
}
