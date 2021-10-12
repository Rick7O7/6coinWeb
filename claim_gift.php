<?php
if(isset($_GET["code"])){
    $get_function = true;
}
if(isset($_POST["sxc_submit"])){
    $post_function = true;
}

//---------------------------------post function------------------------------------------
if($post_function == true){
    $code = $_POST["sxc_input"];
    $to_iban = $_COOKIE["IBAN"];

    require("connection.php");
    $stmt = $conn->prepare("SELECT * FROM gift WHERE code = :code");
    $stmt->bindParam(":code", $code);
    $stmt->execute();
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if($count == 1){
        $code_value = $row["value"];
        $stmt1 = $conn->prepare("SELECT * FROM konto WHERE iban = :iban");
        $stmt1->bindParam(":iban", $to_iban);
        $stmt1->execute();
        $row1 = $stmt1->fetch();
        $count = $stmt->rowCount();
        if($count == 1){
            $gen_konto_value = $row1["value"] + $code_value;

            $stmt3 = $conn->prepare("UPDATE konto SET value=:value WHERE iban = :iban");
            $stmt3->bindParam(":value", $gen_konto_value);
            $stmt3->bindParam(":iban", $iban);
            $stmt3->execute();
            echo "ok";
        }else{

            $err = true;
        }
    }else{
        $err=true;
    }

}