<?php
require("connection.php");
$stmt = $conn->prepare("SELECT * FROM roles WHERE username = :username");
$stmt->bindParam(":username", $_COOKIE["username"]);
$stmt->execute();
$row = $stmt->fetch();
$count = $stmt->rowCount();
if ($count == 1) {

    if($row["admin"]==1){
        $permission = "lvl3";
        setcookie("permission", "lvl3", time() + (86400 * 30));
    }else{
        if($row["developer"]==1){
            $permission = "lvl2";
            setcookie("permission", "lvl2", time() + (86400 * 30));
        }else{
            if($row["supporter"]==1){
                $permission = "lvl1";
                setcookie("permission", "lvl1", time() + (86400 * 30));
                header("location: adminmainpage.php");
            }else{
                $permission = "lvl0";
            }
        }
    }
}else{
    $permission = "lvl0";
}

if($permission == "lvl0"){
    header("location: index.php");
}

if(isset($_POST["submit"])){

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap_admin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>707 - Main</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Administration</font></font></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Navigation umschalten">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Databases
                            </font></font><span class="visually-hidden"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(aktuell)</font></font></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_users.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Users</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Role</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Shop</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6coin</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Konten</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_quest.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Belohnungen</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Banns</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Status</font></font></a>
                </li>

        </div>
    </div>
</nav>
<h1>
    Databases
</h1>
<br>
<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>SERVER</th><th>STATE</th><th>FUNCTION</th><th>ERRORS</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}
require ("connection.php");
$stmt = $conn->prepare("SELECT * FROM status");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
}
$conn = null;
echo "</table>";
?>
<br>
<form action="dbedit.php" method="get" style="margin: 20px">
    <div class="form-group" style="width: 300px; display: flex">
        <fieldset>
            <label class="form-label" for="disabledInput">SERVER TO EDIT</label>
            <input class="form-control" id="disabledInput" type="text" name="set_server" placeholder="SERVER">
            <br>
            <label class="form-label" for="disabledInput">COLUMN TO EDIT</label>
            <input class="form-control" id="disabledInput" type="text" name="set_column" placeholder="COLUMN">
            <br>
            <label class="form-label" for="disabledInput">INPUT TO USE</label>
            <input class="form-control" id="disabledInput" type="text" name="set_input" placeholder="INPUT">
            <br>
            <button type="submit" name="state_update" class="btn btn-dark">UPDATE</button>
        </fieldset>
    </div>
    <p> state = server_status, function = server_funktion, error = server_err, </p>
</form>
</body>
</html>