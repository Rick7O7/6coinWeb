<?php
$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "user";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

} catch(PDOException $e) {
  echo "SQL Error: " . $e->getMessage();
}
