<html lang="en">
  <head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="901919531001-ev7m2cbetf04k8kjc07jnqudl51j1gjb.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    
    
  </head>
  <body>
    <div class="g-signin2" id="sbtn" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());
        
        document.getElementById("fullname").innerHTML=profile.getName();
        document.getElementById("givenname").innerHTML=profile.getGivenName();
        document.getElementById("familyname").innerHTML=profile.getFamilyName();
        document.getElementById("imageurl").src=profile.getImageUrl();
        document.getElementById("emailaddress").innerHTML=profile.getEmail();


        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }
    </script>
    
    <div>
        
        <p id="fullname"></p>
        <p id="givenname"></p>
        <p id="familyname"></p>
        <img id="imageurl"></p>
        <p id="emailaddress"></p>

    </div>
  </body>
</html>