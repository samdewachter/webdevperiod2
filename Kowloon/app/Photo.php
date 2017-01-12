<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function Photo(){
        return $this->belongsTo('App\Product');
    }
}
