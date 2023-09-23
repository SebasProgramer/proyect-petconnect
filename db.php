<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petconnect";

// Usando la misma variable que en login.php
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
