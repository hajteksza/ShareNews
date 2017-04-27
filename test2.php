<?php

require_once('connection.php');
require_once ('src/User.php');

$user1 = User::loadUserByID($conn, 9);
var_dump($user1);
$user1 ->delete($conn);
$user1 ->saveToDB($conn);
var_dump($user1);

$conn->close();
