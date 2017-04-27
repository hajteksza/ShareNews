<?php
require('config/connection.php');
require('src/User.php');

session_start();
//if (isset($_SESSION['userId'])) {
//header('Location: main.php');
//}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['usernamesignup']) and isset($_POST['emailsignup']) and isset($_POST['passwordsignup']) and isset($_POST['passwordsignup_confirm'])) {
        if ($_POST['usernamesignup'] == "" or $_POST['emailsignup'] == "" or $_POST['passwordsignup'] == "" or $_POST['passwordsignup_confirm'] == "") {
            header('Location: registererror.php?action=not');
        } else {
            if ($_POST['passwordsignup'] == $_POST['passwordsignup_confirm']) {
                $newUser = new User();
                $newUser->setUsername($_POST['usernamesignup']);
                $newUser->setEmail($_POST['emailsignup']);
                $newUser->setHashedPassword($_POST['passwordsignup']);
                $result = $newUser->saveToDB($conn);
                if ($result == true) {
                    $_SESSION['userId'] = $newUser->getId();
                    header('Location: main.php?action=newUser');
                } else {
                    header('Location: registererror.php?action=email');
                }
            } else {
                header('Location: registererror.php?action=equal');
            }
        }
    } elseif (isset($_POST['email']) and isset($_POST['password'])) {
        if ($_POST['email'] == "" or $_POST['password'] == "") {
            header('Location: registererror.php?action=not');
        } else {
            $user = new User();
            $result = $user->loadUser($conn, $_POST['email'], $_POST['password']);
            var_dump($result);
            if ($result === true) {
                $_SESSION['userId'] = $user->getId();
                header('Location: main.php?action=login');
            } else {
                header('Location: registererror.php?action=login');
            }
        }
    }
}
?>
