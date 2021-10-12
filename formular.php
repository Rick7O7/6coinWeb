<?php
require 'db.php';

if (isset($_POST['aktion']) and $_POST['aktion']=='speichern') {
    $vorname = "";
    if (isset($_POST['vorname'])) {
        $vorname = trim($_POST['vorname']);
    }
    $nachname = "";
    if (isset($_POST['nachname'])) {
        $nachname = trim($_POST['nachname']);
    }
    $anmerkung = "";
    if (isset($_POST['anmerkung'])) {
        $anmerkung = trim($_POST['anmerkung']);
    }

    $erstellt = date("Y-m-d H:i:s");
    if ( $vorname != '' or $nachname != '' or $anmerkung != '' )

    {
        // speichern
        $einfuegen = $db->prepare("INSERT INTO kontakte (vorname, nachname, anmerkung, erstellt) 
                VALUES (?, ?, ?, NOW())
                ");
        $einfuegen->bind_param('sss', $vorname, $nachname, $anmerkung);
        if ($einfuegen->execute()) {
            header('Location: form.php?aktion=feedbackgespeichert');
            die();
            echo "<h1>gespeichert</h1>";
        }
    }
}
if (isset($_GET['aktion']) and $_GET['aktion']=='feedbackgespeichert') {
    echo '<p class="feedbackerfolg">Datensatz wurde gespeichert</p>';
}
$daten = array();
if ($erg = $db->query("SELECT * FROM kontakte")) {
    if ($erg->num_rows) {
        while($datensatz = $erg->fetch_object()) {
            $daten[] = $datensatz;
        }
        $erg->free();
    }
}
if (!count($daten)) {
    echo "<p>Es liegen keine Daten vor :(</p>";
} else {
?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Anmerkung</th>
                <th>erstellt</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($daten as $inhalt) {
            ?>
                <tr>
                    <td><?php echo $inhalt->id; ?></td>
                    <td><?php echo bereinigen($inhalt->vorname); ?></td>
                    <td><?php echo bereinigen($inhalt->nachname); ?></td>
                    <td><?php echo bereinigen($inhalt->anmerkung); ?></td>
                    <td><?php echo $inhalt->erstellt; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
function bereinigen($inhalt='') {
    $inhalt = trim($inhalt);
    $inhalt = htmlentities($inhalt, ENT_QUOTES, "UTF-8");
    return($inhalt);
}
?>
<form action="" method="post">
    <label>Vorname: 
        <input type="text" name="vorname" id="vorname">
    </label>
    <label>Nachname: 
        <input type="text" name="nachname" id="nachname">
    </label>
    <label>Anmerkung: 
        <textarea name="anmerkung" id="anmerkung"></textarea>
    </label>
    <input type="hidden" name="aktion" value="speichern">
    <input type="submit" value="speichern">
</form>
