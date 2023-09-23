<?php
$servername = "localhost";
$username = "id19569901_sebastian";
$password = "SRMorales123.";
$dbname = "id19569901_1";

// Usando la misma variable que en login.php
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
