<?php
require_once('connection.php');
require_once ('src/User.php');

$users = User::loadAllUsers($conn);
var_dump($users);