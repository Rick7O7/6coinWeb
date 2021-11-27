<?php
session_start();


if (isset($_SESSON["username"])) {
    $login = true;
    $username = $_SESSON["username"];
} else {
    $username = "Login";
    $login = false;
}


if(isset($_POST["spin"])){
    $value = $_POST["einsatz_input"];
    $value = (int)$value;
    if($value>0){
        require("connection.php");
        $stmt8 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
        $stmt8->bindParam(":user", $_COOKIE["username"]);
        $stmt8->execute();
        $row8 = $stmt8->fetch();
        if($row8["konto_value"]>$value){

            $ra1 = rand(1,2);
            $ra2 = rand(1,2);
            $ra3 = rand(1,2);
            $ra4 = rand(1,2);
            $ra5 = rand(1,2);

            $end = $ra1." ".$ra2." ".$ra3." ".$ra4." ".$ra5;

            if($ra1==$ra2&&$ra1==$ra3&&$ra1==$ra4&&$ra1==$ra5){
                $win = true;
                $kv = (int)$row8["konto_value"];
                $value = $value * 10;
                $value = $value + $kv;
                $value = strval($value);
                $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
                $stmt->bindParam(":user", $_COOKIE["username"]);
                $stmt->bindParam(":kv", $value);
                $stmt->execute();
                setcookie("my_wallet", $row8["konto_value"], time() + (86400));
            }else{
                $win = false;
                $kv = (int)$row8["konto_value"];
                $value = $kv - $value;
                $value = strval($value);
                $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
                $stmt->bindParam(":user", $_COOKIE["username"]);
                $stmt->bindParam(":kv", $value);
                $stmt->execute();
                setcookie("my_wallet", $row8["konto_value"], time() + (86400));
            }
        }else{
            echo "nicht genug geld auf dem konto";
        }
    }else{
        echo "Du kannst keinen negativen Einsatz geben";
    }

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>707 - Main</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">707</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="status.php">Status</a>
                </li>
                <?php
                if (isset($_COOKIE["login"])) {
                if ($_COOKIE["login"] == false) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    <?php
                    }
                    }else{
                    ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    <?php
                    }
                    ?>


                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php"><?php if (isset($_COOKIE["login"])) {
                            if ($_COOKIE["login"] == true) {
                                echo $_COOKIE["username"];
                            } else {
                                echo "Login";
                            }
                        }

                        ?></a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div style="margin: 20px; margin-top: 200px; " class="card border-primary mb-3">
    <div class="card-body">
        <h4 class="card-title">Casino</h4>
        <p>Kontostand: <?php echo $_COOKIE["my_wallet"]?>$</p>
        <div  style="padding: 10px; width: 250px; background-color: #1a2b3d; border-radius: 5px; border: #0b2e13 solid 5px;<?php if($win==true){ echo "border-color: #00f700";} ?>">
            <h1> <?php if(isset($_POST["spin"])){ echo $end; } ?></h1>
        </div>
        <form method="post" action="casino.php">
               <input value="50" name="einsatz_input" class="form-control me-sm-2" type="text" placeholder="Einsatz">
        <button name="spin" class="btn btn-secondary my-2 my-sm-0" type="submit">Drehen</button>
        </div>
</div>
</body>

</html>