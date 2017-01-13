<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    public function Category(){
        return $this->belongsTo('App\Category');
    }

    public function Tag(){
        return $this->belongsTo('App\Tag');
    }

    public function HotItems(){
        return $this->hasMany('App\HotItem');
    }

    public function Faqs(){
        return $this->belongsToMany('App\Faq');
    }

    public function Photos(){
        return $this->hasMany('App\Photo');
    }

    public function Colors(){
        return $this->belongsToMany('App\Color');
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}
