<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Facebook Login Test</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script>

window.onload = function(){
    setTimeout(() => {
        document.getElementById("fbLink")
    }, 1000);
}

        </script>

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

    <body style="background:url('bgnice.png'); height: 300px;">


    <script>
    
    
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '356411135070850', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
    
    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //display user data
            getFbUserData();
        }
    });
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
        document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
        document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
        document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';
       // document.getElementById('userData').innerHTML = '<p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '
       // +response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '
       // +response.email+'</p><p><b>Gender:</b> '
      //  +response.gender+'</p><p><b>Locale:</b> '
        //+response.locale+'</p><p><b>Picture:</b> <img src="'+response.picture.data.url+'"/></p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
        
        // Save user data
        saveUserData(response, response.picture.data.url);
    });
}

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="fblogin.png"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
    });
}

// Save user data to the database
function saveUserData(userData, pimg){
    $.post('api.php', {fblogin:'fblogin', oauth_provider:'facebook',userData: JSON.stringify(userData)}, 
    function(datar){ 
        
        //return true;
   // alert(data);
    
    if( datar >0 )
    {
        window.location = "facebookLoginSuccess.php?email="+userData.email
        +"&first_name="+userData.first_name
        +"&last_name="+userData.last_name
        +"&user_id="+datar

        +"&passportImage="+pimg//userData.picture.data.url
 
        ;

    }
    else{
        window.location = "facebookLoginFailed.php";
    }
    
     });
}


</script>



<div style="display:block !important;">

<div class="col-md-12 text-center" style="margin-top:5%;">
<img src="icon2.png" class="img-circle"  style="height:100px; width:100px; border-radius:50px; border:solid 10px #fff;"/>

</div>


<!-- Display login status -->
<div id="status" style="display:none;"></div>

<div class="text-center" >
<br/><br/>
<span style="color:#fff;">
Ziroute.com will Access the following:
<div class="text-left" style="margin-top:5%;">
<ul>
<li>First name, Last name</li>
<li> Email Address</li>
<li>  Profile Picture</li>

 

</ul>

</div>

</span>


<script>
    window.onload = function(){
        
        setTimeout( function()
        {
        
        var fbLink = document.getElementById("fbLink");
        
        fbLink.innerHTML ="Continue to Facebook";
         },
        1000);
        
    } */
</script>

<!-- Facebook login or logout button -->
<!--<a href="javascript:void(0);" onclick="fbLogin()" id="fbLink" style="color:#fff; font-size:25px;">

<img src="https://mybiker.ng/backend/facebook-login-icon-10.jpg" style="height:120px; margin:10%; width:80%;"/>

CLICK TO CONTINUE
</a>
-->

<div class="container" style="margin-top:15%;">
    <a  href="javascript:void(0);"  style="color:#fff !important;" onclick="fbLogin()" id="fbLink"    class="btn btn-lg btn-social btn-facebook">
    <i class="fa fa-facebook fa-fw" ></i> Continue to Facebook
    </a>
</div>


</div>


 

<!-- Display user profile data -->
<div id="userData"></div>
</div>
 


<!--
<img src="https://mybiker.ng/backend/loader.gif" style="height:40px; margin-left:45%; margin-right:45%; margin-top:50%; 
width:40px;"/>

</a>
-->

 




    
    </body>
</html> 