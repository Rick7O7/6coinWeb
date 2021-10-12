<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Login Erfolkreich</title>
</head>

<body>
    <div class="form"><br><br>
        <h1>REGISTER BY 707</h1><br><br>

        <?php
        require("connection.php");
        $false="false";
        $stmt = $conn->prepare("INSERT INTO profil (username, verify, bann, admin, 2fa, email_adress) VALUES (:user, :false, :false, :false, :false, :email)");
        $stmt->bindParam(":user", $_COOKIE["register_username"]);
        $stmt->bindParam(":email", $_COOKIE["register_email"]);
        $stmt->bindParam(":false", $false);
        $stmt->execute();
        //konto
        $randint = rand(10000000000000, 99999999999999);
        $iban_gen = "6C".$randint;
        $pin_gen = rand(1000,9999);
        $stmt1 = $conn->prepare("INSERT INTO konto (konto_owner, iban, pin, user_id, konto_value, date) VALUES (:ko, :iban, :pin, :uid, 0, '10.26')");
        $stmt1->bindParam(":ko", $_COOKIE["full_name"]);
        $stmt1->bindParam(":iban", $iban_gen);
        $stmt1->bindParam(":pin", $pin_gen);
        $stmt1->bindParam(":uid", $_COOKIE["register_username"]);
        $stmt1->execute();
        //roles
        $random = rand(1,1000);
        if($random == 707 ){
            $pink_banana = true;
        }else{
            $pink_banana = false;
        }
        $stmt2 = $conn->prepare("INSERT INTO roles (username, admin, pro, verified, supporter, pink_banana, beta_mem, partner, 10k, 100k) VALUES (:us, 0, 0, 0 , 0, :pib, 1, 0, 0, 0)");
        $stmt2->bindParam(":pib", $pink_banana);
        $stmt2->bindParam(":us", $_COOKIE["register_username"]);
        $stmt2->execute();
        header("location: index.php");
        ?>
    </div>
</body>

</html>