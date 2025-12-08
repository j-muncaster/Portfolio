<?php
    $enviro = 'localhost';
    $username = 'root';
    // $password = ''; // This is for Windows
    $password = 'root'; // This is for Mac

    $db = 'db_portfolio';

    $connect = new mysqli($enviro, $username, $password, $db);

    if(mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
    }
?>