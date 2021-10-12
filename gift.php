<?php
$iban = $_POST["input_iban"];
$gift = $_POST["value"];

if (!isset($_COOKIE["IBAN"])) {
    require("connection.php");
    $stmt1 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt1->bindParam(":user", $_COOKIE["username"]);
    $stmt1->execute();
    $row1 = $stmt1->fetch();
    setcookie("date", $row1["iban"], time() + (86400),);
}
if (!isset($_COOKIE["my_wallet"])) {
    require("connection.php");
    $stmt = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt->bindParam(":user", $_COOKIE["username"]);
    $stmt->execute();
    $row = $stmt->fetch();
    $konto_value_str = strval($row["konto_value"]);
    setcookie("my_wallet", $konto_value_str, time() + (86400),);
}

require("connection.php");
$stmt = $conn->prepare("SELECT * FROM roles WHERE username = :user");
$stmt->bindParam(":user", $_COOKIE["username"]);
$stmt->execute();
$row = $stmt->fetch();
$pro = $row["pro"];
setcookie("pro", $pro, time() + (86400),);

//make string to int

$konto_v_int = (int)$_COOKIE["my_wallet"];
$gift_int = (int)$gift;

//genug geld
if($gift_int <= $konto_v_int){

    //gen code
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code_gen = '';
    $n = 20;
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $code_gen .= $characters[$index];
    }
    require "connection.php";
    $stmt = $conn->prepare("SELECT * FROM gift WHERE code = :code");
    $stmt->bindParam(":code", $code_gen);
    $stmt->execute();
    $count = $stmt -> rowCount();
    if($count > 0){
        $err = 1;
        echo "versuche es bitte erneut!";
    }else{
        require "connection.php";
        $stmt = $conn->prepare("SELECT * FROM konto WHERE iban = :iban");
        $stmt->bindParam(":iban", $iban);
        $stmt->execute();
        $count = $stmt -> rowCount();
        if($count == 0){
            $err=2;
            header("location: gift.html");
        }else{

            $link = "https://6coin.de/claim_gift.php?code=$code_gen";
            $new_konto_v = $konto_v_int - $gift_int;
            if ($pro == 0){
                if($gift_int > 4){
                    if ($gift_int > 10000){
                        $err = 3;
                    }else{
                        $stmt3 = $conn->prepare("UPDATE konto SET konto_value=:new_konto_v WHERE iban = :iban");
                        $stmt3->bindParam(":iban", $_COOKIE["IBAN"]);
                        $stmt3->bindParam(":new_konto_v",$new_konto_v);
                        $stmt3->execute();

                        $stmt2 = $conn->prepare("INSERT INTO gift (value, from_user, iban, code, link) VALUES (:value, :user, :iban, :code, :link)");
                        $stmt2->bindParam(":user", $_COOKIE["username"]);
                        $stmt2->bindParam(":value", $gift_int);
                        $stmt2->bindParam(":iban", $iban);
                        $stmt2->bindParam(":code", $code_gen);
                        $stmt2->bindParam(":link", $link);
                        $stmt2->execute();

                        echo "successful";
                        header("location = profil.php");
                    }
                }else{
                    $err = 4;
                }
            }elseif ($pro == 1){
                if($gift_int > 1){
                    if($gift_int > 100000000){
                        $err = 5;
                    }else{
                        $stmt3 = $conn->prepare("UPDATE konto SET konto_value=:new_konto_v WHERE iban = :iban");
                        $stmt3->bindParam(":iban", $_COOKIE["IBAN"]);
                        $stmt3->bindParam(":new_konto_v",$new_konto_v);
                        $stmt3->execute();

                        $stmt2 = $conn->prepare("INSERT INTO gift (value, from_user, iban, code, link) VALUES (:value, :user, :iban, :code, :link)");
                        $stmt2->bindParam(":user", $_COOKIE["username"]);
                        $stmt2->bindParam(":value", $gift_int);
                        $stmt2->bindParam(":iban", $iban);
                        $stmt2->bindParam(":code", $code_gen);
                        $stmt2->bindParam(":link", $link);
                        $stmt2->execute();

                        echo "successful";
                        header("location = profil.php");
                    }
                }else{
                    $err = 6;
                }
            }
        }
    }
}else{
    $err=7;
    echo "du hast nicht genug geld auf deinem guthaben";
}
if (isset($err)){
    echo $err;
}