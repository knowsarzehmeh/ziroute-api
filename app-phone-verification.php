<html>
<head>
<title>Phone Verification</title>
<!-- HTTPS required. HTTP will give a 403 forbidden response 
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>-->

 
</head>
<body>


<form method="get" action="https://www.accountkit.com/v1.0/basic/dialog/sms_login/">
  <input type="hidden" name="app_id" value="356411135070850">
  <input type="hidden" name="redirect" value="https://www.token.com">
  <input type="hidden" name="state" value="<?php echo md5(); ?>">
  <input type="hidden" name="fbAppEventsEnabled" value=true>
  <button type="submit">Login</button>
</form>




  
</body>
</html>