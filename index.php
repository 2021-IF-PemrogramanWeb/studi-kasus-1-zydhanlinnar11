<?php

session_start();

if(!($_SESSION["loggedin"] ?? false)) {
    header('location: /login');
    exit;
}
?>

