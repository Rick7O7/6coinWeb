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
                    <a class="nav-link active" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Databases
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
<form style="margin-left:20px; background-color: #1a2b3d; padding: 10px; border-radius: 5px; max-width: 25%" method="post" action="adminmainpage.php">
<div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">DB name</label>

    <div class="col-sm-10">
        <input type="text" class="form-control-plaintext" name="db_name" id="staticEmail" value="roles">
    </div>
</div>
<div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">user id / row id</label>
    <div class="col-sm-10">
        <input type="text" class="form-control-plaintext" name="db_ur_id" id="staticEmail" value="">
    </div>
    <br>
</div>
    <div class="col-sm-10">
        <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
    </div>
</div>
</div>
</form>
<br>
<br>
<br>
<?php
if(isset($_POST["submit"])){
    if(isset($profil)){
        $u1="Username";
        $u2="Email-Adresse";
        $u3="Verified";
        $u4="Banned";
        $u5="Admin";
        $u6="2FA";
        $u7="";
        $u8="";
        $u9="";
        $u10="";
        $u11="";
        $u12="";
        $u13="";
        //button RED
        $rb1 = "Bannen";
        $rb2 = "Remove all";
        $rb3 = "Remove Verified";
        //button GREEN
        $gb1 = "Remove Bann";
        $gb2 = "Add Verified";
        $gb3 = "Add 2FA";

        //name for form
        $rbn1 = "profil_bann";
        $rbn2 = "profil_rem-all";
        $rbn3 = "profil_rem-veri";

        $gbn1 = "profil_rem-bann";
        $gbn2 = "profil_add-veri";
        $gbn3 = "profil_add-2fa";
    }
    elseif (isset($data)){
        $u1="Username";
        $u2="Password (Hashed)";
        $u3="";
        $u4="";
        $u5="";
        $u6="";
        $u7="";
        $u8="";
        $u9="";
        $u10="";
        $u11="";
        $u12="";
        $u13="";
        //button RED
        $rb1 = "remove user";
        $rb2 = "--";
        $rb3 = "--";
        //button GREEN
        $gb1 = "--";
        $gb2 = "--";
        $gb3 = "--";

        //name for form
        $rbn1 = "data_rem-usr";
        $rbn2 = "data_---";
        $rbn3 = "data_---";

        $gbn1 = "data_---";
        $gbn2 = "data_---";
        $gbn3 = "data_---";
    }elseif (isset($roles)){
        $u1="Username";
        $u2="Admin";
        $u3="Supporter";
        $u4="Developer";
        $u5="Pro";
        $u6="Beta Member";
        $u7="Pink Banana";
        $u8="10K";
        $u9="100K";
        $u10="Verified";
        $u11="Partner";
        $u12="Root";
        $u13="Verkäufer";
        //button RED
        $rb1 = "remove all";
        $rb2 = "remove verified";
        $rb3 = "remove verkäufer";
        //button GREEN
        $gb1 = "add verified";
        $gb2 = "add verkäufer";
        $gb3 = "add pro";

        //name for form
        $rbn1 = "roles_rem-all";
        $rbn2 = "roles_rem-veri";
        $rbn3 = "roles_rem-verk";

        $gbn1 = "roles_add-veri";
        $gbn2 = "roles_add-verk";
        $gbn3 = "roles_add-pro";
    }elseif (isset($konto)){
        $u1="Username";
        $u2="Konto Besitzer";
        $u3="IBAN Nummer";
        $u4="Kontostand";
        $u5="Ablaufdatum";
        $u6="Code";
        $u7="";
        $u8="";
        $u9="";
        $u10="";
        $u11="";
        $u12="";
        $u13="";
        //button RED
        $rb1 = "Konto Löschen";
        $rb2 = "remove 0,005 SXC";
        $rb3 = "refresh IBAN";
        //button GREEN
        $gb1 = "Verify";
        $gb2 = "add 0,005 SXC";
        $gb3 = "unbanneable";

        //name for form
        $rbn1 = "konto_delete";
        $rbn2 = "konto_-10";
        $rbn3 = "konto_refresh_iban";

        $gbn1 = "konto_verify";
        $gbn2 = "konto_+10";
        $gbn3 = "konto_unbanneable";
    }elseif (isset($gift)){
        $u1="Wert";
        $u2="Code";
        $u3="Erstellt von";
        $u4="Bezahlt mit ";
        $u5="Link";
        $u6="";
        $u7="";
        $u8="";
        $u9="";
        $u10="";
        $u11="";
        $u12="";
        $u13="";
        //button RED
        $rb1 = "Stoniren";
        $rb2 = "remove 0,005 SXC";
        $rb3 = "Löschen";
        //button GREEN
        $gb1 = "MAG";
        $gb2 = "add 0,005 SXC";
        $gb3 = "Zum Rick";

        //name for form
        $rbn1 = "gift_remove";
        $rbn2 = "gift_-10";
        $rbn3 = "gift_delete";

        $gbn1 = "gift_mag";
        $gbn2 = "gift_+10";
        $gbn3 = "gift_to_rick";

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
    <div class="btn">
    <form action="dbedit.php" method="get">
    <button type="submit" name="'.$rbn1.'" class="btn btn-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb1.'</font></font></button>
    <button type="submit" name="'.$rbn2.'" class="btn btn-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb2.'</font></font></button>
    <button type="submit" name="'.$rbn3.'" class="btn btn-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$rb3.'</font></font></button>
    
    <button type="submit" name="'.$gbn1.'" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb1.'</font></font></button>
    <button type="submit" name="'.$gbn2.'" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb2.'</font></font></button>
    <button type="submit" name="'.$gbn3.'" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$gb3.'</font></font></button>
    </form>
    </div>
';
    echo $html;
}
?>

</body>
</html>