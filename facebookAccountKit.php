<html>
     <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMS OTP Ziroute</title>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- HTTPS required. HTTP will give a 403 forbidden response -->
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>

 
<style>

a, span, h1,h2,h3,h4,h5,h6{
    font-weight: bold !important;
    color: #4c6280 !important;
 }

ul, li {
    font-weight: 100 !important;

}
 .btn-facebook {
    color: #fff;
    background-color: #3b5998;
    border-color: rgba(0,0,0,0.2);
}

.btn-social {
    position: relative;
    padding-left: 44px;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-social:hover {
    color: #eee;
}

.btn-social :first-child {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 40px;
    padding: 7px;
    font-size: 1.6em;
    text-align: center;
    border-right: 1px solid rgba(0,0,0,0.2);
}


</style>
</head>
    <body style="background:url('bgnice.png'); height: 300px; padding:20px;">
    
    
<script>
window.onload = function(){
   //  document.getElementById("btn").click();

}
 </script>
    
    <div>
        
         <input value="+234" id="country_code"  style="display:none;"  />
<input placeholder="phone number" id="phone_number"  style="display:none;" value="<?php echo $_GET['phonenumber']?>"/>

<div>
<div class="col-md-12 text-center" style="margin-top:25%;">
<img src="icon2.png" class="img-circle"  style="height:100px; width:100px; border-radius:50px; border:solid 10px #fff;"/>

</div>
<small>
Ziroute uses Account Kit, a Facebook technology, to help you sign in. You don't need a Facebook account. An SMS or text confirmation may be sent to verify your number. Message and data rates may apply. Learn how Facebook uses your info.
Use SMS</small>
<br/><br/><br/>
<div>
 <button id="btn" onclick="smsLogin();" class="btn btn-primary" style="width:100%;">Continue to Phone  Verification</button> 
   
</div>
     </div>
    
    
    
    <script>
        

   // initialize Account Kit with CSRF protection
  AccountKit_OnInteractive = function(){
    AccountKit.init(
      {
          appId: 356411135070850,
        state: new Date().getTime(), // This should be your XSRF_TOKEN
        version: "v1.1",
        display: "modal",
        debug: true,  // Helps in understanding what went wrong.
        fbAppEventsEnabled: true
      }
    );
  };

  // login callback
  function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      var code = response.code;
      console.log(code);
     //  closeAllWindows();
      window.location="http://ziroute.com/backend/facebookAccountKitSuccess.php?email=<?php echo $_GET['email'] ?>&phonenumber=<?php echo $_GET['phonenumber'] ?>";
      //var csrf = response.state;
      // Send code to server to exchange for access token
    }
    else if (response.status === "NOT_AUTHENTICATED") {
      // handle authentication failure
    }
    else if (response.status === "BAD_PARAMS") {
      // handle bad parameters
    }
  }

  // phone form submission handler
  function smsLogin() {
    var countryCode = document.getElementById("country_code").value;
    var phoneNumber = document.getElementById("phone_number").value;
    AccountKit.login(
      'PHONE', 
      {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
      loginCallback
    );
  }


  // email form submission handler
  function emailLogin() {
    var emailAddress = document.getElementById("email").value;
    AccountKit.login(
      'EMAIL',
      {emailAddress: emailAddress},
      loginCallback
    );
  }
  
  
  document.MyActiveWindows= new Array;

function openWindow(sUrl,sName,sProps){
document.MyActiveWindows.push(window.open(sUrl,sName,sProps))
}

function closeAllWindows(){
for(var i = 0;i < document.MyActiveWindows.length; i++)
document.MyActiveWindows[i].close()
}
</script>

    
    
 </body>

 </html>

