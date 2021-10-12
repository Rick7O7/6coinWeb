<?php
session_start();
if (isset($_SESSON["username"])) {
    $login = true;
    $username = $_SESSON["username"];
} else {
    $username = "Login";
    $login = false;
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

    <div class="card border-warning mb-3" style=" margin: 20px; max-width: 20rem;">
        <div class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Shop Powered by 707</font></font></div>
        <div class="card-body">
            <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">707 Pro</font></font></h4>
            <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hole dir jetzt das 707 Pro Packet, damit du mehr Sicherheit bei dei deinem 6coin Konto hast und unendlich Guthaben Links verschenken kannst, und vieles mehr...</font></font></p>
           <!-- <label style="margin-left: 80px"> du hast: <strong><?php echo $_COOKIE["my_wallet"];?></strong> $</label> -->
        </div>
        <button type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">16.00 $ /M</font></font></button>
    </div>

    <div class="card border-success mb-3" style=" margin: 20px; max-width: 20rem;">
        <div class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Shop Powered by 707 // by Toolbox</font></font></div>
        <div class="card-body">
            <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Eine Pro Webseite</font></font></h4>
            <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lass jetzt deine Webseite von hoch profissionellen Programmirern gestallten mit hoch mordernen JavScript Code und Node.js Backend, damit deine Webseit schnell und gut antwortet</font></font></p>
            <!-- <label style="margin-left: 80px"> du hast: <strong><?php echo $_COOKIE["my_wallet"];?></strong> $</label> -->
        </div>
        <button type="button" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">100.00 $</font></font></button>
    </div>

<div class="card border-warning mb-3" style=" margin: 20px; max-width: 20rem;">
    <div class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Shop Powered by 707</font></font></div>
    <div class="card-body">
        <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Jabsy Cristall</font></font></h4>
        <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Jabsy Cristall ist dafür gut, dass du profissionell deine Comunity aufbauen kannst und mit besserer Quallität mit deinen Freunden reden und du hast die Möglichkeit mehr Server zu ersellen mit mehr Speicherplatz</font></font></p>
        <!-- <label style="margin-left: 80px"> du hast: <strong><?php echo $_COOKIE["my_wallet"];?></strong> $</label> -->
    </div>
    <button type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.00 $ /M</font></font></button>
</div>
<button style="margin: 30px;" type="button" class="btn btn-secondary"><font style=" vertical-align: inherit;"><font style="vertical-align: inherit;">Verkauf dein Produkt bei uns</font></font></button>

</body>

</html>
