<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" 
    integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account erstellen</title>
</head>

<body>
    <?php
    
    if (isset($_POST["submit"])) {

        require("connection.php");
        $stmt = $conn->prepare("SELECT * FROM data WHERE username = :username");
        $stmt->bindParam(":username", $_POST["username"]);
        $stmt->execute();
        $count = $stmt -> rowCount();
        if($count == 0){
            if($_POST["password2"] == $_POST["password"]){
                $stmt = $conn->prepare("INSERT INTO data (username, password) VALUES (:user, :pw)");
                $stmt->bindParam(":user", $_POST["username"]);

                $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                $hashoutsalt = substr($hash, strlen("$2y$10$"));

                $stmt->bindParam(":pw", $hashoutsalt);
                $usn_err = false;
                $psw_err = false;
                $stmt->execute();
                setcookie("register_email", $_POST["email"], time() + (86400 * 30),);
                setcookie("register_username", $_POST["username"], time() + (86400 * 30),);
                setcookie("register_full_name", $_POST["full_name"], time() + (86400 * 30),);
                header("location: register_byprofil.php");
            }else{
                $psw_err = true;
            }
        }else{
            $usn_err = true;
        }
    }

    ?>
    <form action="register.php" method="post">
        <div class="form">
            <br>
            <h4>Register by 707</h4>
            <br>
            <div class="form-floating mb-3">

                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email Addresse</label>


            </div>
            <div class="form-floating mb-3">

                <input type="username" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Username</label>

            </div>
            <div class="form-floating mb-3">

                <input type="username" name="full_name" class="form-control" id="floatingInput" placeholder="Max Musterman" required>
                <label for="floatingInput">full name (for konto)</label>

            </div>
            <div class="form-floating mb-3">

                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>

            </div>
            <div class="form-floating">

                <input type="password" name="password2" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password wiederholen</label>

            </div>
            <br>
            <button name="submit" class="btn btn-lg btn-primary" type="submit">Account erstellen</button>
        </div>
        </div>
    </form>
</body>

</html>