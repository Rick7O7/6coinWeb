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
        <h1>LOGIN BY 707</h1><br><br>
    
    <?php
    require("connection.php");
    $stmt = $conn->prepare("SELECT * FROM profil WHERE username = :username");
    $stmt->bindParam(":username", $_COOKIE["username"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count == 1) {
        $row = $stmt->fetch();
        setcookie("email_address",$row["email_adress"],time() + (86400 * 30),);
        
        if ($row["admin"]==true) {
            setcookie("userrole_admin", true, time() + (86400 * 30),);
            header("location: index.php");
        } else {
            setcookie("userrole_admin", false, time() + (86400 * 30));
            header("location: index.php");
        }

    } else {
        ?>
       <div style="color:#fa5651;"><p> Möglicher Weise sind die Auth-Server grade OFFLINE. Bitte versuche es später noch einmal</p></div>
        <?php
    }
    ?>
    </div>
</body>

</html>