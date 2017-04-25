<?php
$servername = "localhost";
$username = "root";
$password = "coderslab";
$baseName = "twitter";


$conn = new mysqli($servername, $username, $password, $baseName);

if ($conn->connect_error) {
die("Połączenie z bazą nieudane Błąd: " . $conn->connect_error);
}

