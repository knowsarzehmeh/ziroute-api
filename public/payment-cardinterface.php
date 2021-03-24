<?php 

$email_address =   htmlentities($_GET["email"]);
$total_number =  "5000"; //htmlentities($_GET["total"]);


$url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => $email_address,
    'amount' => $total_number,
    //'channels' => 'card',
    'callback_url' => 'http://ziroute.com/backend/payment-callback.php'
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
   // "Authorization: Bearer sk_live_61630fd63f281c97494ade9f2f53e06f2de8ca07",
      "Authorization: Bearer sk_test_3f1fe817ba5f4d0aa20a76c697ec4d9ff67ede74",
 
    
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $request = curl_exec($ch); 
 
  if ($request) {

    $result = json_decode($request, true);

    //echo  $result['data']['authorization_url'];
     header('Location: ' . $result['data']['authorization_url']);
 

}

?>