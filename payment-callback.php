<?php 
$curl = curl_init();


 
$servername="localhost";
$username="root";
$database="ziroute_db"; 
$password="davidGMAIL@15"; 


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
    // "Authorization: Bearer sk_live_61630fd63f281c97494ade9f2f53e06f2de8ca07",
       "Authorization: Bearer sk_test_3f1fe817ba5f4d0aa20a76c697ec4d9ff67ede74",
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

   if($insert_into == 1){
           ?>

        <script>
        window.location="payment-success.php";
        </script>
           <?php 
   }else{

    ?>

    <script>
        window.location="payment-error.php";
        </script>
    <?php
 
   }


  }

/*
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}*/

?>



 