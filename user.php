<?php
include('src/User.php');
include('config/connection.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($_GET['id']) {
        $user = new User;
        $arr = $user->loadUserById($conn, $_GET['id']);
        var_dump($arr);
    }
}
