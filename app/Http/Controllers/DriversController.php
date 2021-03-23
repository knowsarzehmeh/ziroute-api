<?php

namespace App\Http\Controllers;

use App\Drivers;
use Illuminate\Http\Request;

use Auth;

use App\User;

use Session;

 
class DriversController extends Controller
{
 
 

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $user = Auth::user();
 

        $getdrivers = Drivers::where('by_user_id', $user->id)->orderBy('id', 'desc')->paginate(50);
      
            return  view('drivers.all', [
                                       'alldrivers' => $getdrivers


                                       ] );


 
    }



 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('drivers.add');

 


    }



    	    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
   

        $user = Auth::user();

          $this->validate($request, 
                  [
'firstname' => 'required', 
'lastname' => 'required', 
'address' => 'required', 
'licenceno' => 'required', 
'license_photo' => 'mimes:jpeg,bmp,png,pdf,jpg', 
'license_expiration_date' => 'required', 
'phonenumber' => 'required', 
'age' => 'required', 
'state_of_origin' => 'required', 
'qualification' => 'required', 

                     
                  

              ]
          );
 
        

         $license_photourl="";
          

          if(request()->license_photo)
          {

              $license_photourl = time().'.'.request()->license_photo->getClientOriginalExtension();

              request()->license_photo->move(public_path('img/uploads'), $license_photourl);

          }
        else{

        	        $license_photourl = $request->license_photo_update;
        }

 

 
 
   
    



      $eloquentadddrivers = new Drivers([
                  
               'firstname' => $request->firstname, 
'lastname' => $request->lastname, 
'address' => $request->address, 
'licenceno' => $request->licenceno, 
'license_photo' => $license_photourl, 
'license_expiration_date' => $request->license_expiration_date, 
'phonenumber' => $request->phonenumber, 
'age' => $request->age, 
'state_of_origin' => $request->state_of_origin, 
'qualification' => $request->qualification 
,
                'by_user_id' => $user->id 
              
          ]);


              $eloquentadddrivers->save();

               Session::flash('message', 'New Drivers Added Successfuly');  

               return redirect('managedrivers');


 }
  




  	    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
   

        $user = Auth::user();
    $row_id = $request->drivers_id;
    
        $drivers = drivers::findOrFail($row_id);
    
      $drivers->firstname = $request->firstname; 
$drivers->lastname = $request->lastname; 
$drivers->address = $request->address; 
$drivers->licenceno = $request->licenceno; 
$drivers->license_expiration_date = $request->license_expiration_date; 
$drivers->phonenumber = $request->phonenumber; 
$drivers->age = $request->age; 
$drivers->state_of_origin = $request->state_of_origin; 
$drivers->qualification = $request->qualification; 

    

        

         $license_photourl="";
          

          if(request()->license_photo)
          {

              $license_photourl = time().'.'.request()->license_photo->getClientOriginalExtension();

              request()->license_photo->move(public_path('img/uploads'), $license_photourl);

          }
        else{

        	        $license_photourl = $request->license_photo_update;
        }

 



   $drivers->license_photo = $license_photourl; 
    
 

              $drivers->save();

               Session::flash('message', 'New Drivers Updated Successfuly');  

               return redirect('managedrivers');


 }
  


   public function destroy(Request $request)
                    {


                    $drivers = Drivers::find($request->drivers_id);
                    $drivers->delete();

                    Session::flash('message', 'Drivers has been removed sucessfully');  



                    return redirect('managedrivers');
         

                     } 






}

    