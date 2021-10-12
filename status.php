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
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="status.php">Status
                            <span class="visually-hidden">(current)</span>
                        </a>
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
                                <a class="nav-link" href="#"><?php if (isset($_COOKIE["login"])) {
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
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">SERVER</th>
      <th scope="col">Status</th>
      <th scope="col">Funktionen</th>
      <th scope="col">Fehler</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-info">
      <th scope="row">WebServer</th>
      <td>ONLINE</td>
      <td>Login/Register</td>
      <td>Funktionel in BETA</td>
    </tr><br>
    <tr class="table-success">
      <th scope="row">SocialMedia (707.ink)</th>
      <td>ONLINE</td>
      <td>Alle Möglich</td>
      <td>---</td>
    </tr>
    <tr class="table-success">
      <th scope="row">VServer</th>
      <td>ONLINE</td>
      <td>Alle Möglich</td>
      <td>---</td>
    </tr>
    <tr class="table-success">
      <th scope="row">Online Shop</th>
      <td>ONLINE</td>
      <td>Alle Möglich</td>
      <td>---</td>
    </tr>
    <tr class="table-danger">
      <th scope="row">Discord Bot</th>
      <td>OFFLINE</td>
      <td>---</td>
      <td>---</td>
    </tr>
  </tbody>
</table>
</body>

</html>