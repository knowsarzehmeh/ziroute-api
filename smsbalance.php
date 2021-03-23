<?php
$token = 'vSb0HALhlxffWmebSciMLIbDmiqanOG7Av5PmC6APXjNVwhAGdkxB7TiqkuhSfu3lNDS0QEWY27koMcEwRrTQoLtUxzQ6TD52dIz';
$checkbalance = "https://smartsmssolutions.com/api/?checkbalance=1&token=".$token;
$balance = file_get_contents($checkbakance);
echo $balance;
?>