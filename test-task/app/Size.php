<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{

    protected $fillable = [
        'sign'
    ];

    public $timestamps = false;

    public function items()
    {
        return $this->belongsToMany('App\Item');
    }

}
