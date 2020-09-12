<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    public function phim(){
        return $this->belongsTo('App\Phim','phims_id');
    }
}
