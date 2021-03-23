<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('login', function () {
    return view('login');
});


Route::get('register', function () {
    return view('register');
});



Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth');




//user auths 

Route::post('/login', [
     
    'uses' => 'UserController@loginview',
    'as' => 'user.loginview'
    
    
    ]);

    Route::post('/dashboard', [
     
        'uses' => 'UserController@getDashboard',
        'as' => 'user.dashboard'
        
        
        ]);

    Route::post('/register', [
     
        'uses' => 'UserController@RegisterUser',
        'as' => 'user.register'
        
        
        ]);
    
        Route::post('/dologin', [
     
            'uses' => 'UserController@doLogin',
            'as' => 'user.dologin'
            
            
            ]);
       
 
    Route::get('/logout', [
     
    'uses' => 'UserController@doLogout',
    'as' => 'user.logout'
    
    
    ]);






         



//blogposts crud

Route::get('manageblogpost', [
     
    'uses' => 'BlogpostController@index',
    'as' => 'view.manageblogpost'
    ])->middleware('auth');


 

Route::get('addblogpost', [
     
    'uses' => 'BlogpostController@create',
    'as' => 'form.addblogpost'
    ])->middleware('auth');
    
    
    Route::post('submitaddblogpost', [
     
        'uses' => 'BlogpostController@store',
        'as' => 'action.addblogpost'
        ])->middleware('auth');
        
        
            
        
        Route::post('submitupdateblogpost', [
     
            'uses' => 'BlogpostController@update',
            'as' => 'action.updateblogpost'
            ])->middleware('auth');
            
     
            
        Route::post('deleteblogpost', [
     
            'uses' => 'BlogpostController@destroy',
            'as' => 'user.deleteblogpost'
            ])->middleware('auth');
    
                
         
            


//driverss crud

Route::get('managedrivers', [
     
    'uses' => 'DriversController@index',
    'as' => 'view.managedrivers'
    ])->middleware('auth');


 

Route::get('adddrivers', [
     
    'uses' => 'DriversController@create',
    'as' => 'form.adddrivers'
    ])->middleware('auth');
    
    
    Route::post('submitadddrivers', [
     
        'uses' => 'DriversController@store',
        'as' => 'action.adddrivers'
        ])->middleware('auth');
        
        
            
        
        Route::post('submitupdatedrivers', [
     
            'uses' => 'DriversController@update',
            'as' => 'action.updatedrivers'
            ])->middleware('auth');
            
     
            
        Route::post('deletedrivers', [
     
            'uses' => 'DriversController@destroy',
            'as' => 'user.deletedrivers'
            ])->middleware('auth');
    
                
         
             



//vehicless crud

Route::get('managevehicles', [
     
    'uses' => 'VehiclesController@index',
    'as' => 'view.managevehicles'
    ])->middleware('auth');


 

Route::get('addvehicles', [
     
    'uses' => 'VehiclesController@create',
    'as' => 'form.addvehicles'
    ])->middleware('auth');
    
    
    Route::post('submitaddvehicles', [
     
        'uses' => 'VehiclesController@store',
        'as' => 'action.addvehicles'
        ])->middleware('auth');
        
        
            
        
        Route::post('submitupdatevehicles', [
     
            'uses' => 'VehiclesController@update',
            'as' => 'action.updatevehicles'
            ])->middleware('auth');
            
     
            
        Route::post('deletevehicles', [
     
            'uses' => 'VehiclesController@destroy',
            'as' => 'user.deletevehicles'
            ])->middleware('auth');
    