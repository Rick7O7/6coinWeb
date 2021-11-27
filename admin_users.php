<?php
require("connection.php");

$stmt1 = $conn->prepare("SELECT * FROM admin WHERE user_id = :username");
$stmt1->bindParam(":username", $_COOKIE["username"]);
$stmt1->execute();
$row1 = $stmt1->fetch();
$perm_code = $row1["perm_code"];

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
    if($_POST["username_input"]=="rick"){
        header();
    }elseif ($_POST["username_input"]=="root"){

    }else{
        require ("connection.php");
        $stmt = $conn->prepare("SELECT * FROM konto WHERE user_id = :username");
        $stmt->bindParam(":username", $_POST["username_input"]);
        $stmt->execute();
        $row = $stmt->fetch();

        $stmt1 = $conn->prepare("SELECT * FROM roles WHERE username = :username");
        $stmt1->bindParam(":username", $_POST["username_input"]);
        $stmt1->execute();
        $row1 = $stmt1->fetch();

        $stmt2 = $conn->prepare("SELECT * FROM profil WHERE username = :username");
        $stmt2->bindParam(":username", $_POST["username_input"]);
        $stmt2->execute();
        $row2 = $stmt2->fetch();

        if($row1["admin"]==1){
            $team="Level 3";
        }else{
            if ($row1["developer"]==1){
                $team="Level 2";
            }else{
                if($row1["supporter"]==1){
                    $team = "Level 1";
                }else{
                    $team = "Level 0";
                }
            }
        }
        setcookie("username_admin_input", $row["user_id"], time() + (86400 * 30));
        $i1= $row["user_id"];
        $i2= $row["iban"];
        $i3= $row["konto_owner"];
        $i4= $row["konto_value"];
        $i5= $row["pin"];
        $i6= $team;
        $i7= $row1["verified"];
        $i8= $row1["pro"];
        $i9= $row2["email_adress"];
        $i10= $row2["bann"];
        $i11= $row["date"];
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
                    <a class="nav-link" href="adminmainpage.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Databases
                            </font></font><span class="visually-hidden"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(aktuell)</font></font></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_users.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Users</font></font></a>
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
    Users
</h1>

<div style="display: flex">
    <div style="margin-left:20px; background-color: #1a2b3d; padding: 10px; border-radius: 5px; width: 300px; height: 200px;" class="form-group">
        <form method="post" action="admin_users.php">
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">Username / Benutzer-ID</label>

            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" name="username_input" id="staticEmail" value="">
            </div>
        </div>
            <br>
        <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
        </div>
    </form>
    </div>
<div style="margin-left:550px; background-color: #1a2b3d; padding: 10px; border-radius: 5px; width: 300px; height: 400px;" class="form-group">
    <h2>Login by Admin Server</h2>
    <label for="exampleInputEmail1" class="form-label mt-4">Admin Server Adresse</label>
    <div class="col-sm-10">
        <input type="text" class="form-control-plaintext" name="username_input" id="staticEmail" value="admin707@6coin.de">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1" class="form-label mt-4">Your Permission Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control-plaintext" name="perm_code" id="staticEmail" value="<?php echo $perm_code ?>">
        </div>
        <br>
    </div>
    <div class="col-sm-10">
        <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
    </div>
</div>
</div>


<br>
<br>
<br>
<?php
if(isset($_POST["submit"])){
        $u1="Username";
        $u2="IBAN";
        $u3="Konto Besitzer";
        $u4="Kontostand";
        $u5="PIN";
        $u6="Team Level";
        $u7="Verifiziert";
        $u8="Pro";
        $u9="Email Adresse";
        $u10="Gebannt";
        $u11="Konto Ablaufdatum";
        $u12="";
        $u13="";
        //button RED
        if($_COOKIE["permission"]=="lvl3"){

            $rb1 = "Bannen";
            $rb2 = "Remove AccValue";
            $rb3 = "Remove Roles";
            $rb4 = "Remove Role (INPUT)";
            $rb5 = "Remove AccValue (INPUT)";
            $rb6 = "Report to ROOT";
            //button GREEN
            $gb1 = "Remove Bann";
            $gb2 = "Add Role (INPUT)";
            $gb3 = "Add AccValue (INPUT)";
            $gb4 = "SET Username (INPUT)";
            $gb5 = "SET Email (INPUT)";
            $gb6 = "SET Enddate (INPUT)";

            //name for form
            $rbn1 = "user_bann";
            $rbn2 = "user_rem-kv";
            $rbn3 = "user_rem-roles";
            $rbn4 = "user_rem-rolesInput";
            $rbn5 = "user_rem-accvalueInput";
            $rbn6 = "user_rep-root";

            $gbn1 = "user_rem-bann";
            $gbn2 = "user_add-roleInput";
            $gbn3 = "user_add-accvalueInput";
            $gbn4 = "user_set-username";
            $gbn5 = "user_set-email";
            $gbn6 = "user_set-kd";
        }elseif ($_COOKIE["permission"]=="lvl2"){
            $rb1 = "Bannen";
            $rb2 = "--Remove AccValue--";
            $rb3 = "Remove Roles";
            $rb4 = "Remove Role (INPUT)";
            $rb5 = "--Remove AccValue (INPUT)--";
            $rb6 = "Report to ROOT";
            //button GREEN
            $gb1 = "Remove Bann";
            $gb2 = "Add Role (INPUT)";
            $gb3 = "--Add AccValue (INPUT)--";
            $gb4 = "SET Username (INPUT)";
            $gb5 = "SET Email (INPUT)";
            $gb6 = "SET Enddate (INPUT)";

            //name for form
            $rbn1 = "user_bann";
            $rbn2 = "";
            $rbn3 = "user_rem-roles";
            $rbn4 = "user_rem-rolesInput";
            $rbn5 = "";
            $rbn6 = "user_rep-root";

            $gbn1 = "user_rem-bann";
            $gbn2 = "user_add-roleInput";
            $gbn3 = "";
            $gbn4 = "user_set-username";
            $gbn5 = "user_set-email";
            $gbn6 = "user_set-kd";
        }else{
            $rb1 = "-no permissions-";
            $rb2 = "-no permissions-";
            $rb3 = "-no permissions-";
            $rb4 = "-no permissions-";
            $rb5 = "-no permissions-";
            $rb6 = "Report to ROOT";
            //button GREEN
            $gb1 = "-no permissions-";
            $gb2 = "-no permissions-";
            $gb3 = "-no permissions-";
            $gb4 = "-no permissions-";
            $gb5 = "-no permissions-";
            $gb6 = "SET Enddate (INPUT)";

            //name for form
            $rbn1 = "";
            $rbn2 = "";
            $rbn3 = "";
            $rbn4 = "";
            $rbn5 = "";
            $rbn6 = "user_rep-root";

            $gbn1 = "";
            $gbn2 = "";
            $gbn3 = "";
            $gbn4 = "";
            $gbn5 = "";
            $gbn6 = "user_set-kd";
        }


    $html='
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u1.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u2.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u3.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u4.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u5.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u6.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u7.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u8.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u9.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u10.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u11.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u12.'</font></font></th>
        <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$u13.'</font></font></th>
    </tr>
    </thead>
    <tbody>
    <tr class="table-active">
        <th scope="row"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i1.'</font></font></th>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i2.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i3.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i4.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i5.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i6.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i7.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i8.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i9.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i10.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i11.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i12.'</font></font></td>
        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$i13.'</font></font></td>
    </tr>
    </tbody>
    </table>
    <div style="max-width: 100%; align-content: center" class="butn">
    <form action="dbedit.php" method="get" style="padding: 10px;">
    <input type="text" class="form-control-plaintext" name="set_input" id="staticEmail" value="">
    <br>
    <button type="submit" name="'.$rbn1.'" class="btn btn-danger"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb1.'</font></font></button>
    <button type="submit" name="'.$rbn2.'" class="btn btn-danger"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb2.'</font></font></button>
    <button type="submit" name="'.$rbn3.'" class="btn btn-danger"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb3.'</font></font></button>
    <button type="submit" name="'.$rbn4.'" class="btn btn-danger"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb4.'</font></font></button>
    <button type="submit" name="'.$rbn5.'" class="btn btn-danger"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb5.'</font></font></button>
    <button type="submit" name="'.$rbn6.'" class="btn btn-danger"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb6.'</font></font></button>
    <br>
    <br>
    <button type="submit" name="'.$gbn1.'" class="btn btn-success"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb1.'</font></font></button>
    <button type="submit" name="'.$gbn2.'" class="btn btn-success"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb2.'</font></font></button>
    <button type="submit" name="'.$gbn3.'" class="btn btn-success"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb3.'</font></font></button>    
    <button type="submit" name="'.$gbn4.'" class="btn btn-success"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb4.'</font></font></button>
    <button type="submit" name="'.$gbn5.'" class="btn btn-success"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb5.'</font></font></button>
    <button type="submit" name="'.$gbn6.'" class="btn btn-success"><font style="margin: 10px; vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb6.'</font></font></button>
    </form>
    </div>
';
    echo $html;
}
?>

</body>
</html>