<?php
//konto
require("connection.php");
$randint = rand(10000000000000, 99999999999999);
$iban_gen = "6C".$randint;
$pin_gen = rand(1000,9999);

$stmt1 = $conn->prepare("INSERT INTO konto (konto_owner, iban, pin, user_id, konto_value, date) VALUES (:ko, :iban, :pin, :uid, 0, '10.26')");
$stmt1->bindParam(":ko", $_COOKIE["register_full_name"]);
$stmt1->bindParam(":iban", $iban_gen);
$stmt1->bindParam(":pin", $pin_gen);
$stmt1->bindParam(":uid", $_COOKIE["register_username"]);
$stmt1->execute();
//roles

$random = rand(1,1000);
if($random == 707 ){
    $pink_banana = 1;
}else{
    $pink_banana = 0;
}
$stmt2 = $conn->prepare("INSERT INTO roles (username, admin, supporter, developer, partner, verified, pink_banana, beta_mem, pro, root, verkäufer, 10k, 100k) VALUES (:us, 0, 0, 0 , 0, 0, :pib, 1, 0, 0, 0, 0, 0)");
$stmt2->bindParam(":pib", $pink_banana);
$stmt2->bindParam(":us", $_COOKIE["register_username"]);
$stmt2->execute();
header("location: index.php");
