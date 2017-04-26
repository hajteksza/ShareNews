<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "newUser") {
        echo "Witamy pierwszy raz w ShareNews";
    } elseif ($_GET['action'] == "login") {
        echo "Witamy w ShareNews";
    }
}