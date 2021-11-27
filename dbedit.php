<?php
$user_id = $_COOKIE["username_admin_input"];
$set_input = $_GET["set_input"];
$true = "true";
$false= "false";
$not = "";

if(isset($_GET["profil_bann"])){
require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET banned=:banned WHERE username = :user");
    $stmt->bindParam(":banned", $true);
    $stmt->bindParam(":username", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["profil_rem-all"])){
require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET verify=:not, 2fa=:not WHERE username = :user");
    $stmt->bindParam(":not", $not);
    $stmt->bindParam(":username", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["profil_rem-veri"])){
require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET verify=:false WHERE username = :user");
    $stmt->bindParam(":false", $false);
    $stmt->bindParam(":username", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["profil_rem-bann"])){
require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET banned=:banned WHERE username = :user");
    $stmt->bindParam(":banned", $false);
    $stmt->bindParam(":username", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["profil_add-veri"])){
require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET verify=:verify WHERE username = :user");
    $stmt->bindParam(":verify", $true);
    $stmt->bindParam(":username", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["profil_add-2fa"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET 2fa=:2fa WHERE username = :user");
    $stmt->bindParam(":2fa", $true);
    $stmt->bindParam(":username", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}

if(isset($_GET["data_rem_usr"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE data SET username=:not, password=:not WHERE username = :user");
    $stmt->bindParam(":not", $not);
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["roles_rem-all"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET supporter=0,developer=0,pro=0,verified=0,pink_banana=0,partner=0 WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["roles_rem_veri"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET verified=0 WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["roles_rem-verk"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET verkäufer=0 WHERE username = :user");
    $stmt->bindParam(":not", $not);
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["roles_add-veri"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET verified=1 WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["roles_add-verk"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET verkäufer=1 WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["roles_add-pro"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET pro=1 WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}


if(isset($_GET["konto_delete"])){
    require ("connection.php");
    $stmt = $conn->prepare("DELETE FROM konto WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["konto_-10"])){
    require ("connection.php");
    $stmt5 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt5->bindParam(":user", $_COOKIE["username"]);
    $stmt5->execute();
    $row5 = $stmt5->fetch();
    $konto_value = $row5["konto_value"];
    $value = (int)$konto_value;
    $value = $value - 10;
    $konto_value = strval($value);
    $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":kv", $konto_value);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["konto_refresh_iban"])){
    require ("connection.php");
    $randint = rand(10000000000000, 99999999999999);
    $iban_gen = "6C".$randint;

    $stmt = $conn->prepare("UPDATE konto SET iban=:iban WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":iban", $iban_gen);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["konto_+10"])){
    require ("connection.php");
    $stmt5 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt5->bindParam(":user", $_COOKIE["username"]);
    $stmt5->execute();
    $row5 = $stmt5->fetch();
    $konto_value = $row5["konto_value"];
    $value = (int)$konto_value;
    $value = $value + 10;
    $konto_value = strval($value);
    $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":kv", $konto_value);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["gift_rem"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE gift SET value=:not WHERE from_user = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":not", $not);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["gift_mag"])){
    require ("connection.php");
    $stmt = $conn->prepare("INSERT INTO givaway (typ, value, from, to) VALUES (`SXC`,:value,`707Administration`, `pro`)");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["gift_rem"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE gift SET value=:not WHERE from_user = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":not", $not);
    $stmt->execute();
    header("location: adminmainpage.php");
}if(isset($_GET["user_bann"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET bann=:true WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":not", $not);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_rem-kv"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE konto SET konto_value=0 WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":not", $not);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_rem-roles"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE roles SET pro=0,verified=0,pink_banana=0,partner=0,verkäufer=0,10k=0,100k=0 WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_rem-rolesInput"])){
    require ("connection.php");
    $sql = "UPDATE roles SET ".$set_input."=0 WHERE username = :user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_rem-accvalueInput"])){
    require ("connection.php");
    $stmt5 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt5->bindParam(":user", $user_id);
    $stmt5->execute();
    $row5 = $stmt5->fetch();
    $set_input= (int)$set_input;
    $konto_value = $row5["konto_value"];
    $value = (int)$konto_value;
    $value =  $value-$set_input;
    $konto_value = strval($value);
    $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":kv", $konto_value);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_rem-bann"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET bann=:false WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":false", $false);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_add-roleInput"])){
    require ("connection.php");
    $sql = "UPDATE roles SET ".$set_input."=1 WHERE username = :user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user", $user_id);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_add-accvalueInput"])){
    require ("connection.php");
    $stmt5 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt5->bindParam(":user", $user_id);
    $stmt5->execute();
    $row5 = $stmt5->fetch();
    $set_input= (int)$set_input;
    $konto_value = $row5["konto_value"];
    $value = (int)$konto_value;
    $value = $value + $set_input;
    $konto_value = strval($value);
    $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":kv", $konto_value);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_set-username"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET username=:set WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":set", $set_input);
    $stmt->execute();

    $stmt1 = $conn->prepare("UPDATE data SET username=:set WHERE username = :user");
    $stmt1->bindParam(":user", $user_id);
    $stmt1->bindParam(":set", $set_input);
    $stmt1->execute();

    $stmt2 = $conn->prepare("UPDATE konto SET user_id=:set WHERE user_id = :user");
    $stmt2->bindParam(":user", $user_id);
    $stmt2->bindParam(":set", $set_input);
    $stmt2->execute();

    $stmt3 = $conn->prepare("UPDATE roles SET username=:set WHERE username = :user");
    $stmt3->bindParam(":user", $user_id);
    $stmt3->bindParam(":set", $set_input);
    $stmt3->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_set-email"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE profil SET email_adress=:set WHERE username = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":set", $set_input);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["user_set-kd"])){
    require ("connection.php");
    $stmt = $conn->prepare("UPDATE konto SET date=:set WHERE user_id = :user");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":set", $set_input);
    $stmt->execute();
    header("location: admin_users.php");
}if(isset($_GET["quest_agree"])){
    require ("connection.php");
    $stmt = $conn->prepare("DELETE FROM quest WHERE user_id=:set");
    $stmt->bindParam(":set", $set_input);
    $stmt->execute();

    $stmt5 = $conn->prepare("SELECT * FROM konto WHERE user_id = :user");
    $stmt5->bindParam(":user", $set_input);
    $stmt5->execute();
    $row5 = $stmt5->fetch();
    $konto_value = $row5["konto_value"];
    $value = (int)$konto_value;
    $value = $value + 200 ;
    $konto_value = strval($value);

    $stmt = $conn->prepare("UPDATE konto SET konto_value=:kv WHERE user_id = :user");
    $stmt->bindParam(":user", $set_input);
    $stmt->bindParam(":kv", $konto_value);
    $stmt->execute();

    header("location: admin_quest.php");

}if(isset($_GET["quest_delete"])){
    require ("connection.php");
    $stmt = $conn->prepare("DELETE FROM quest WHERE user_id=:set");
    $stmt->bindParam(":set", $set_input);
    $stmt->execute();
    header("location: admin_quest.php");
}if(isset($_GET["state_update"])){
    require ("connection.php");
    $set_column = $_GET["set_column"];
    $sql = "UPDATE status SET ".$set_column."=:set_i WHERE server_name = :sn";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":sn", $_GET["set_server"]);
    $stmt->bindParam(":set_i", $set_input);
    $stmt->execute();
    header("location: admin_status.php");
}
if(isset($_GET["sxc_update"])){
    require ("connection.php");
    $sql = "UPDATE sxc SET sxc_value=:set_i,last_edit_by=:usid WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":set_i", $_GET["set_input"]);
    $stmt->bindParam(":usid", $_COOKIE["username"]);
    $stmt->execute();
    header("location: admin_sxc.php");
}
if(isset($_GET["acc_input_agads"])){
    // alle gleiches ablaufdatum setzen
    require ("connection.php");
    $sql = "UPDATE konto SET date=:set_i";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":set_i", $_GET["set_input"]);
    $stmt->execute();
    header("location: admin_acc.php");
}if(isset($_GET["acc_input_sperren"])){
    require ("connection.php");
    $sql = "UPDATE konto SET user_id=:rnd WHERE user_id=:set_i";
    $stmt = $conn->prepare($sql);
    $rnd = rand(10, 10000)."[sperre]".$set_input;
    $stmt->bindParam(":set_i", $_GET["set_input"]);
    $stmt->bindParam(":rnd", $rnd);
    $stmt->execute();
    header("location: admin_acc.php");
}if(isset($_GET["acc_oroot-set-null"])){
    // allen -all überweisen
    require ("connection.php");
    $stmt5 = $conn->prepare("SELECT * FROM roles WHERE user_id = :user");
    $stmt5->bindParam(":user", $_COOKIE["username"]);
    $stmt5->execute();
    $row5 = $stmt5->fetch();
    if(!$row5["root"]==1){
        header("location: admin_acc.php");
    }
    $stmt = $conn->prepare("UPDATE konto SET konto_value=0");
    $stmt->execute();
    header("location: admin_acc.php");
}
