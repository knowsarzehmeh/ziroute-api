<!--
$curl = curl_init();

$email = "oluyaled@gmail.com";
$amount = 30000;  //the amount in kobo. This value is actually NGN 300

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer sk_test_c32e50e9ef0790055f73e945c23b19d350f90509", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx->status){
  // there was an error from the API
  print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page
print_r($tranx);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $tranx['data']['authorization_url']);

-->

<!--

<HTML>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Payment</title>


<Body style="">

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://js.paystack.co/v1/inline.js"></script>
<div id="paystackEmbedContainer"></div>

<script>
 
   PaystackPop.setup({
   key: 'pk_test_b54779dd144086db23c53a35491d0df0f81bbfe2',
   email: '<?php echo  htmlentities($_GET["email"]) ?>',
   amount: '<?php echo htmlentities($_GET["total"])*100 ?>',
   container: 'paystackEmbedContainer',
   callback: function(response){
        
                  $.ajax('http://ziroute.com/backend/api.php', {
                type: 'POST',  // http method
                data: { 
                        Verify_and_store_wallet_topup_payment:'Verify_and_store_wallet_topup_payment',
                        transaction_ref: response.reference,
                        email_address:  '<?php echo  htmlentities($_GET["email"]) ?>',
                        amount:  '<?php echo htmlentities($_GET["total"])*100 ?>'
                 },  
                success: function (data, status, xhr) {
                   
                  //alert("DATA: "+data);
                 window.location = "payment-callback.php";

                },
                error: function (jqXhr, textStatus, errorMessage) {
                  //alert(textStatus)
                  //  window.location = "payment-callback.php";
                    }
                });


               // window.location = "payment-callback.php";
    },
  });

</script>


</Body>
</Html>

-->
<?php

/*$url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => "customer@email.com",
    'amount' => "20000",
    'callback_url' => ''
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
    "Authorization: Bearer sk_test_c32e50e9ef0790055f73e945c23b19d350f90509",
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
*/

?>


<html>
<head>

<title>Payment</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script>
window.onload = function(){

  setTimeout(() => {
    document.getElementById("pre-loader").style.display="none";
    document.getElementById("instructionals").style.display="block";

     
  }, 5000);
}
</script>
</head>

<body>

<div class="container">
<div class="row">

      <div class="col-md-2"></div>

      <div class="col-md-8" style="padding:40px;">

      <img src="loader.gif" id="pre-loader" style="margin-top:30%; margin-left:42%; height:50px;"/>

      <div id="instructionals" style="display:none;">

      <h3 class="text-left">Card Authorization</h3>

      <p>
      You will be charged N50 to verify and Authorize your card. Kindly enter a valid card detail.
      <br/>
      Click on the proceed button to continue

       
      </p>

      <a href="payment-cardinterface.php?email=<?php echo  htmlentities($_GET["email"]) ?>&total=<?php echo  htmlentities($_GET["total"]) ?>" 
      style="margin-top:5%;"
      class="btn btn-primary col-md-12">Proceed </a>


                    <div class="row" style="width:100%">


                    <div class="col-md-12 text-center" style="margin-top:10%;">
                    <img src="mastercard-visa-logo-nobg.png"  style="height:80px; "/>
                     </div>


                    

                    </div>



      </div>


      

      </div>
      <div class="col-md-2"></div>



</div>
</div>

</body>
</html>