<?php

setcookie("username", "", time() +1,);
setcookie("login", "", time() +1,);
setcookie("email_address", "", time() +1,);
setcookie("userrole_admin", "", time() +1,);
setcookie("my_wallet", "", time() + (+1),);
setcookie("IBAN", "", time() + (+1),);
setcookie("date", "", time() + (+1),);
setcookie("konto_owner", "", time() + (+1),);
setcookie("pin", "", time() + (+1),);
header("location: login.php")
?>