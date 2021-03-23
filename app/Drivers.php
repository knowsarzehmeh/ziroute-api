<?php
							

namespace App; 	


use Illuminate\Database\Eloquent\Model;		


class Drivers extends Model  	

{		

  
      protected $fillable =['firstname','lastname','address','licenceno','license_photo','license_expiration_date','phonenumber','age','state_of_origin','qualification','by_user_id'];   

}
    //