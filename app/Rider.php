<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    //    
    protected $fillable = [
        'rider_id' ,
        'latitude',
        'longitude',
        'user_id'

    ];
}
