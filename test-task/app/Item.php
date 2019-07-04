<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'avatar_url'
    ];

    public $timestamps = false;

    public function sizes()
    {
        return $this->belongsToMany('App\Size');
    }

}
