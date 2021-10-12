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
        <h1>8Rypt Sytems BY 707</h1><br><br>
    
    <?php
    require("connection.php");


    $stmt = $conn->prepare("SELECT * FROM admin_code WHERE admin_code = :code");
    $stmt->bindParam(":code", $_COOKIE["admin_code"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count == 1) {
        $row = $stmt->fetch();
       if($row["use"]=='false'){
           
            $stmt1 = $conn->prepare("UPDATE profil SET admin=true WHERE username = :user");
            $stmt1->bindParam(":user", $_COOKIE["username"]);
            $stmt1->execute();
           header("location: index.php");
       }

    } else {
        header("location: index.php");
    }
    $stmt4 = $conn->prepare("SELECT * FROM sxc_token WHERE token = :token");
    $stmt4->bindParam(":token", $_COOKIE["sxc_token"]);
    $stmt4->execute(); 
    $count = $stmt4->rowCount();
    if ($count == 1) {
        $row4 = $stmt4->fetch();
        $wert = $row4["value"];

        $stmt2 = $conn->prepare("UPDATE profil SET wallet = :my_wallet WHERE username = :user");
        $stmt2->bindParam(":user", $_COOKIE["username"]);
        $stmt2->bindParam(":my_wallet", $wert);
        setcookie("my_wallet", $row4["value"], time() + (86400 * 30),);
        $stmt2->execute();
        header("location: index.php");
    }else{
        header("location: index.php");
    }
    ?>
    </div>
</body>

</html>