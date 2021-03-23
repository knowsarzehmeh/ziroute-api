<?php
							

namespace App; 	


use Illuminate\Database\Eloquent\Model;		


class Blogpost extends Model  	

{		

  
      protected $fillable =['title','content','photo','category','by_user_id'];   

}
    //