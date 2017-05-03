<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officiant extends Model
{
    protected $fillable = ['name','second_name',];

    public function orders(){

        return $this->hasMany('App\Order');
    }
}
