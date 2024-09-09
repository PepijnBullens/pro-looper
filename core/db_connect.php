<?php
    if (is_file('./.env')) {
        $env = parse_ini_file('./.env');
    } else {
        $env = [];
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $dbhost = $env['DB_HOST'];
    $dbusername = $env['DB_USERNAME'];
    $dbpassword = $env['DB_PASSWORD'];
    $dbname = $env['DB_NAME'];
    
    $con = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ($con->connect_errno) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
        exit();
    }

    function prettyDump($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
?>