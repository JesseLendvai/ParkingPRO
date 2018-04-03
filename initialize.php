<?php
    define("DB_SERVER", "localhost");
    define("DB_NAME", "parking");
    define("DB_USER", "root");
    define("DB_PASS", "");
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    session_start();
?>