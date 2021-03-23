<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelieveryLog extends Model
{

    //

      //    
      protected $fillable = [
        'by_customer_id' ,
        'pickup_address',
        'delievery_address',
        'customer_longitude',
        'customer_latitude',
        'rider_longitude',
        'rider_latitude',
        'item_description_json',
        'by_rider_id',
        'close_riders_id',
        'status'


    ];

       

}
