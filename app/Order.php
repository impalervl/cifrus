<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['officiant_id'];

    public function meals(){

        return $this->belongsToMany('App\Meal');
    }

    public function officiant(){

        return $this->belongsTo('App\Officiant');
    }

}
