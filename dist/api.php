<?php

//A simple API written in PHP to process the APP Informations
 /*
 $servername="localhost";
 $username="root";
 $password=""; 
 $database="mybiker"; 



 status 5: ride accepted
 status 0: not accepted
 status 6: rider arrived
 status 9: Waiting for customer to confrim the trip has started
 status 10: trip started
status 11: trip canceled
status 12: trip completed

 */

 $servername="localhost";
 $username="root";
 $database="ziroute_db"; 
 $password="davidGMAIL@15"; 
 $con = mysqli_connect($servername,$username,$password,$database); 


 function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}

 function notificationInserter($category, $user_id, $message)
{

    $created_at = date("Y-m-d H:i:s");
$updated_at = date("Y-m-d H:i:s");



$insert_data = mysqli_query($con,"INSERT INTO notifications(`category`,`for_user_id`,`message`,`by_user_id`,`created_at`,`updated_at`) 
VALUES('$category','$user_id','$message','4','$created_at','$updated_at')" ); 
if($insert_data) 
{ 

}
       

}
 function getUserIDFromToken($con,$token)
 {

    $user_id = null;

    $select_user_id  = mysqli_query($con,"SELECT * FROM users"); 

    while ($r_uid = mysqli_fetch_array($select_user_id))
    {

        if( md5($r_uid['id']) == $token ){

            $user_id = $r_uid['id'];
        }

    }
return $user_id;
 }
  
 
 function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

 
//Our custom function.
function generatePIN($digits = 4){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

  //create new Customer Endpoint 

  if(isset($_POST['Create_users'])) 
{

$name = mysqli_real_escape_string($con,$_POST['name']); 
$email = mysqli_real_escape_string($con,$_POST['email']); 
$myphone = mysqli_real_escape_string($con,$_POST['myphone']); 

$password = mysqli_real_escape_string($con,$_POST['password']);  //generates random passwords.
$options = ['cost' => 12];


$phash = password_hash($password, PASSWORD_DEFAULT, $options);
  
$role = mysqli_real_escape_string($con,$_POST['role']); 

$created_at = date("Y-m-d H:i:s");


$updated_at = date("Y-m-d H:i:s");

$insert_data = mysqli_query($con,"INSERT INTO users(`phonenumber`,`name`,`email`,`password`,`role`,`created_at`,`updated_at`) 
VALUES('$myphone','$name','$email','$phash','$role','$created_at','$updated_at')" ); 
if($insert_data) 
{ 
//return json message 

$myObj->status = "success";
$myObj->message = "User: ".$role." Created Sucessfully";
$myObj->data = [];

$myJSON = json_encode($myObj);

echo $myJSON;


}
else
{
    
    
$myObj->status = "failed";
$myObj->message = "Error: ".mysqli_error($con)."";
$myObj->data = [];

$myJSON = json_encode($myObj);

echo $myJSON;
 //mysqli_error($con); 
}
 
} 


//vehicle management

//Create
else if(isset($_POST['AddVehicle']))
{
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $model = mysqli_real_escape_string($con,$_POST['model']); 
    $brand = mysqli_real_escape_string($con,$_POST['brand']); 
    $year = mysqli_real_escape_string($con,$_POST['year']); 
    $license_plate = mysqli_real_escape_string($con,$_POST['license_plate']); 
    $color = mysqli_real_escape_string($con,$_POST['color']); 
    $booking_type = mysqli_real_escape_string($con,$_POST['booking_type']); 
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
    //get the user id 

    $user_id = null;

    $select_user_id  = mysqli_query($con,"SELECT * FROM users"); 

    while ($r_uid = mysqli_fetch_array($select_user_id))
    {

        if( md5($r_uid['id']) == $user_token )
        {

            $user_id = $r_uid['id'];
        }

    }

    //insert into vehicles 
    $insert_data = mysqli_query($con,"INSERT INTO 
    vehicles(`model`,`brand`,`year`,`license_plate`,
    `color`,`booking_type`,
    `created_at`,`updated_at`,`by_user_id`,`by_driver_id`) 
    VALUES('$model','$brand','$year','$license_plate', '$color', '$booking_type',
    '$created_at','$updated_at', '$user_id','$user_id')" ); 
    if($insert_data) 
    { 
                    
        $myObj->status = "success";
        $myObj->message = "Vehicle Added Successfully";
        $myObj->data = [];
        $myJSON = json_encode($myObj);
        echo $myJSON;
     }
    else{

        $myObj->status = "failed";
        $myObj->message = "Error: ".mysqli_error($con)."";
        $myObj->data = [];
        $myJSON = json_encode($myObj);
        echo $myJSON;


    }
    
}


//Update 

else if(isset($_POST['UpdateVehicle']))
{

    $vehicle_id = mysqli_real_escape_string($con,$_POST['vehicle_id']);  //md5 of the user's id
    $model = mysqli_real_escape_string($con,$_POST['model']); 
    $brand = mysqli_real_escape_string($con,$_POST['brand']); 
    $year = mysqli_real_escape_string($con,$_POST['year']); 
    $license_plate = mysqli_real_escape_string($con,$_POST['license_plate']); 
    $color = mysqli_real_escape_string($con,$_POST['color']); 
    $booking_type = mysqli_real_escape_string($con,$_POST['booking_type']); 
    $updated_at = date("Y-m-d H:i:s");

    
    //update 

    $update_vehicle = mysqli_query($con, "UPDATE vehicles SET 	
    `model`='$model',
    `brand`='$brand',
    `year`='$year',
    `license_plate`='$license_plate',
    `color`='$color',
    `booking_type`='$booking_type',
    `updated_at`='$updated_at'

    WHERE id='$vehicle_id'

    
     ");


 

     if($update_vehicle)
     {
        $myObj->status = "success";
        $myObj->message = "Vehicle Status updated successfully";
        $myObj->data = [];
        
        $myJSON = json_encode($myObj);
        
        echo $myJSON;

     }
     else{

        
     }





}



//get payment information 

else if(isset($_GET['GetPaymentInformation'])) 
{

    $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

     $user_id;

    $select_stmt = mysqli_query($con,"SELECT paystack_reference FROM users where id='$user_id' ");
    $rows = array();
    while($r = mysqli_fetch_assoc($select_stmt))
    {
    $rows[]=$r;
    }
 
    $myObj->status = "success";
    $myObj->message = "Payment Reference";
    $myObj->data = $rows;
    
    $myJSON = json_encode($myObj);
    
    echo $myJSON;


}


//get notification 

else if(isset($_GET['Notifications'])) 
{

    $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

     $user_id;

    $select_stmt = mysqli_query($con,"SELECT * FROM notifications where for_user_id='$user_id' ");
    $rows = array();
    while($r = mysqli_fetch_assoc($select_stmt))
    {
    $rows[]=$r;
    }
 
    $myObj->status = "success";
    $myObj->message = "User Notifications";
    $myObj->data = $rows;
    
    $myJSON = json_encode($myObj);
    
    echo $myJSON;


}


else if(isset($_POST['Get_Current_Balance'])) 
{

    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

    $wallet_balance = mysqli_query($con,"SELECT * FROM users WHERE id='$user_id'");

    $wallet_balance_amount=0;

    while($r = mysqli_fetch_assoc($wallet_balance))
    {
    $wallet_balance_amount=$r['wallet_balance'];
    }



    echo $wallet_balance_amount;
}

else if(isset($_POST['RideHistory'])) 
{

    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);


     
   // $select_rider_history =  mysqli_query($con,"SELECT * FROM delievery_logs WHERE by_customer_id='$user_id' ");
    $select_rider_history = mysqli_query($con," SELECT * , delievery_logs.id AS did  FROM delievery_logs INNER JOIN users
    ON users.id = delievery_logs.by_rider_id
     WHERE delievery_logs.by_customer_id = '$user_id' AND delievery_logs.status= '12'  ");

    
    $rows = array();
    while($r = mysqli_fetch_assoc($select_rider_history))
    {
    $rows[]=$r;
    }
 
    $myObj->status = "success";
    $myObj->message = "User Ride History";
    $myObj->data = $rows;
    $myJSON = json_encode($myObj, JSON_PRETTY_PRINT);
    echo $myJSON;

}

//get user wallet total 
else if(isset($_GET['WalletTotal'])) 
{

    $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

    $select_stmt = mysqli_query($con,"SELECT SUM(amount) FROM wallets where rider_id='$user_id' ");
    $rows = array();
    while($r = mysqli_fetch_assoc($select_stmt))
    {
    $rows[]=$r;
    }
 
    $myObj->status = "success";
    $myObj->message = "User Wallet Total";
    $myObj->data = $rows;
    
    $myJSON = json_encode($myObj);
    
    echo $myJSON;


}

else if(isset($_POST['Verify_and_store_wallet_topup_payment'])) 
{

    $email = mysqli_real_escape_string($con,$_POST['email_address']);
    $transaction_ref = mysqli_real_escape_string($con,$_POST['transaction_ref']);
    $amount = mysqli_real_escape_string($con,$_POST['amount'])/100;

    $get_current_user_id =  mysqli_query($con,"SELECT * FROM users WHERE email='$email' ");
    $user_id = 0;

    
    //START 
/*
  


    
$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/7PVGX8MEk85tgeEpVDtD';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer SECRET_KEY']
);
$request = curl_exec($ch);
curl_close($ch);

if ($request) {
    $result = json_decode($request, true);
    // print_r($result);
    if($result){
      if($result['data']){
        //something came in
        if($result['data']['status'] == 'success'){
         */

            //Transaction Successfull
            while($r = mysqli_fetch_assoc($get_current_user_id))
            {
                $user_id  = $r['id'];
            }
           // echo "user_id:". $user_id;

           //store record in db log 

           $insert_log_transaction = mysqli_query($con,"INSERT INTO wallets");
            
           $update_wallet = mysqli_query($con,"UPDATE users SET wallet_balance = wallet_balance + $amount WHERE id = '$user_id' ");
        
             if($update_wallet)
             {
                //echo "Balance Updated";
             }
             else{
        
                //echo "Balance not updated";
             }




/*
        }else{
          // the transaction was not successful, do not deliver value'
          // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
        //  echo "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
        }
      }else{
        //echo $result['message'];
      }

    }else{
      //print_r($result);
     // die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
    }
  }else{
    //var_dump($request);
    //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
  }
  */

  //END


    

}


//get user wallet  history
else if(isset($_POST['GetProfileDetails'])) 
{
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

    
    $select_stmt = mysqli_query($con,"SELECT * FROM users WHERE id='$user_id' ");
    $rows = array();
    while($r = mysqli_fetch_assoc($select_stmt))
        {
           $rows[]=$r;
        }


        $myObj->status = "success";
        $myObj->message = "User Profile Details";
        $myObj->data = $rows;
        
        $myJSON = json_encode($myObj);
        
        echo $myJSON;


}


//get user wallet  history
else if(isset($_GET['WalletHistory'])) 
{

    $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

 
    $select_stmt = mysqli_query($con,"SELECT delievery_logs.pickup_address, delievery_logs.delievery_address,   users.name, users.email, wallets.amount, wallets.updated_at, users.user_photo, wallets.payment_method, wallets.id AS walletid from wallets  inner join users  on
users.id = wallets.rider_id inner join delievery_logs  on 
delievery_logs.by_customer_id = wallets.customer_id 
 WHERE delievery_logs.by_rider_id = '$user_id' AND delievery_logs.status= '12' ");

   // $select_stmt = mysqli_query($con,"SELECT * FROM wallets where rider_id='$user_id' ");
    $rows = array();
    while($r = mysqli_fetch_assoc($select_stmt))
    {
    $rows[]=$r;
    }
 
    $myObj->status = "success";
    $myObj->message = "User Wallet History";
    $myObj->data = $rows;
    
    $myJSON = json_encode($myObj);
    
    echo $myJSON;

    }


//list of vehicles of the current rider 

else if(isset($_GET['MyVehicles'])) {

    $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

    $select_stmt = mysqli_query($con,"SELECT * FROM vehicles where by_user_id='$user_id' ");
    $rows = array();
    while($r = mysqli_fetch_assoc($select_stmt)) {
    $rows[]=$r;
    }
 
    $myObj->status = "success";
    $myObj->message = "Vehicle Status updated successfully";
    $myObj->data = $rows;
    
    $myJSON = json_encode($myObj);
    
    echo $myJSON;

    }

//Delete Vehicle

else if(isset($_POST['DeleteVehicle'])) {
    $idy = mysqli_real_escape_string($con,$_POST['vehicle_id']);
    $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

    $delete_stmt = mysqli_query($con, " DELETE  FROM vehicles WHERE id=$idy AND by_user_id='$user_id' ");
    
    if($delete_stmt)
    {
        $myObj->status = "success";
        $myObj->message = "Vehicle deleted !";
        $myObj->data = [];
        
        $myJSON = json_encode($myObj);
        
        echo $myJSON;

    }
    else
    {
    
        $myObj->status = "failed";
        $myObj->message = "Delete failed !";
        $myObj->data = [];
        
        $myJSON = json_encode($myObj);
        
        echo $myJSON;


    }
    }



    
else if(isset($_POST['UpdateUserProfile'])) {

    
    //echo var_dump($_FILES['license_image_base64']);

    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);
    
        $target_dir = "img/uploads/";
        $filename_img = basename($_FILES["license_image_base64"]["name"]);

        $target_file = $target_dir . basename($_FILES["license_image_base64"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_FILES["license_image_base64"])) {
        $check = getimagesize($_FILES["license_image_base64"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 
        else {
            echo "File is not an image.";
            //$uploadOk = 0;
        }


                    // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["license_image_base64"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["license_image_base64"]["name"]). " has been uploaded.";
                } else {
                echo "Sorry, there was an error uploading your file.";
                }
            }


        
    }



 
    $firstname = mysqli_real_escape_string($con,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
    $phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']);
    $email = mysqli_real_escape_string($con,$_POST['email']);

    $name = $lastname." ".$firstname;
  
 
    
 

   //insert into vehicles 
   $update_data = mysqli_query($con,"UPDATE users SET `email`='$email', `name`='$name', `user_photo`='$filename_img', `phonenumber`='$phonenumber' WHERE id='$user_id'    "); 
   
   
    if($update_data)
    {
        $myObj->status = "success";
        $myObj->message = "License updated !";
        $myObj->data = [];
        
        $myJSON = json_encode($myObj);
        
        echo $myJSON;

    }
     
  

        }


    
 
else if(isset($_POST['UpdateDriverLicense'])) {
    $license_image_base64 = mysqli_real_escape_string($con,$_POST['license_image_base64']);
    $license_number = mysqli_real_escape_string($con,$_POST['license_number']);
    $expiry_date = mysqli_real_escape_string($con,$_POST['expiry_date']);

    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $user_id =  getUserIDFromToken($con,$user_token);

   //insert into vehicles 
   $insert_data = mysqli_query($con,"INSERT INTO 
   drivers(`license_photo`,`license_expiration_date`,`licenceno`,`by_user_id`) 
   VALUES('$license_image_base64','$expiry_date','$license_number','$user_id')" ); 
   
   
    if($insert_data)
    {
        $myObj->status = "success";
        $myObj->message = "License updated !";
        $myObj->data = [];
        
        $myJSON = json_encode($myObj);
        
        echo $myJSON;

    }
    else
    {
    
        $myObj->status = "failed";
        $myObj->message = "not uploaded";
        $myObj->data = [];
        
        $myJSON = json_encode($myObj);
        

        echo $myJSON;


    }

        }



        
else if(isset($_POST['delieveryTimeDetails']))
{

    //this will show the current request
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']); 
     $user_id =  getUserIDFromToken($con,$user_token);
  

$select_ = mysqli_query($con,"SELECT * , delievery_logs.id AS did from delievery_logs  inner join users  on
users.id = delievery_logs.by_rider_id inner join current_rider_positions  on 
current_rider_positions.rider_id = users.id 
 WHERE delievery_logs.by_rider_id = '$user_id' AND delievery_logs.status != '0' ");

     $rows=array();

    while($row_select_ = mysqli_fetch_assoc($select_))
    {
            if($row_select_['status'] == 12 || $row_select_['status'] == '12' )
            {
                continue;
            }
        $rows[]=$row_select_; 


    }

    $myObj->status = "success";
    $myObj->message = "Accepted Dispatch Rider Details Below";
    $myObj->data = $rows;
    $myJSON = json_encode($myObj);

    echo $myJSON;


   // echo json_encode($rows); 

    
 }

 

 
   
        

        //get riders liscnes
        else if(isset($_POST['CheckCurrentRequests']))
        {

            $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
            $user_id =  getUserIDFromToken($con,$user_token);

             $select_stmt = mysqli_query($con,"SELECT * FROM delievery_logs where  `by_rider_id`='$user_id'  ");

            $count_found=0;

            while($row_s = mysqli_fetch_array($select_stmt))
            {
               if( $row_s['status'] != 0 && $row_s['status'] !=12)
                {
                    $count_found  = $row_s['status'];
                }
                 
            }


            echo $count_found;


        }




        //get riders liscnes
        else if(isset($_GET['RideRequests'])) {

            $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
            $user_id =  getUserIDFromToken($con,$user_token);
        
            $array=($user_id);
            $select_stmt = mysqli_query($con,"SELECT * FROM delievery_logs where  `status`='0'  ");
            $rows = array();
            while($r = mysqli_fetch_assoc($select_stmt)) {

            $close_riders=  explode(",",$r['close_riders_id']);

            if(in_array($user_id, $close_riders))
            $rows[]=$r;


            }
         
            $myObj->status = "success";
            $myObj->message = "Your requests";
            $myObj->data = $rows;
            
            $myJSON = json_encode($myObj,JSON_PRETTY_PRINT);
            
            echo $myJSON;
        
            }

            //Accept request

             //get riders liscnes
        else if(isset($_POST['AcceptRequests'])) {

            $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
            $user_id =  getUserIDFromToken($con,$user_token);
            $did =  mysqli_real_escape_string($con,$_POST['did']);
        
             $update_stmt = mysqli_query($con,"UPDATE  delievery_logs SET `status`='5', `by_rider_id`='$user_id' WHERE id='$did'  ");
        
            $myObj->status = "success";
            $myObj->message = "Ride Accepted";
            $myObj->data = [];
            $myJSON = json_encode($myObj,JSON_PRETTY_PRINT);
            echo $myJSON;
        
            }


        



//get riders liscnes
        else if(isset($_GET['MyLicense'])) {

            $user_token = mysqli_real_escape_string($con,$_GET['user_token']);  //md5 of the user's id
            $user_id =  getUserIDFromToken($con,$user_token);
        
            $select_stmt = mysqli_query($con,"SELECT * FROM drivers where by_user_id='$user_id' ");
            $rows = array();
            while($r = mysqli_fetch_assoc($select_stmt)) {
            $rows[]=$r;
            }
         
            $myObj->status = "success";
            $myObj->message = "Licence details";
            $myObj->data = $rows;
            
            $myJSON = json_encode($myObj);
            
            echo $myJSON;
        
            }




else if(isset($_POST['Rider_KYC']))
{
 
    $user_id = mysqli_real_escape_string($con,$_POST['user_id']); 

    $passportImage = $_POST['passportImage']; 
    $homeaddress = mysqli_real_escape_string($con,$_POST['homeaddress']); 
    $phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']); 
    $accountbank = mysqli_real_escape_string($con,$_POST['accountbank']); 
    $accountnumber = mysqli_real_escape_string($con,$_POST['accountnumber']); 
    $accountname = mysqli_real_escape_string($con,$_POST['accountname']); 
    $driverlicense = $_POST['driverlicense']; 

 
    $image_location_folder = "img/uploads/";

    $image_location_file_name = "userpassport".rand( rand(5 , 50) , rand( 500 , 900 ) ) .
                                "_" . date("i") . "_" . date("d_m_Y") . ".png";

                                
    $image_location_file_name_dl = "driverlicense".rand( rand(5 , 50) , rand( 500 , 900 ) ) .
    "_" . date("i") . "_" . date("d-m-Y") . ".png";

 
        $img = str_replace('data:image/png;base64,', '', $passportImage);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents($image_location_folder.$image_location_file_name, $data);
 

        //drivers lincense
       
  
        $img_dl = str_replace('data:image/png;base64,', '', $driverlicense);
        $img_dl = str_replace(' ', '+', $img_dl);
        $data_dl = base64_decode($img_dl);
        file_put_contents($image_location_folder.$image_location_file_name_dl, $img_dl);
 
        //check driver license later. 

        //end drivers license

        $update_kyc = mysqli_query($con, "UPDATE users SET 	
        `passportImage`='$image_location_file_name',
        `homeaddress`='$homeaddress',
        `phonenumber`='$phonenumber',
        `accountbank`='$accountbank',
        `accountnumber`='$accountnumber',
        `accountname`='$accountname' ,     
        `approved`='2',
        `driverlicense`='$image_location_file_name_dl'

        WHERE id='$user_id'
 
        
         ");


if($update_kyc)
{

    echo "KYC SUBMITTED";
}

else{

    echo "KYC NOT SUBMITTED";
}

}

else if(isset($_POST['Confirm_Dispatch_Rider_Approval']))
{

    //this block confirms if the rider has been approved or not; 


    $select_stmt = mysqli_query($con,"SELECT * FROM users WHERE `id`='$user_id' "); 

    while ($r = mysqli_fetch_array($select_stmt))
    {


        if($r['approved'] ==1)
        {

            echo 1; //Rider has been approved, rider can accept rides and the likes...
        }
        else{
            echo 0; //not approved, rider needs to fill in KYC information.
        }
        
    }



}


 
else if(isset($_POST['Login_User']))
{


    $ccc=0;
  
$email = mysqli_real_escape_string($con,$_POST['email']); 
$password = mysqli_real_escape_string($con,$_POST['password']); 

 $select_stmt = mysqli_query($con,"SELECT * FROM users WHERE `email`='$email' "); 

while ($r = mysqli_fetch_array($select_stmt))
{
 
    $ccc=5;



   if (password_verify($password, $r['password'])) 
   {
  
 /*    echo "1 - ".$r['name']." -".$r['id']." -".$r['approved']."-".$r['passportImage'];
   */

$userData->name =   $r['name'];
$userData->token =   md5($r['id']);
$userData->email =   $email;
 
   
$myObj->status = "success";
$myObj->message = "Login Success";
$myObj->data = $userData;

$myJSON = json_encode($myObj);

echo $myJSON;
   
    
    

} else {
   // echo 0 . " = ". mysqli_error($con);
   
$myObj->status = "failed";
$myObj->message = "Error: ".mysqli_error($con)."";
$myObj->data = [];

$myJSON = json_encode($myObj);

echo $myJSON;
}
 

}


if($ccc ==0)
{
    $myObj->status = "failed";
    $myObj->message = "Error";
    $myObj->data = [];
    
    $myJSON = json_encode($myObj);
    echo $myJSON;
}


 
 
}


//phone verification endpoint 

else if(isset($_POST['Phone_Verification']) )
{


$phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']); 
 

echo "the phone: ".$phonenumber;
//generate the random number 

$pin = generatePIN();
//end generate the random number
 
//store generated PIN
//make sure the user doesnt have a current code pending...

$counter1=0;
$check_if_pending_pin = mysqli_query($con,"SELECT * FROM  phone_verification WHERE phonenumber='$phonenumber' ");
while($row_check_if_pending_pin = mysqli_fetch_array($check_if_pending_pin))
{

 $counter1++;

}


$delete_code = mysqli_query($con,"DELETE  FROM phone_verification WHERE phonenumber='$phonenumber'");
  
  $insert_code = mysqli_query($con,"INSERT into phone_verification(`phonenumber`,`generated_code`)
  VALUES('$phonenumber','$pin') ");
 
//end store generated PIN



 //send to numbers supported by smartsms solutions
 
/*
$message = urlencode('Your MYBIKERNG verification number is: '.$pin);
$sender = urlencode('MyBikerNG');
$to = $phonenumber; 
$token = 'vSb0HALhlxffWmebSciMLIbDmiqanOG7Av5PmC6APXjNVwhAGdkxB7TiqkuhSfu3lNDS0QEWY27koMcEwRrTQoLtUxzQ6TD52dIz';
$routing = 2; 
$type = 1;
$baseurl = 'http://smartsmssolutions.com/api/json.php?';
$sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$sender.'&type='.$type.'&routing='.$routing.'&token='.$token;

$response = file_get_contents($sendsms);

 
echo json_encode($response);
*/ 

//send to dnd not supported using bulksmsnigeria

 
$message = urlencode('Your MYBIKERNG verification number is: '.$pin);
$sender = urlencode('MyBikerNG');
$to = $phonenumber; 
$token_bsn = 'rkhToU5NaOJNm3ngyGSxcpcmtbzPYJB02brLl95DLmlvGiUD6JIvE8SRG7jI';

$baseurl_bsn = 'https://www.bulksmsnigeria.com/api/v1/sms/create?';
$sendsms_bsn = $baseurl_bsn.
'api_token='.$token_bsn.
'&to='.$to.
'&from='.$sender.
'&body='.$message;


$response_bsn = file_get_contents($sendsms_bsn);

 
echo json_encode($response_bsn);
 
// response
// echo  $phonenumber;



}



else if(isset($_POST['Confirm_Phone_Code']))
{

    $phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']); 
    $thecode = mysqli_real_escape_string($con,$_POST['thecode']); 

   // echo "The phone number: ".$phonenumber;

   $counter1=0;

   $verify_code = mysqli_query($con,"SELECT * FROM  phone_verification WHERE 
   generated_code='$thecode'  AND phonenumber='$phonenumber' ");
   while($row_verify_code = mysqli_fetch_array($verify_code))
   {
   
    $counter1 =5;
   
   }

   echo $counter1;



}


//this returns the longitude and latidues of the closest riders around 
//for the mobile app to display it on the home map of the user's app 

else if(isset($_POST['get_closest_riders']))
{

    //this block will notify the closets riders to the customer. The first rider to
    //accept will be shown to the customer

    
    $longitude = mysqli_real_escape_string($con,$_POST['longitude']);  //customer's current longitude
    $latitude = mysqli_real_escape_string($con,$_POST['latitude']);  //customer's current latitude
 
    //using haversine formula
    $get_closest = mysqli_query($con,"SELECT rider_id, latitude, longitude,
    ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) 
    * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) 
    * sin(radians(latitude)) ) ) AS distance 
    FROM current_rider_positions 
    HAVING distance < 20
    ORDER BY distance 
    LIMIT 0 , 20");

 
$rows = array(); 
while($r = mysqli_fetch_assoc($get_closest)) 
{ 

$rows[]=$r; 

}

echo json_encode($rows,JSON_PRETTY_PRINT); 


}




else if(isset($_POST['Notify_Closest_Riders']))
{

    //this block will notify the closets riders to the customer. The first rider to
    //accept will be shown to the customer
    

    
    $longitude  =  mysqli_real_escape_string($con,$_POST['longitude']);  //customer's current longitude
    $latitude   =  mysqli_real_escape_string($con,$_POST['latitude']);  //customer's current latitude

    $user_token =  mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $user_id    =  getUserIDFromToken($con,$user_token);

 
    $pickup_address = mysqli_real_escape_string($con,$_POST['pickup_address']);   
    $delievery_address = mysqli_real_escape_string($con,$_POST['delievery_address']);   
   
   
     // get kilometers from table 
     $add_kilometers=0;
     $total_i=0;
    

     $wallet_balance_amount=0;

     $select_wallet_amount = mysqli_query($con,"SELECT * FROM users WHERE id='$user_id' ");
     while($select_wallet_amount = mysqli_fetch_array($select_wallet_amount))
     {
        $wallet_balance_amount+= $select_wallet_amount['wallet_balance'];
     }

 

     $select_kilometers = mysqli_query($con,"SELECT * FROM tempoary_kms WHERE user_token='$user_token' ");
     while($select_kilometers_row = mysqli_fetch_array($select_kilometers))
     {
         $total_i++;

        $add_kilometers+= $select_kilometers_row['kilometer'];
     }

     
     $sum_kilometers = (100)* ($add_kilometers); //100 naira per kilometer // ( $add_kilometers / $total_i);
        

     if($sum_kilometers  <= $wallet_balance_amount && $sum_kilometers !=0)
     {

        //start

         //delete data from temporay kilometers 
         $deleterr = mysqli_query($con,"DELETE FROM  tempoary_kms WHERE user_token='$user_token' ");


         $created_at = date("Y-m-d H:i:s");
         $updated_at = date("Y-m-d H:i:s");
     
         //using haversine formula
         $get_closest = mysqli_query($con,"SELECT rider_id, 
         ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) 
         * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) 
         * sin(radians(latitude)) ) ) AS distance 
         FROM current_rider_positions 
         HAVING distance < 5
         ORDER BY distance 
         LIMIT 0 , 50");
     
     
         //store the current request details. 
     
        $dele_initial_delievery_log = mysqli_query($con,"DELETE FROM delievery_logs WHERE
         by_customer_id='$user_id' AND status='0' ");
     
     
        $last_insert_delievery_log = 0;
     
         $insert_delievery_log = mysqli_query($con,"INSERT INTO delievery_logs(`by_customer_id`,
          `pickup_address`, `delievery_address`, `customer_longitude`, `customer_latitude`, 
          `rider_longitude`, `rider_latitude`, `item_description_json`, `by_rider_id`, 
          `created_at`, `updated_at`, `status`,`sum_kilometers`)  
          
          VALUES('$user_id', '$pickup_address', '$delievery_address', '$longitude', '$latitude',
          
          '0','0','item description','0','$created_at','$updated_at', '0','$sum_kilometers' )
          ");
          
          if($insert_delievery_log)
          {
            
     
              $last_insert_delievery_log =  mysqli_insert_id($con);
     
          }
          else{
              echo mysqli_error($con);
          }
     
     
     
         //end store current request details.
     
     
     
         //closest locations of 20km max...this value can be updated soon and later
     
        $found = 0; 
        $rider_ids="";
          while($rows = mysqli_fetch_array($get_closest))
          {
     
             $found++;
            // Send the notification to the riders
     
            $rider_id = $rows['rider_id'];
            $rider_ids .= trim($rows['rider_id']).",";
     
            //get the push notification token of the user
            $ptoken="";
            $select_push_token = mysqli_query($con,"SELECT * FROM users WHERE id='$rider_id' ");
            while($row_select_push_token = mysqli_fetch_array($select_push_token))
            {
     
             $ptoken =  $row_select_push_token['push_notification_token'];
     
            }
     
         //   echo $rider_id;
            //notify rider 
     
          
     $url = 'https://exp.host/--/api/v2/push/send';
     $myvars = 'to=' . $ptoken . '&title=Connection Request&body=You have a new rider
      request Click to accept&sound=default&badge=1';
     
     $ch = curl_init( $url );
     curl_setopt( $ch, CURLOPT_POST, 1);
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
     curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
     curl_setopt( $ch, CURLOPT_HEADER, 0);
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
     
     $response = curl_exec( $ch );
     
     
     //return $response;
     
            //end notify rider
     
            //stop at 10 so as not to overwhelm the server
            if($found == 10)
            {
                break ;// stop search at 10
            }
     
         
         }
     
         
     
         $update_delievery_rider_ids = mysqli_query($con,"UPDATE delievery_logs SET close_riders_id='$rider_ids' WHERE id='$last_insert_delievery_log' ");
     
         echo $found;

        //end

     }
     {
         
         //delete data from temporay kilometers 
         $deleterr = mysqli_query($con,"DELETE FROM  tempoary_kms WHERE user_token='$user_token' ");


         if($found ==0)
         {
            echo "insufficient-fund -[]- ".$sum_kilometers;
         }
          
     }

        


}

//this block will send the new Requests to the riders 

else if(isset($_POST['New_Requests_rider']))
{
    //show the new requests for the rider
    $user_id = mysqli_real_escape_string($con,$_POST['user_id']); 

    $longitude = mysqli_real_escape_string($con,$_POST['longitude']); 
    $latitude = mysqli_real_escape_string($con,$_POST['latitude']); 
 
    $select_stmt = mysqli_query($con,"SELECT * FROM delievery_logs  WHERE  `status`='0' "); 


    //using haversine formula
   
    $get_closest_request = mysqli_query($con,"SELECT *, 
    ( 3959 * acos( cos( radians($latitude) ) * cos( radians( customer_latitude ) ) 
    * cos( radians( customer_longitude ) - radians($longitude) ) + sin( radians($latitude) ) 
    * sin(radians(customer_latitude)) ) ) AS distance 
    FROM delievery_logs  
    HAVING distance < 20
    ORDER BY distance 
    LIMIT 0 , 20");


$rows = array(); 
while($r = mysqli_fetch_assoc($get_closest_request)) 
{ 

$rows[]=$r; 

}

echo json_encode($rows,JSON_PRETTY_PRINT); 

//echo "the longitude: ".$longitude."---".$latitude."--".$user_id ;


}


else if(isset($_POST['cancel_request']))
{

    //cancelled request has a status of 11

    
    $request_id = mysqli_real_escape_string($con,$_POST['request_id']); 

    $update_v = mysqli_query($con,"UPDATE delievery_logs SET status='11'  WHERE id='$request_id' ");

        if($update_v)
        {
            echo 1;

        }
        else{

            echo 0;
        }


}


else if( isset($_POST['save_kiliometer']))
{

    $kilometer = mysqli_real_escape_string($con,$_POST['kilometer']); 
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']); 


 

    $insert = mysqli_query($con,"INSERT INTO  tempoary_kms(`kilometer`,`user_token`) 
     VALUES('$kilometer','$user_token')");
   
   echo "getting...xxx".$kilometer." and".$user_token;
     
    
 
} 
else if(isset($_POST['start_trip']))
{

    
    //this will show the current request
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']); 
    $user_id =  getUserIDFromToken($con,$user_token);

    //cancel request set to status 10... means trip has started. 
    $request_id = mysqli_real_escape_string($con,$_POST['request_id']); 

    $update_ = mysqli_query($con,"UPDATE delievery_logs SET `status`='9' WHERE by_rider_id='$user_id' AND status='5' ");
    if($update_)
    {
        
        echo 1;

    }
    else{

        echo 0;

    }


}



else if(isset($_POST['end_trip']))
{

       
    //this will show the current request
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']); 
    $rider_id =  getUserIDFromToken($con,$user_token);

    //this will show the current request
    $delievery_id = mysqli_real_escape_string($con,$_POST['delievery_id']); 
 

  
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
 



    $update_ = mysqli_query($con,"UPDATE delievery_logs SET `status`='12' WHERE id='$delievery_id' ");
    if($update_)
    {

        //echo 1;
            $select_stmt = mysqli_query($con, "SELECT * FROM delievery_logs where id='$delievery_id' AND `status`='12' ");
            while($row_select_stmt = mysqli_fetch_array($select_stmt))
            {
                        $trip_amount = $row_select_stmt['sum_kilometers'];
                        $current_balance = 0;

                        $customer_id = $row_select_stmt['by_customer_id'];
                        $amount = (20/100) * ($row_select_stmt['sum_kilometers']);


                        //update user wallet amount from user account 

                        $current_balance_query = mysqli_query($con,"SELECT * FROM users WHERE id='$customer_id'");
                        while($row_select_stmt_current_balance = mysqli_fetch_array($current_balance_query))
                        {   
                            $current_balance = $row_select_stmt_current_balance['wallet_balance'];
                        
                        }

                        $updated_balance_current  = $current_balance - $trip_amount;

                        $update_balance = mysqli_query($con,"UPDATE users SET `wallet_balance`='$updated_balance_current' WHERE id='$customer_id' ");
                        




                        $insert_wallet = mysqli_query($con,"INSERT INTO wallets(`payment_method`,`rider_id`,`customer_id`,`amount`,`trip_id`,`by_user_id`, `created_at`, `updated_at`)  VALUES('card','$rider_id','$customer_id','$amount','$delievery_id','5', '$created_at', '$updated_at') ");
                        if($insert_wallet)
                        {

                            echo 1;
                            
                        }

    //enter notification 
    notificationInserter("System", $customer_id, "Your delievery has been completed");

            }
    }
    else{

        echo 0;

    }

    //enter notification 
    notificationInserter("System", $rider_id, "Delievery trip has be completed");


}




/*SNIPPETS */

else if(isset($_POST['submit_address']))
{
  $address =$_POST['address']; // Google HQ
  $prepAddr = str_replace(' ','+',$address);
  $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
  $output= json_decode($geocode);
  $latitude = $output->results[0]->geometry->location->lat;
  $longitude = $output->results[0]->geometry->location->lng;
	
  echo "latitude - ".$latitude;
  echo "longitude - ".$longitude;
}

else if(isset($_POST['submit_coordinates']))
{
  $lat=$_POST['latitude'];
  $long=$_POST['longitude'];
	
  $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false";
  $json = @file_get_contents($url);
  $data = json_decode($json);
  $status = $data->status;
  $address = '';
  if($status == "OK")
  {
	echo $address = $data->results[0]->formatted_address;
  }
  else
  {
	echo "No Data Found Try Again";
  }
}

/*SNIPPETS */



 


else if(isset($_GET['trip_waiting_confirmation']))
{
    //check for any trip that needs any current confirmation

    $user_id = mysqli_real_escape_string($con,$_GET['user_id']); 
 
    $get_trips = mysqli_query($con," SELECT * FROM delievery_logs WHERE by_customer_id='$user_id'  AND `status`='9' ");


//echo "The USER ID is ".$user_id."";
$rows = array(); 
while($r = mysqli_fetch_assoc($get_trips)) { 

    if($r['status']==9) //status 9 means trip is awaiting confrimation
    {
        $rows[]=$r; 

    }
 }
   echo json_encode($rows,JSON_PRETTY_PRINT); 


}

else if(isset($_POST['confrim_start_trip']))
{
    //cancel request set to status 9 is to confrim the trip should start by the user. 
    $request_id = mysqli_real_escape_string($con,$_POST['request_id']); 
    $status_code = mysqli_real_escape_string($con,$_POST['status_code']); 


     
  //  echo "the request id is: ".$request_id;
    $update_ = mysqli_query($con,"UPDATE delievery_logs SET `status`='$status_code' WHERE id='$request_id' ");
    if($update_)
    {

        echo 1;

    }
    else{

        echo 0;

    }


}
else if(isset($_POST['current_request']))
{

    //this will show the current request
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']); 
     $user_id =  getUserIDFromToken($con,$user_token);
 
 //    "SELECT * FROM delievery_logs INNER JOIN users ON delievery_logs.rider_id=users.id"
 

//$select_ = mysqli_query($con,"SELECT * FROM delievery_logs WHERE status='5' AND by_customer_id='$user_id' ");
  
  
 /* $select_ = mysqli_query($con," SELECT * , delievery_logs.id AS did  FROM delievery_logs INNER JOIN users
ON users.id = delievery_logs.by_rider_id
 WHERE delievery_logs.by_customer_id = '$user_id' AND delievery_logs.status= '5'  ");
*/


$select_ = mysqli_query($con,"SELECT * , delievery_logs.id AS did from delievery_logs  inner join users  on
users.id = delievery_logs.by_rider_id inner join current_rider_positions  on 
current_rider_positions.rider_id = users.id 
 WHERE delievery_logs.by_customer_id = '$user_id' AND delievery_logs.status != '0' ");

     $rows=array();

    while($row_select_ = mysqli_fetch_assoc($select_))
    {
            if($row_select_['status'] == 12 || $row_select_['status'] == '12' )
            {
                continue;
            }
        $rows[]=$row_select_; 


    }

    $myObj->status = "success";
    $myObj->message = "Accepted Dispatch Rider Details Below";
    $myObj->data = $rows;
    $myJSON = json_encode($myObj);

    echo $myJSON;


   // echo json_encode($rows); 

    
 }

 






else if(isset($_POST['accept_request']))
 {

    //this will accept the request by the rider. 
    //the rider will also, 
    $request_id = mysqli_real_escape_string($con,$_POST['request_id']); 
    $rider_id = mysqli_real_escape_string($con,$_POST['rider_id']); 

    $update_v = mysqli_query($con,"UPDATE delievery_logs SET `status`='5' , by_rider_id='$rider_id'
     WHERE id='$request_id' ");

 
    if($update_v)
    {

        echo  "Request ID".$request_id." and Rider ID:".$rider_id; //1;//'uploaded';

    }
    else{
        echo 0; //"There was an error ".mysqli_error($con);
     
    }

    
    //enter notification 
    notificationInserter("System", $rider_id, "New Request has been accepted");

 }


 else if(isset($_GET['my_pending_trips']))
 {
//this will return a list of the rider's pending trips (Trips accepted by the rider , but not yet started)

$rider_id = mysqli_real_escape_string($con,$_GET['rider_id']); 
 
$get_trips = mysqli_query($con," SELECT * , delievery_logs.id AS did  FROM delievery_logs INNER JOIN users
ON users.id = delievery_logs.by_rider_id
WHERE by_rider_id='$rider_id'  ");


$rows = array(); 
while($r = mysqli_fetch_assoc($get_trips)) { 

    if($r['status']==5)
    {
        $rows[]=$r; 

    }
 }
   echo json_encode($rows,JSON_PRETTY_PRINT); 
 
 }


else if(isset($_GET['delievery_logs']))
 {

    
    //show the new requests for the rider
    $user_id = mysqli_real_escape_string($con,$_GET['user_id']); 

    $longitude = 0; //mysqli_real_escape_string($con,$_GET['longitude']); 
    $latitude =0; // mysqli_real_escape_string($con,$_GET['latitude']); 
 
    $get_lat_long = mysqli_query($con,"SELECT * FROM current_rider_positions WHERE rider_id='$user_id' ");

    while($row_get_lat_long = mysqli_fetch_array($get_lat_long)  )
    {


        $longitude = $row_get_lat_long['longitude'];
        $latitude = $row_get_lat_long['latitude'];


    }


  //  $select_stmt = mysqli_query($con,"SELECT * FROM delievery_logs "); 

    $get_closest_request = mysqli_query($con,"SELECT *, 
    ( 3959 * acos( cos( radians($latitude) ) * cos( radians( customer_latitude ) ) 
    * cos( radians( customer_longitude ) - radians($longitude) ) + sin( radians($latitude) ) 
    * sin(radians(customer_latitude)) ) ) AS distance 
    FROM delievery_logs  
    HAVING distance < 20
    ORDER BY distance 
    LIMIT 0 , 20");


    $rows = array(); 
    while($r = mysqli_fetch_assoc($get_closest_request)) { 

        if($r['status'] !=0){continue;}
    $rows[]=$r; 
    }
       echo json_encode($rows,JSON_PRETTY_PRINT); 



       



 
    }



else if(isset($_POST['Update_Rider_Location']))
{
    $longitude = mysqli_real_escape_string($con,$_POST['longitude']); 
    $latitude = mysqli_real_escape_string($con,$_POST['latitude']); 
    $push_notification_token = mysqli_real_escape_string($con,$_POST['push_notification_token']); 
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $user_id = null;
    $user_token = mysqli_real_escape_string($con,$_POST['user_token']);  //md5 of the user's id
    $select_user_id  = mysqli_query($con,"SELECT * FROM users"); 
    while ($r_uid = mysqli_fetch_array($select_user_id))
    {
        if( md5($r_uid['id']) == $user_token ){
            $user_id = $r_uid['id'];
        }
    }

    //update expo notification token
    $update_push = mysqli_query($con, "UPDATE users SET push_notification_token='$push_notification_token' WHERE id='$user_id' ");


  // echo $longitude."==".$latitude."==".$user_id;


  //enter the riders current location 

    $log_riders_location = mysqli_query($con,"INSERT INTO 
    riders(`rider_id`,`longitude`,`latitude`,`user_id`, `created_at`, `updated_at`) 
    VALUES('$user_id','$longitude','$latitude','$user_id','$created_at','$updated_at')");

    if($log_riders_location)
    {


        //update the riders current location 
        $counter=0;

        $check_if_updated = mysqli_query($con,"SELECT * FROM current_rider_positions WHERE 
        rider_id= '$user_id' ");
         while($row_c = mysqli_fetch_array($check_if_updated))
        {

              $counter=5;
        }

        if($counter == 5 )
        { 
            $delete_old_Record =  mysqli_query($con,
            "DELETE  FROM current_rider_positions WHERE  rider_id='$user_id' ");


            
            $log_riders_location = mysqli_query($con,"INSERT INTO 
            current_rider_positions(`rider_id`,`longitude`,`latitude`,`user_id`, `created_at`, `updated_at`) 
            VALUES('$user_id','$longitude','$latitude','$user_id','$created_at','$updated_at')");
 
              

        }
        else
        {

           
            //record doesnt exist, now update it
        
            $log_riders_location = mysqli_query($con,"INSERT INTO 
            current_rider_positions(`rider_id`,`longitude`,`latitude`,`user_id`, `created_at`, `updated_at`) 
            VALUES('$user_id','$longitude','$latitude','$user_id','$created_at','$updated_at')");
 

        }
 

        $myObj->status = "success";
        $myObj->message = "Rider's position updated";
        $myObj->data = [];

        $myJSON = json_encode($myObj);

        echo $myJSON;


     }
    else{
        echo mysqli_error($con);
    }




}

 
else if(isset($_POST['GET_Current_Request']) )
{

     //this will handle when a customer requests a ride, this will send the notification to 
     //the respective dispatch rider.

     

}


 
else if(isset($_POST['fblogin']) )
{
//login user by facebook... register user if not registered...

$userData = json_decode($_POST['userData']);

$picture =  $userData->picture->data->url;
$email = $userData->email;
$name = $userData->first_name." ".$userData->last_name;

$created_at = date("Y-m-d H:i:s");
$updated_at = date("Y-m-d H:i:s");

$count_email_exists=0;
$theid=0;
$check_if_signedin=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
while($row_c = mysqli_fetch_array($check_if_signedin))
{

 
    $count_email_exists++;
    $theid=$row_c['id'];

}

if($count_email_exists >0)
{
    //exists 
    echo $theid;
}
else{

//firstimer... sign user up
$insert_data = mysqli_query($con,"INSERT INTO users(`name`,`email`,`passportImage`,`created_at`,`updated_at`) 
VALUES('$name','$email','$picture','$created_at','$updated_at')" ); 
if($insert_data) 
{ 

echo mysqli_insert_id($con);
}
else
{
echo 0;
 //mysqli_error($con); 
}


}
//echo "hi";

}


else{

}




?>