<?php
require ("src/User.php");
require ("connection.php");

$john = new User();
$john->setEmail("blab@email.com");
$john->setUsername("johnny");
$john->setHashedPassword("bryczek1234532");
$john->saveToDB($conn);
var_dump($john);