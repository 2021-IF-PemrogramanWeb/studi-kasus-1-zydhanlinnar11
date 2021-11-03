<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    if($_GET["theme"] === "dark" || $_GET["theme"] === "light")
        $_SESSION["theme"] = $_GET["theme"];
    header('location: '.$_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo $_SERVER['REQUEST_METHOD']." is not supported.";
}