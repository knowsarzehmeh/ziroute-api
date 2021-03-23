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
    "Authorization: Bearer sk_live_6262ab6dd82f950a31d39a26ed6b5c3b4006cfd3",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $request = curl_exec($ch); 
 
  if ($request) {

    $result = json_decode($request, true);

    header('Location: ' . $result['data']['authorization_url']);

}

?>