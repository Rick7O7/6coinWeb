<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Login by 707</title>
</head>
<?php
error_reporting(E_ERROR | E_PARSE);
$err = false;
if (isset($_POST["submit"])) {
    require("connection.php");
    $stmt = $conn->prepare("SELECT * FROM data WHERE username = :username");
    $stmt->bindParam(":username", $_POST["email"]);
    $stmt->execute();x
    $count = $stmt->rowCount();
    if ($count == 1) {
        $row = $stmt->fetch();
        $pw = "$2y$10$" . $row["password"];
        if (password_verify($_POST["password"], $pw)) {
            setcookie("username", $_POST["email"], time() + (86400 * 30),);
            setcookie("login", true, time() + (86400 * 30),);
            $is_username = true;
            header("Location: sec_login.php");
        } else {
            $err = true;
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM profil WHERE email_adress = :email");
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $row = $stmt->fetch();
        $username = $row["username"];

        $stmt1 = $conn->prepare("SELECT * FROM data WHERE username = :username");
        $stmt1->bindParam(":username", $username);
        $stmt1->execute();
        $row1 = $stmt1->fetch();
        if ($row["email_adress"] == $_POST["email"]) {
            $pw = "$2y$10$" . $row1["password"];
            if (password_verify($_POST["password"], $pw)) {
                $is_email = true;
                if (!isset($_COOKIE["my_wallet"])) {
                    $stmt4 = $conn->prepare("SELECT * FROM profil WHERE username = :user");
                    $stmt4->bindParam(":user", $_COOKIE["username"]);
                    $stmt4->execute();
                    $row4 = $stmt4->fetch();
                    setcookie("my_wallet", $row4["wallet"], time() + (86400 * 30),);
                }
                setcookie("username", $row1["username"], time() + (86400 * 30),);
                setcookie("email_address", $row1["email_adress"], time() + (86400 * 30),);
                setcookie("login", true, time() + (86400 * 30),);

                header("Location: sec_login.php");
            }
        } else {
        }
    }
}
?>

<body>
    <form action="login.php" method="post">
        <div class="form">
            <br>
            <h4>Login by 707</h4>
            <br>
            <?php
            if ($err == true) {
                echo '<p>Username / Password ist falsch</p>';
            } else {
            }

            ?>

            <div class="form-floating mb-3">

                <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Username/Email</label>


            </div>
            <div class="form-floating mb-3">

                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Password</label>

            </div>
            <br>
            <button name="submit" class="btn btn-lg btn-primary" type="submit">Anmelden</button>
        </div>
        </div>
    </form>
</body>

</html>