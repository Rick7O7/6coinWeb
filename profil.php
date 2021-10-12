<?php
session_start();
if (isset($_SESSON["username"])) {
    $login = true;
    $username = $_SESSON["username"];
} else {
    $username = "Login";
    $login = false;
}
ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
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
                        <a class="nav-link" href="#">Features</a>
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
                    } else {
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

    <h1 style="margin: 20px;">Profil</h1>
    <form class="main_profil" action="profil.php" method="post">
        <fieldset>
            <legend>Profil</legend>
            <?php
            if (isset($_POST["submit"])) {
                require("connection.php");
                $stmt = $conn->prepare("SELECT * FROM data WHERE username = :username");
                $stmt->bindParam(":username", $_COOKIE["username"]);
                $stmt->execute();
                $count = $stmt->rowCount();
                if ($count == 1) {
                    $stmt = $conn->prepare("UPDATE profil SET username=:new_user WHERE username = :user");
                    $stmt->bindParam(":user", $_COOKIE["username"]);
                    $stmt->bindParam(":new_user", $_POST["username_profil"]);
                    $stmt->execute();

                    $stmt1 = $conn->prepare("UPDATE data SET username=:new_user WHERE username = :user");
                    $stmt1->bindParam(":user", $_COOKIE["username"]);
                    $stmt1->bindParam(":new_user", $_POST["username_profil"]);
                    $stmt1->execute();

                    $stmt2 = $conn->prepare("UPDATE profil SET email_adress=:new_email WHERE username = :user");
                    $stmt2->bindParam(":user", $_COOKIE["username"]);
                    $stmt2->bindParam(":new_email", $_POST["email_profil"]);
                    $stmt2->execute();

                    $stmt3 = $conn->prepare("UPDATE konto SET user_id=:new_user_id WHERE iban = :iban");
                    $stmt3->bindParam(":new_user_id", $_POST["username_profil"]);
                    $stmt3->bindParam(":iban", $iban);
                    $stmt3->execute();
                    header("location: logout.php");

                } else {
                    $usn_err = true;
                }
            }
            if (isset($_POST["submit_acc"])) {
                setcookie("admin_code", $_POST["admin_code"], time() + (86400 * 30),);
                setcookie("sxc_token", $_POST["sxc_input"], time() + (86400 * 30),);
            }
            if (!isset($iban)) {
                require("connection.php");
                $stmt5 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
                $stmt5->bindParam(":user", $_COOKIE["username"]);
                $stmt5->execute();
                $row5 = $stmt5->fetch();
                $iban = $row5["iban"];
                setcookie("IBAN", $row5["iban"], time() + (86400),);
            }
            if (!isset($my_wallet)) {
                require("connection.php");
                $stmt4 = $conn->prepare("SELECT * FROM konto WHERE iban = :iban");
                $stmt4->bindParam(":iban", $iban);
                $stmt4->execute();
                $row4 = $stmt4->fetch();
                $my_wallet = $row4["konto_value"];
                setcookie("my_wallet", $row4["konto_value"], time() + (86400 * 30),);
            }
            if (!isset($konto_owner)) {
                require("connection.php");
                $stmt6 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
                $stmt6->bindParam(":user", $_COOKIE["username"]);
                $stmt6->execute();
                $row6 = $stmt6->fetch();
                $konto_owner = $row6["konto_owner"];
                setcookie("konto_owner", $row6["konto_owner"], time() + (86400),);

            }
            if (!isset($pin)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $pin = $row7["pin"];
                setcookie("pin", $row7["pin"], time() + (86400),);

            }
            if (!isset($date)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $date = $row7["date"];
                setcookie("date", $row7["date"], time() + (86400),);

//role start

            }if (!isset($admin)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $admin = $row7["admin"];
                setcookie("admin", $row7["admin"], time() + (86400),);


            } if (!isset($pro)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $pro = $row7["pro"];
                setcookie("pro", $row7["date"], time() + (86400),);


            } if (!isset($verified)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $verified = $row7["verified"];
                setcookie("verified", $row7["verified"], time() + (86400),);


            } if (!isset($supporter)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $supporter = $row7["supporter"];
                setcookie("supporter", $row7["supporter"], time() + (86400),);


            } if (!isset($pink_banana)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $pink_banana = $row7["pink_banana"];
                setcookie("pink_banana", $row7["pink_banana"], time() + (86400),);


            } if (!isset($beta_mem)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $beta_mem = $row7["beta_mem"];
                setcookie("beta_mem", $row7["beta_mem"], time() + (86400),);


            } if (!isset($partner)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $partner = $row7["partner"];
                setcookie("partner", $row7["partner"], time() + (86400),);


            } if (!isset($ten_k)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $ten_k = $row7["ten_k"];
                setcookie("ten_k", $row7["ten_k"], time() + (86400),);


            } if (!isset($hun_k)) {
                require("connection.php");
                $stmt7 = $conn->prepare("SELECT * FROM roles WHERE username = :user");
                $stmt7->bindParam(":user", $_COOKIE["username"]);
                $stmt7->execute();
                $row7 = $stmt7->fetch();
                $date = $row7["hun_k"];
                setcookie("hun_k", $row7["hun_k"], time() + (86400),);

 //role ende

            }if (!isset($isset_gift)) {
                require("connection.php");
                $stmt8 = $conn->prepare("SELECT * FROM gift WHERE iban = :iban");
                $stmt8->bindParam(":iban", $iban);
                $stmt8->execute();
                $row8 = $stmt8->fetch();
                $count8 = $stmt8->rowCount();
                if(!$count8 = 0){
                    $isset_gift=true;
                    $gift_v = $row8["value"];
                    $gift_code = $row8["code"];
                    $gift_link = $row8["link"];

                }else{
                    $isset_gift=false;

                }

            }
            ?>
            <div class="form-group">
                <div class="top_profil">
                    <label for="exampleInputEmail1" class="form-label mt-4">Profilbild</label><br>
                    <img src="img/profil/user_blue.png" class="pimg" alt="">
                    <label style="font-size:x-large;" for="username_label"><?php echo $_COOKIE["username"]; ?></label> <?php
                    if ($_COOKIE["userrole_admin"] == true) {
                        ?>
                        <img src="img/abzeichen/ab_admin.png" alt="" srcset="" style="width: 30px; hight: 30px; margin-left: 5px; margin-bottom: 10px;">

                        <?php
                    }
                    ?>
                    <br>
                    <br>

                    <span class="badge bg-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Admin</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pro</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Verify</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Supporter</font></font></span>
                    <span class="badge bg-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pink Banana</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Beta Member</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Partner</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10k</font></font></span>
                    <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">100k</font></font></span>



                    <div class="form-group">
                        <input class="form-control" type="file" id="formFile">
                    </div>


                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Username</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" name="username_profil" id="staticEmail" value="<?php echo $_COOKIE["username"]; ?>">
                </div>

                <small id="emailHelp" class="form-text text-muted">Du kannst dein Username alle 30 Tage ändern</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Email addresse</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" name="email_profil" id="staticEmail" value="<?php echo $_COOKIE["email_address"]; ?>">
                </div>

                <small id="emailHelp" class="form-text text-muted">Keiner kann deine E-Mail Addresse sehen</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="psw_profil" class="form-control-plaintext" id="staticEmail" value="">
                </div>

            </div>

            <br>
        </fieldset>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <small id="emailHelp" class="form-text text-muted">Du musst dich nach einer Profil änderung neu Einloggen </small>
        </fieldset>
    </form>

    <br><br>
    <br>

    <form class="left_profil" action="profil.php" method="post">
        <div>
            <legend>Account</legend>
            <div class="form-group">
                <div class="top_profil">
                    <h1 class="amounts"><?php if (isset($my_wallet)) {
                                            echo $my_wallet;
                                        }  ?><span>$</span> </h1>


                </div>
            </div>
            <div class="form-group">
                <fieldset disabled="" data-children-count="1">
                    <label class="form-label" for="disabledInput">IBAN</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php if (isset($iban)) {
                        echo $iban;
                    }  ?>" disabled="">
                </fieldset>
            </div>
            <br>
            <div class="form-group">
                <fieldset disabled="" data-children-count="1">
                    <label class="form-label" for="disabledInput">Konto Besitzer</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php if (isset($konto_owner)) {
                        echo $konto_owner;
                    }else{
                        echo "Err: Nicht Angegeben code=k283";
                    }  ?>" disabled="">
                </fieldset>
            </div>
            <br>
            <div class="form-group">
                <fieldset disabled="" data-children-count="1">
                    <label class="form-label" for="disabledInput">vcc</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php if (isset($pin)) {
                        echo $pin;
                    }else{
                        echo "Err: Nicht Angegeben code=k283";
                    }  ?>" disabled="">
                </fieldset>
            </div>
        </div>

            <div class="form-group">
                <label for="exampleInputEmail2" class="form-label mt-4">SXC Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" name="sxc_input" id="sxc_input" value="">
                </div>

                <small id="emailHelp" class="form-text text-muted">Du kannst hier einen 6coin Code eingeben und ihn überweisen</small>
            </div>


            <br>

        <button type="submit" style="width: 84%;" name="submit_sxc" class="btn btn-primary">Submit</button>

        <br>
        <a href="cart.php/?konto_owner=<?php echo $konto_owner; ?>&iban=<?php echo $iban; ?>&cvv=<?php echo $pin; ?>&date=<?php echo $date; ?>">
        <p style="margin-top: 40px; width: 100%;" name="submit_acc">Karten Vorschau </p></a>

        <br><br>
        <div class="gifts">
            <h3>
                Gifts
            </h3>
            <?php
            if(isset($isset_gift)){
                $html = '<div class="alert alert-dismissible alert-success">
                    <strong><font style="vertical-align: inherit;"><font style="font-size: 25px">'.$gift_v.'<br></font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Du hast noch ein </font></font><a href="#" class="alert-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">' .$gift_v. '$</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Guthaben aufstock </font><font style="vertical-align: inherit;">.
                            <br> dein Code: <strong>' .$gift_code. '</strong>
                        </font></font></div>';
            }
            ?>
            <br>
        </div>
    </form>
    </div>


</body>

</html>