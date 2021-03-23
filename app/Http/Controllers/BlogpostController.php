<?php

namespace App\Http\Controllers;

use App\Blogpost;
use Illuminate\Http\Request;

use Auth;

use App\User;

use Session;

 
class BlogpostController extends Controller
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
 

        $getblogpost = Blogpost::where('by_user_id', $user->id)->orderBy('id', 'desc')->paginate(50);
      
            return  view('blogpost.all', [
                                       'allblogpost' => $getblogpost


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
        return view('blogpost.add');

 


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
'title' => 'required', 
'content' => 'required', 
'photo' => 'mimes:jpeg,bmp,png,pdf,jpg', 
'category' => 'required', 

                     
                  

              ]
          );
 
        

         $photourl="";
          

          if(request()->photo)
          {

              $photourl = time().'.'.request()->photo->getClientOriginalExtension();

              request()->photo->move(public_path('img/uploads'), $photourl);

          }
        else{

        	        $photourl = $request->photo_update;
        }

 

 
 
   
    



      $eloquentaddblogpost = new Blogpost([
                  
               'title' => $request->title, 
'content' => $request->content, 
'photo' => $photourl, 
'category' => $request->category 
,
                'by_user_id' => $user->id 
              
          ]);


              $eloquentaddblogpost->save();

               Session::flash('message', 'New Blogpost Added Successfuly');  

               return redirect('manageblogpost');


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
    $row_id = $request->blogpost_id;
    
        $blogpost = blogpost::findOrFail($row_id);
    
      $blogpost->title = $request->title; 
$blogpost->content = $request->content; 
$blogpost->category = $request->category; 

    

        

         $photourl="";
          

          if(request()->photo)
          {

              $photourl = time().'.'.request()->photo->getClientOriginalExtension();

              request()->photo->move(public_path('img/uploads'), $photourl);

          }
        else{

        	        $photourl = $request->photo_update;
        }

 



   $blogpost->photo = $photourl; 
    
 

              $blogpost->save();

               Session::flash('message', 'New Blogpost Updated Successfuly');  

               return redirect('manageblogpost');


 }
  


   public function destroy(Request $request)
                    {


                    $blogpost = Blogpost::find($request->blogpost_id);
                    $blogpost->delete();

                    Session::flash('message', 'Blogpost has been removed sucessfully');  



                    return redirect('manageblogpost');
         

                     } 






}

    