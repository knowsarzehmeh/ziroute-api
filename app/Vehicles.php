<?php
							

namespace App; 	


use Illuminate\Database\Eloquent\Model;		


class Vehicles extends Model  	

{		

  
      protected $fillable =['by_driver_id','model','year','license_plate','color','booking_type','by_user_id'];   

}
    //