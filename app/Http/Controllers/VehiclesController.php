<?php

namespace App\Http\Controllers;

use App\Vehicles;
use Illuminate\Http\Request;

use Auth;

use App\User;

use Session;

 
class VehiclesController extends Controller
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
 

        $getvehicles = Vehicles::where('by_user_id', $user->id)->orderBy('id', 'desc')->paginate(50);
      
            return  view('vehicles.all', [
                                       'allvehicles' => $getvehicles


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
        return view('vehicles.add');

 


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
'by_driver_id' => 'required', 
'model' => 'required', 
'year' => 'required', 
'license_plate' => 'required', 
'color' => 'required', 
'booking_type' => 'required', 

                     
                  

              ]
          );
 
        

        
 
 
   
    



      $eloquentaddvehicles = new Vehicles([
                  
               'by_driver_id' => $request->by_driver_id, 
'model' => $request->model, 
'year' => $request->year, 
'license_plate' => $request->license_plate, 
'color' => $request->color, 
'booking_type' => $request->booking_type 
,
                'by_user_id' => $user->id 
              
          ]);


              $eloquentaddvehicles->save();

               Session::flash('message', 'New Vehicles Added Successfuly');  

               return redirect('managevehicles');


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
    $row_id = $request->vehicles_id;
    
        $vehicles = vehicles::findOrFail($row_id);
    
      $vehicles->by_driver_id = $request->by_driver_id; 
$vehicles->model = $request->model; 
$vehicles->year = $request->year; 
$vehicles->license_plate = $request->license_plate; 
$vehicles->color = $request->color; 
$vehicles->booking_type = $request->booking_type; 

    

        

        


   
    
 

              $vehicles->save();

               Session::flash('message', 'New Vehicles Updated Successfuly');  

               return redirect('managevehicles');


 }
  


   public function destroy(Request $request)
                    {


                    $vehicles = Vehicles::find($request->vehicles_id);
                    $vehicles->delete();

                    Session::flash('message', 'Vehicles has been removed sucessfully');  



                    return redirect('managevehicles');
         

                     } 






}

    