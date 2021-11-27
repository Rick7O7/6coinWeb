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
    if($_POST["db_name"]=="profil"){
        $profil=true;
        $stmt = $conn->prepare("SELECT * FROM profil WHERE username = :username");
        $stmt->bindParam(":username", $_POST["db_ur_id"]);
        $stmt->execute();
        $row = $stmt->fetch();
        setcookie("username_admin_input", $row["username"], time() + (86400 * 30));
        $i1= $row["username"];
        $i2= $row["email_adress"];
        $i3= $row["verify"];
        $i4= $row["bann"];
        $i5= $row["admin"];
        $i6= $row["2fa"];
        $i7= "";
        $i8= "";
        $i9= "";
        $i10= "";
        $i11= "";
        $i12= "";
        $i13= "";

    }elseif($_POST["db_name"]=="data"){
        $data=true;
        $stmt1 = $conn->prepare("SELECT * FROM data WHERE username = :username");
        $stmt1->bindParam(":username", $_POST["db_ur_id"]);
        $stmt1->execute();
        $row1 = $stmt1->fetch();
        setcookie("username_admin_input", $row1["username"], time() + (86400 * 30));
        $i1= $row1["username"];
        $i2= $row1["password"];
        $i3= "";
        $i4= "";
        $i5= "";
        $i6= "";
        $i7= "";
        $i8= "";
        $i9= "";
        $i10= "";
        $i11= "";
        $i12= "";
        $i13= "";
    }elseif($_POST["db_name"]=="roles"){
        $roles=true;
        $stmt2 = $conn->prepare("SELECT * FROM roles WHERE username = :username");
        $stmt2->bindParam(":username", $_POST["db_ur_id"]);
        $stmt2->execute();
        $row2 = $stmt2->fetch();
        setcookie("username_admin_input", $row2["username"], time() + (86400 * 30));
        $i1= $row2["username"];
        $i2= $row2["admin"];
        $i3= $row2["supporter"];
        $i4= $row2["developer"];
        $i5= $row2["pro"];
        $i6= $row2["beta_mem"];
        $i7= $row2["pink_banana"];
        $i8= $row2["10k"];
        $i9= $row2["100k"];
        $i10= $row2["verified"];
        $i11= $row2["partner"];
        $i12= $row2["root"];
        $i13= $row2["verkäufer"];
    }elseif($_POST["db_name"]=="konto"){
        $konto=true;
        $stmt3 = $conn->prepare("SELECT * FROM konto WHERE user_id = :username");
        $stmt3->bindParam(":username", $_POST["db_ur_id"]);
        $stmt3->execute();
        $row3 = $stmt3->fetch();
        setcookie("username_admin_input", $row3["user_id"], time() + (86400 * 30));
        $i1= $row3["user_id"];
        $i2= $row3["konto_owner"];
        $i3= $row3["iban"];
        $i4= $row3["konto_value"]."$";
        $i5= $row3["date"];
        $i6= $row3["pin"];
        $i7= "";
        $i8= "";
        $i9= "";
        $i10= "";
        $i11= "";
        $i12= "";
        $i13= "";
    }elseif($_POST["db_name"]=="gift"){
        $gift=true;
        $stmt4 = $conn->prepare("SELECT * FROM gift WHERE from_user = :username");
        $stmt4->bindParam(":username", $_POST["db_ur_id"]);
        $stmt4->execute();
        $row4 = $stmt4->fetch();
        setcookie("username_admin_input", $row4["from_user"], time() + (86400 * 30));
        $i1= $row4["value"];
        $i2= $row4["code"];
        $i3= $row4["from_user"];
        $i4= $row4["iban"];
        $i5= $row4["link"];
        $i6= "";
        $i7= "";
        $i8= "";
        $i9= "";
        $i10= "";
        $i11= "";
        $i12= "";
        $i13= "";
    }
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
                    <a class="nav-link active" href="adminmainpage.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Databases
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
                    <a class="nav-link" href="admin_sxc.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6coin</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_acc.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Konten</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_quest.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Belohnungen</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Banns</font></font></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_status.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Status</font></font></a>
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
echo "<tr><th>Username</th><th>Finished</th><th>toGet</th></tr>";

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
    $stmt = $conn->prepare("SELECT * FROM quest");
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
        <label class="form-label" for="disabledInput">Username</label>
        <input class="form-control" id="disabledInput" type="text" name="set_input" placeholder="Username">
        <button type="submit" name="quest_agree" class="btn btn-dark">Agree</button>
        <button type="submit" name="quest_delete" class="btn btn-danger">Delete</button>
    </fieldset>
</div>
</form>
</body>
</html>