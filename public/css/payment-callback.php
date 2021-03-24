<?php 
$curl = curl_init();



$servername="localhost";
$username="oforsoft_mbk";
$database="oforsoft_mbk"; 
$password="1qaz2wsx3edc"; 
$con = mysqli_connect($servername,$username,$password,$database); 

  
$reference = htmlentities($_GET["reference"]);

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer sk_live_6262ab6dd82f950a31d39a26ed6b5c3b4006cfd3",
    "Cache-Control: no-cache",
  ),
));


$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($response) 
   {

  $result = json_decode($response, true);

  //echo $response;
  
  $customer_email = $result['data']['customer']['email'];

  $insert_into = mysqli_query($con,"UPDATE users SET paystack_reference='$response' WHERE email='$customer_email' ");

 // echo $insert_into;

  //echo "Customer email: ".$result['data']['customer']['email'];

 // header('Location: ' . $result['customer']['email']);

  }

/*
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}*/

?>